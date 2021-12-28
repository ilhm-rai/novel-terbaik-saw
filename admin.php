<?php
require './connect.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>::Best Novel Recomendation::</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="asset/css/bootstrap.min.css">
  <link rel="stylesheet" href="asset/css/all.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="asset/css/style.css">
  <link rel="stylesheet" href="asset/css/components.css">
</head>

<body>
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <ul class="navbar-nav mr-auto">
          <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
        </ul>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
              <img alt="image" src="../asset/img/avatar/avatar-1.png" class="rounded-circle mr-1">
              <div class="d-sm-none d-lg-inline-block">Hi, <?= @$_SESSION['nama']; ?></div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <a href="logout.php" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="index.html">Stisla</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
          </div>
          <?php include 'sidebar.php'; ?>
        </aside>
      </div>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <?php include 'page.php'; ?>
        </section>
      </div>
    </div>
    <footer class="main-footer">
      <div class="footer-left">
        Copyright &copy; 2021 <div class="bullet"></div> Created By <a href="mailto:">Fikri Padilah</a>
        <div class="bullet"></div> <a href="mailto:rizkyardi.ilhami06@gmail.com">Rizky Ardi Ilhami</a>
        <div class="bullet"></div> <a href="mailto:">Salma Taufik Faadhilah</a>
      </div>
      <div class="footer-right">
        1.0
      </div>
    </footer>
  </div>
  <!-- General JS Scripts -->
  <script src="asset/js/jquery.min.js"></script>
  <script src="asset/js/popper.min.js"></script>
  <script src="asset/js/bootstrap.min.js"></script>
  <script src="asset/js/bs-custom-file-input.min.js"></script>
  <script src="asset/js/jquery.nicescroll.min.js"></script>
  <script src="asset/js/moment.min.js"></script>
  <script src="asset/js/stisla.js"></script>
  <!-- JS Libraies -->

  <!-- Template JS File -->
  <script src="asset/js/scripts.js"></script>
  <script src="asset/js/custom.js"></script>

  <?php
  if (@$_GET['page'] == 'buku') :
  ?>
    <script>
      $(function() {
        bsCustomFileInput.init();
      })
    </script>
  <?php endif; ?>
</body>

</html>