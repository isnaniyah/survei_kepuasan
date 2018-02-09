<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="FaberNainggolan">
    <title><?=$title?></title>
    <link href="<?=base_url()?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/css/style.css" rel="stylesheet">

  </head>

  <body>
    <!-- Static navbar -->
    <nav class="navbar navbar-inverse navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <div class="brand-image"><img src="<?=base_url()?>assets/image/Logo.png" class="img-rounded" width="40" height="50"></div>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="<?=base_url()?>home/admin"><i class="glyphicon glyphicon-home"></i> Home</a></li>
            <li><a href="<?=base_url()?>admin_poli"><i class="glyphicon glyphicon-list"></i> Poli</a></li>
            <li><a href="<?=base_url()?>admin_kriteria"><i class="glyphicon glyphicon-list-alt"></i> Kriteria </a></li>
            <li><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> <i class="glyphicon glyphicon-th-large"></i> Responden <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                <li><a href="<?=base_url()?>admin_responden"><i class="glyphicon glyphicon-file"></i> Data Responden</a></li>
                <li><a href="<?=base_url()?>admin_pendidikan"><i class="glyphicon glyphicon-book"></i> Pendidikan Responden</a></li>
                <li><a href="<?=base_url()?>admin_pekerjaan"><i class="glyphicon glyphicon-briefcase"></i> Pekerjaan Responden</a></li>
                <li><a href="<?=base_url()?>admin_tanggungan_biaya"><i class="glyphicon glyphicon-credit-card"></i> Tanggungan Biaya Responden</a></li>
                </ul>
              </li>
            <li><a href="<?=base_url()?>admin_user"><i class="glyphicon glyphicon-cog"></i> User </a></li>
            <li><a href="<?=base_url()?>admin_periode"><i class="glyphicon glyphicon-time"></i> Periode </a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
          <?php
          $hari=date("l");
          $tanggal=date("d/m/Y");
          ?>
          <li><a><i class="glyphicon glyphicon-calendar"></i> <?php echo $hari.', '.$tanggal?> </a></li>
          <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> <i class="glyphicon glyphicon-user"></i> User <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="<?=base_url()?>admin_user/edit_user"><i class="glyphicon glyphicon-edit"></i> Ubah Password </a></li>
                <li><a href="<?=base_url()?>auth/logout" onclick="return confirm('Anda yakin ingin keluar?')"><i class="glyphicon glyphicon-log-out"></i>Logout</a></li>
              </ul>
          </li>
          </ul>
        </div>
      </div>
    </nav>
