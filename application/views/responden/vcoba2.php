<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?=$title?></title>
    <link href="<?=base_url()?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/css/style.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/css/style.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/css/star-rating.min.css" media="all" rel="stylesheet" type="text/css" />
    <script src="<?=base_url()?>assets/js/jquery.min.js"></script>
    <script src="<?=base_url()?>assets/js/bootstrap.min.js"></script>
    <script src="<?=base_url()?>assets/js/star-rating.min.js"></script>
  </head>
  <body>
  <br><br><br>
<div class="container">
<center><h1>Membuat Modal dengan Bootstrap | www.malasngoding.com</h1></center>
  <br/>

  <!-- Modal -->
  <div id="modalku" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- konten modal-->
      <div class="modal-content">
        <!-- heading modal -->
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Bagian headingisanaaaaaaaaaaaaa modal</h4>
        </div>
        <!-- body modal -->
        <div class="modal-body">
          <p>bagian body modal.</p>
        </div>
        <!-- footer modal -->
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup Modal</button>
        </div>
      </div>
    </div>
  </div>

    </div> <!-- /container -->
<?php $this->load->view('footer');?>