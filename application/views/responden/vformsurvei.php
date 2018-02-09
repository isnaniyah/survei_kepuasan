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
      $panggilan="Saudara";
    }else{
      $panggilan="Saudari";
    }
    ?>
<div class="container">
      <!-- Main component for a primary marketing message or call to action -->
      <center><img src="<?=base_url()?>assets/image/Logo.png" class="img-rounded" width="100" height="120"><br>
      <h3>Silahkan <?php echo $panggilan;?> <?php echo $NAMA;?> untuk mengisi survei sesuai dengan pendapat <?php echo $panggilan;?> mengenai pelayanan di <?php echo $NAMA_POLI;?></h3><br></center>
<div class="panel panel-default">
  <div class="panel-heading"><b>Form Suvei Kepuasan Pasien Rawat Jalan</b></div>
  <div class="panel-body">
     <form action="<?=base_url()?>survei/form/<?=$aksi?>" method="post">
     <input type="hidden" name="ID_POLI" class="form-control" value="<?php echo $ID_POLI?>" >
       <table class="table table-striped">
          <input type="hidden" name="ID_RESPONDEN" value="<?php echo $ID_RESPONDEN;?>">
          <input type="hidden" name="ID_POLI" value="<?php echo $ID_POLI;?>">
          <br>
         <?php
         if (empty($qsub)) {
           echo "<tr>
          <td colspan='2'>Data tidak ditemukan</td>
         </tr>";
         } else {$i=0;?>
         <tr>
            <th>No</th>
            <th><center>Pernyataan</center></th>
            <th>Bagaimana pendapat anda tentang pelayanan yang diberikan?</th>
            <th>Seberapa penting aspek ini menurut anda?</th>
         </tr>
         <?php foreach ($qsub as $key) {$i++;?>
         <tr>
         <td><b><?php echo $i?></b></td>
          <td><font size="4"><?php echo $key->NAMA_SUB ?> </font>(<?php echo $key->KETERANGAN ?>)</td>
          <input type="hidden" name="ID_SUB[]" value="<?php echo $key->ID_SUB;?>">
          <td class="col-lg-2" ><input type="number" class="rating" name="NILAI_PERSEPSI[]" min=0 max=5 step=1 data-size="xs" data-stars="5" required></td>
          <td class="col-lg-2"><input type="number" class="rating2" name="NILAI_HARAPAN[]" min=0 max=5 step=1 data-size="xs" data-stars="5" required></td>
         </tr>
         
         <?php }
       }
         ?>
         <tr>
          <td colspan="4"><center>
            <input type="submit" class="btn btn-success" value="Simpan"></center>
          </td>
         </tr>
       </table>
     </form>
        </div>
    </div>    <!-- /panel -->

    </div> <!-- /container -->
<?php $this->load->view('footer');?>