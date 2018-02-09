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
  <!-- Tombol untuk menampilkan modal-->
  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Buka Modal</button>

  <!-- Modal -->
  <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- konten modal-->
      <div class="modal-content">
        <!-- heading modal -->
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Bagian heading modal</h4>
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
      <!-- Main component for a primary marketing message or call to action -->
<div class="panel panel-default">
  <div class="panel-heading"><b>Form Kritik dan Saran</b></div>
  <div class="panel-body">
    <?php
    foreach ($qpoli as $key) {
      $ID_POLI = $key->ID_POLI;
      $NAMA_POLI = $key->NAMA_POLI;
    }
    foreach ($qresponden as $key) {
      $ID_RESPONDEN = $key->ID_RESPONDEN;
      $NAMA = $key->NAMA;
      $JENIS_KELAMIN = $key->JENIS_KELAMIN;
    }
    if ($JENIS_KELAMIN==('Laki-laki')) {
      $panggilan="Saudara";
    }else{
      $panggilan="Saudari";
    }
    ?>
     <form action="<?=base_url()?>kritik/form/<?=$aksi?>" method="post">
       <table class="table table-striped">
          <h2>Silahkan <?php echo $panggilan;?> <?php echo $NAMA;?> untuk memberikan kritik dan saran untuk <?php echo $NAMA_POLI;?>, Silahkan klik tombol lewati untuk melewati tahap ini.</h2><br>
          <input type="hidden" name="ID_RESPONDEN" value="<?php echo $ID_RESPONDEN;?>">
          <input type="hidden" name="ID_POLI" value="<?php echo $ID_POLI;?>">
          <br>
         <tr>
          <td>Kritik dan saran</td>
          <td>
          <div class="col-sm-5">
            <textarea rows="10" cols="60" name="KRITIK_SARAN" class="form-control"></textarea>
          </div>
          </td>
         </tr>
        <tr>
          <td colspan="2">
            <input type="submit" class="btn btn-success" value="Simpan">
            <a href="<?=base_url()?>"  class="btn btn-default">Lewati</a>
          </td>
        </tr>
       </table>
     </form>
        </div>
    </div>    <!-- /panel -->

    </div> <!-- /container -->
<?php $this->load->view('footer');?>