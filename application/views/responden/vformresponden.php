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
      <!-- Main component for a primary marketing message or call to action -->
<div class="panel panel-default">
  <div class="panel-heading"><b>Form Data User</b></div>
  <div class="panel-body">
     <form action="<?=base_url()?>responden/form/<?=$aksi?>" method="post">
     <input type="hidden" name="ID_POLI" class="form-control" value="<?php echo $id_poli?>" >
       <table class="table table-striped">
        <tr>
          <td>Nama<br></td>
          <td>
            <div class="col-sm-5">
                <input type="text" name="NAMA" class="form-control" required>
            </div>
            </td>
         </tr>

         <tr>
          <td>Umur<br></td>
          <td>
            <div class="col-sm-5">
              <input type="text" name="UMUR" class="form-control" required>
            </div>
            </td>
         </tr>

         <tr>
          <td>Jenis Kelamin<br></td>
          <td>
            <div class="col-sm-5">
              <select name="JENIS_KELAMIN" class="form-control" required>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
              </select>
            </div>
            </td>
         </tr>

         <tr>
          <td>Pekerjaan<br></td>
          <td>
            <div class="col-sm-5">
              <select name="PEKERJAAN" class="form-control" required>
              <?php if (!empty($qpekerjaan)) {
                foreach ($qpekerjaan as $key) { ?>
                <option value="<?php echo $key->ID_PEKERJAAN;?>"><?php echo $key->NAMA_PEKERJAAN;?></option>
                <?php }}?>
              </select>
            </div>
            </td>
         </tr>
         <tr>
          <td>Pendidikan Terakhir<br></td>
          <td>
            <div class="col-sm-5">
              <select name="PENDIDIKAN" class="form-control" required>
              <?php if (!empty($qpendidikan)) {
                foreach ($qpendidikan as $key) { ?>
                <option value="<?php echo $key->ID_PENDIDIKAN;?>"><?php echo $key->NAMA_PENDIDIKAN;?></option>
                <?php }}?>
              </select>
            </div>
            </td>
         </tr>
         <tr>
          <td>Tanggungan Biaya yang digunakan<br></td>
          <td>
            <div class="col-sm-5">
              <select name="TANGGUNGAN_BIAYA" class="form-control" required>
              <?php if (!empty($qtanggungan_biaya)) {
                foreach ($qtanggungan_biaya as $key) { ?>
                <option value="<?php echo $key->ID_TANGGUNGAN_BIAYA;?>"><?php echo $key->NAMA_TANGGUNGAN_BIAYA;?></option>
                <?php }}?>
              </select>
            </div>
            </td>
         </tr>
         <tr>
          <td colspan="2">
            <input type="submit" class="btn btn-success" value="Simpan">
          </td>
         </tr>
       </table>
     </form>
        </div>
    </div>    <!-- /panel -->

    </div> <!-- /container -->
<?php $this->load->view('footer');?>