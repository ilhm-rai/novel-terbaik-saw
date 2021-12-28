<?php
require 'connect.php';
$user = @$_POST['username'];
$pass = @$_POST['password'];

if (empty($user)) {
  $result = [
    'type' => 'error',
    'message' => ['username', 'Username tidak boleh kosong']
  ];
} elseif (empty($pass)) {
  $result = [
    'type' => 'error',
    'message' => ['password', 'Password tidak boleh kosong']
  ];
} else {
  $query = "SELECT * FROM user WHERE username='$user'";
  $execute = $konek->query($query);
  if ($execute->num_rows > 0) {
    $data = $execute->fetch_array(MYSQLI_ASSOC);
    if (password_verify($pass, $data['password'])) {
      session_start();
      $_SESSION['user'] = $data['username'];
      $_SESSION['nama'] = $data['nama'];
      $result = [
        'type' => 'success',
        'message' => 'Login berhasil'
      ];
    } else {
      $result = [
        'type' => 'error',
        'message' => ['alert', $data['password']]
      ];
    }
  } else {
    $result = [
      'type' => 'error',
      'message' => ['username', 'Username tidak terdaftar']
    ];
  }
}

echo json_encode($result);
