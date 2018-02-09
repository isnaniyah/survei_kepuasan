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
      $panggilan="saudara";
    }else{
      $panggilan="saudari";
    }
    ?>
<div class="container">
       <center><img src="<?=base_url()?>assets/image/Logo.png" class="img-rounded" width="100" height="120"><br>
          <h3>Silahkan <?php echo $panggilan;?> <?php echo $NAMA;?> untuk memberikan kritik dan saran untuk <?php echo $NAMA_POLI;?>, Silahkan klik tombol lewati untuk melewati tahap ini.</h3><br></center>

      <!-- Main component for a primary marketing message or call to action -->
<div class="panel panel-default">
  <div class="panel-heading"><b>Form Kritik dan Saran</b></div>
  <div class="panel-body">

     <form action="<?=base_url()?>kritik/form/<?=$aksi?>" method="post">
       <table class="table table-striped">
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
            <!-- <input type="submit" class="btn btn-success" value="Simpan"> -->
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalSimpan">Simpan</button>
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modalLewati">Lewati</button>
          </td>
        </tr>
       </table>
        <div id="modalSimpan" class="modal fade" role="dialog">
          <div class="modal-dialog">
            <!-- konten modal-->
            <div class="modal-content">
              <!-- heading modal -->
              <div class="modal-header">
                <h4 class="modal-title">Terima kasih!</h4>
              </div>
              <!-- body modal -->
              <div class="modal-body">
                <p>Terima kasih telah berpartisipasi untuk mengisi survei kepuasan pasien rawat jalan ini. Semoga sehat selalu</p>
              </div>
              <!-- footer modal -->
              <div class="modal-footer">
                <button type="submit" class="btn btn-default">Tutup</button>
              </div>
            </div>
          </div>
        </div>
     </form>
    </div>
    </div>    <!-- /panel -->
    <div id="modalLewati" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- konten modal-->
      <div class="modal-content">
        <!-- heading modal -->
        <div class="modal-header">
          <h4 class="modal-title">Terima kasih!</h4>
        </div>
        <!-- body modal -->
        <div class="modal-body">
          <p>Terima kasih telah berpartisipasi untuk mengisi survei kepuasan pasien rawat jalan ini. Semoga sehat selalu</p>
        </div>
        <!-- footer modal -->
        <div class="modal-footer">
          <a href="<?=base_url()?>"  class="btn btn-default">Tutup</a>
        </div>
      </div>
    </div>
  </div>
  </div>
  </body>
  </html>
    </div> <!-- /container -->
<?php $this->load->view('footer');?>