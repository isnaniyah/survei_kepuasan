<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Log-in</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- Bootstrap 3.3.2 -->
        <link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet" >
        <!-- Font Awesome Icons -->
        <link href="<?php echo base_url('assets/css/login.css'); ?>" rel="stylesheet">
    </head>

<body>
  <h2>Aplikasi Analisa Kepuasan Pasien Rawat Jalan
    <br>RSUD Syarifah Ambami Rato Ebuh Bangkalan</h2>
  <div class="ribbon"></div>
  <div class="login">
  <h1><img src="<?=base_url()?>assets/image/rsud.png" class="img-rounded" width="100" height="150"></h1>
  <form action="<?php echo base_url('auth/cek_login'); ?>" method="post">
      <div class="blockinput">
        <i class="glyphicon glyphicon-user"></i><input type="text" name="USERNAME" placeholder="Username">
      </div>
      <div class="blockinput">
        <i class="glyphicon glyphicon-lock"></i><input type="password" name="PASSWORD" placeholder="Password">
      </div>
    <button>Login</button>
  </form>
  <br>
  <a href="<?=base_url()?>" class="btn btn-primary">Halaman Utama</a>
  </div>
  <div class="notif">
  <p><?php echo $this->session->flashdata('pesan')?> </p>
  </div>
  <br><br>
</body>