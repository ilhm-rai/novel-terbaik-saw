<?php
$konek = new mysqli('localhost', 'root', '', 'novelsaw');
if ($konek->connect_errno) {
  "Database Error".$konek->connect_error;
}