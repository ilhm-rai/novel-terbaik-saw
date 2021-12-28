<?php
require '../connect.php';
require '../class/crud.php';
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $id = @$_GET['id'];
    $table = @$_GET['table'];
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = @$_POST['id'];
    $table = @$_POST['table'];
}

$crud = new crud();

if ($table == 'buku') {
    $query = mysqli_query($konek, "SELECT sampul FROM buku WHERE id='$id'");
    $row = mysqli_fetch_array($query);
    if (file_exists("../asset/img/" . $row['sampul'])) {
        unlink("../asset/img/" . $row['sampul']);
    }
}

$query = "";
if ($table == 'nilai_buku') {
    $query = "DELETE FROM $table WHERE buku_id='$id'";
} else {
    $query = "DELETE FROM $table WHERE id='$id'";
}

$crud->delete($query, $konek);
