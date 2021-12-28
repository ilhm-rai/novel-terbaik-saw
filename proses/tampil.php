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

$query = "";

if ($table == 'nilai_buku')
  $query .= "SELECT $table.*, kriteria.nama as nama_kriteria FROM $table INNER JOIN kriteria ON kriteria.id = $table.kriteria_id WHERE buku_id='$id'";
else
  $query .= "SELECT * FROM $table WHERE id='$id'";

$crud->getData($query, $table, $konek);
