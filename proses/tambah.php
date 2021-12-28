<?php
require '../connect.php';
require '../class/crud.php';
$crud = new crud($konek);

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  $id = @$_GET['id'];
  $table = @$_GET['table'];
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $id = @$_POST['id'];
  $table = @$_POST['table'];
}

$pesan = "";
if ($table == 'buku') {
  $sampul = upload();
}

$buku_id = @$_POST['buku_id'];
$judul = @$_POST['judul'];
$pengarang = htmlspecialchars(@$_POST['pengarang']);
$kriteria = @$_POST['kriteria'];
$kriteria_id = @$_POST['kriteria_id'];
$nilai = @$_POST['nilai'];
$keterangan = @$_POST['keterangan'];
$atribut = @$_POST['atribut'];
$bobot = @$_POST['bobot'];

switch ($table) {
  case 'buku': //tambah data judul
    if ($sampul) {
      $find = "SELECT judul FROM $table WHERE judul='$judul'";
      $query = "INSERT INTO $table (judul, pengarang, sampul) VALUES ('$judul', '" . mysqli_real_escape_string($konek, $pengarang) . "', '$sampul')";
      $crud->multiAddData($find, $query, $konek);
    } else {
      echo json_encode($pesan);
    }
    break;
  case 'kriteria':
    $error = false;
    $find = "SELECT nama FROM $table WHERE nama='$kriteria'";
    $query = "INSERT INTO $table (nama, atribut) VALUES ('$kriteria', '$atribut')";

    if (empty($atribut) || empty($kriteria)) {
      $error = true;
    }

    if (empty($atribut)) {
      echo json_encode(['type' => 'failed', 'message' => 'Pilih atribut terlebih dahulu']);
    }

    if (empty($kriteria)) {
      echo json_encode(['type' => 'failed', 'message' => 'Kriteria tidak boleh kosong']);
    }

    if (!$error) {
      $crud->multiAddData($find, $query, $konek);
    }
    break;
  case 'nilai_kriteria':
    $error = false;

    if (empty($kriteria_id) || empty($keterangan) || !is_numeric($nilai)) {
      $error = true;
    }

    if (!is_numeric($nilai)) {
      echo json_encode(['type' => 'failed', 'message' => 'Nilai tidak boleh kosong']);
    }

    if (empty($keterangan)) {
      echo json_encode(['type' => 'failed', 'message' => 'Keterangan tidak boleh kosong']);
    }

    $query = "INSERT INTO nilai_kriteria (kriteria_id, keterangan, nilai) VALUES ('$kriteria_id', '$keterangan', '$nilai')";

    if (!$error)
      $crud->addData($query, $konek);
    break;
  case 'bobot_kriteria':
    $error = false;
    for ($i = 0; $i < count($bobot); $i++) {
      if (!is_numeric($bobot[$i])) {
        $error = true;
      }
    }

    $query = "INSERT INTO bobot_kriteria (kriteria_id, bobot) VALUES ";

    if (!$error) {
      for ($i = 0; $i < count($kriteria); $i++) {
        $query .= "('$kriteria[$i]', '$bobot[$i]')";
        if ($i < count($kriteria) - 1) {
          $query .= ",";
        } else {
          $query .= ";";
        }
      }
      $crud->addData($query, $konek);
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
      $query = "INSERT INTO nilai_buku (buku_id, kriteria_id, nilai_kriteria_id) VALUES ";
      for ($i = 0; $i < count($kriteria_id); $i++) {
        $query .= "('$buku_id','$kriteria_id[$i]', '$nilai[$i]')";
        if ($i < count($kriteria) - 1) {
          $query .= ",";
        } else {
          $query .= ";";
        }
      }
      $crud->addData($query, $konek);
    } else {
      echo json_encode(['type' => 'failed', 'message' => 'Lengkapi semua form yang tersedia']);
    }
}

function upload()
{
  global $pesan;
  $fileName = $_FILES["sampul"]["name"];
  $fileSize = $_FILES["sampul"]["size"];
  $error = $_FILES["sampul"]["error"];
  $tmpName = $_FILES["sampul"]["tmp_name"];

  if ($error === 4) {
    $pesan = ['type' => 'error', 'message' => "Pilih file terlebih dahulu."];
    return false;
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
