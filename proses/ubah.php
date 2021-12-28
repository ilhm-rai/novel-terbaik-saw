<?php
require '../connect.php';
require '../class/crud.php';
$crud = new crud($konek);

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  $id = @$_GET['id'];
  $table = @$_GET['table'];
  if ($table == 'buku') {
    $old_sampul = @$_GET['old_sampul'];
  }
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $id = @$_POST['id'];
  $table = @$_POST['table'];
  if ($table == 'buku') {
    $old_sampul = @$_POST['old_sampul'];
  }
}

$pesan = "";

if ($table == 'buku') {
  $sampul = upload($old_sampul);
  if ($sampul != $old_sampul) {
    if (file_exists("../asset/img/" . $old_sampul)) {
      unlink("../asset/img/" . $old_sampul);
    }
  }
}

$buku_id = @$_POST['buku_id'];
$judul = @$_POST['judul'];
$pengarang = @$_POST['pengarang'];
$atribut = @$_POST['atribut'];
$kriteria_id = @$_POST['kriteria_id'];
$keterangan = @$_POST['keterangan'];
$nilai = @$_POST['nilai'];
$nilai_id = @$_POST['nilai_id'];
$bobot = @$_POST['bobot'];
$bobot_id = @$_POST['bobot_id'];

switch ($table) {
  case 'buku':
    if ($sampul) {
      $find = "SELECT judul FROM $table WHERE judul='$judul'";
      $query = "UPDATE $table SET judul = '$judul', pengarang='$pengarang', sampul='$sampul' WHERE id='$id'";
      $crud->multiUpdate($find, $query, $konek, "./?page=$table");
    } else {
      echo json_encode($pesan);
    }
    break;
  case 'kriteria':
    $find = "SELECT nama FROM $table WHERE nama='$kriteria'";
    $query = "UPDATE $table SET nama = '$kriteria', atribut='$atribut' WHERE id='$id'";
    $crud->multiUpdate($find, $query, $konek, "./?page=$table");
    break;
  case 'nilai_kriteria':
    $query = "UPDATE $table SET kriteria_id = '$kriteria_id', keterangan='$keterangan', nilai='$nilai' WHERE id='$id'";
    $crud->update($query, $konek, "./?page=subkriteria");
    break;
  case 'bobot_kriteria':
    $error = false;
    for ($i = 0; $i < count($bobot); $i++) {
      if (!is_numeric($bobot[$i])) {
        $error = true;
      }
    }

    if (!$error) {
      $query = "";
      for ($i = 0; $i < count($bobot_id); $i++) {
        $query .= "UPDATE bobot_kriteria SET bobot='$bobot[$i]' WHERE id='$bobot_id[$i]';";
      }

      $crud->update($query, $konek, './?page=bobot');
    } else {
      echo json_encode(['type' => 'failed', 'message' => 'Semua form tidak boleh kosong']);
    }
    break;
  case 'nilai_buku':
    $error = false;

    if (empty($buku_id)) {
      $error = true;
    }

    for ($i = 0; $i < count($nilai); $i++) {
      if (empty($nilai[$i])) {
        $error = true;
      }
    }

    if (!$error) {
      $query = "";
      for ($i = 0; $i < count($kriteria_id); $i++) {
        $query .= "UPDATE nilai_buku SET buku_id='$buku_id', kriteria_id='$kriteria_id[$i]', nilai_kriteria_id='$nilai[$i]' WHERE id='$nilai_id[$i]';";
      }
      $crud->update($query, $konek, './?page=penilaian');
    } else {
      echo json_encode(['type' => 'failed', 'message' => 'Lengkapi semua form yang tersedia']);
    }
    break;
}

function upload($old_name)
{
  global $pesan;
  $fileName = $_FILES["sampul"]["name"];
  $fileSize = $_FILES["sampul"]["size"];
  $error = $_FILES["sampul"]["error"];
  $tmpName = $_FILES["sampul"]["tmp_name"];

  if ($error === 4) {
    return $old_name;
  }

  $validExtension = ["jpg", "jpeg", "png"];
  $fileExtension = explode(".", $fileName);
  $fileExtension = strtolower(end($fileExtension));
  if (!in_array($fileExtension, $validExtension)) {
    $pesan = ['type' => 'error', 'message' => "Ekstensi file tidak didukung."];
    return false;
  }

  if ($fileSize > 5000000) {
    $pesan = ['type' => 'error', 'message' => "Ukuran Gambar terlalu besar."];
    return false;
  }

  $newFilename = uniqid();
  $newFilename .= '.';
  $newFilename .= $fileExtension;

  move_uploaded_file($tmpName, '../asset/img/' . $newFilename);

  return $newFilename;
}
