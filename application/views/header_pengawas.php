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
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/highcharts.js"></script>

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
            <li><a href="<?=base_url()?>home/pengawas"><i class="glyphicon glyphicon-home"></i> Home</a></li>
            <li><a href="<?=base_url()?>pengawas_ranking"><i class="glyphicon glyphicon-star"></i> Ranking </a></li>
            <li><a href="<?=base_url()?>kritik"><i class="glyphicon glyphicon-comment"></i> Kritik dan Saran </a></li>
            <li><a href="<?=base_url()?>pengawas_log"><i class="glyphicon glyphicon-retweet"></i> Log Admin </a></li>
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
                  <li><a href="<?=base_url()?>pengawas_user/ganti"><i class="glyphicon glyphicon-edit"></i> Ubah Password </a></li>
                  <li><a href="<?=base_url()?>auth/logout" onclick="return confirm('Anda yakin ingin keluar?')"><i class="glyphicon glyphicon-log-out"></i> Logout</a></li>
                </ul>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
