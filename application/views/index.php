<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Survei Kepuasan Pasien</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- Bootstrap 3.3.2 -->
        <link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet" >
        <!-- css -->
        <link href="<?php echo base_url('assets/css/login.css'); ?>" rel="stylesheet">
        <script src="<?=base_url()?>assets/js/jquery.min.js"></script>
        <script src="<?=base_url()?>assets/js/bootstrap.min.js"></script>

    <script type="text/javascript">
      $(document).on("click", ".viewContact", function() {
      var id_poli = $(this).data('id');
      $(".modal-body #ID_POLI").val(id_poli);
      $('#modalResponden').modal('show');});
    </script>
    </head>
  <body>
  <?php if (!empty($qranking)) {
    foreach ($qranking as $key) {
      $bulan = $key->BULAN;
      $tahun = $key->TAHUN;
    }
  }?>
  <center><img src="<?=base_url()?>assets/image/Logo.png" class="img-rounded" width="100" height="125"></center>
  <h2>Survei Kepuasan Pasien <br>RSUD Syarifah Ambami Rato Ebuh Bangkalan</h2>
  <br>
    <div class="shortcutHome">
      
        <div class="quoteOfDay">
          <i style="color: #5b5b5b;">
            <marquee>Selamat datang di web survei kepuasan pasien rawat jalan. Silahkan pilih poli dibawah ini untuk memulai survei. Terima kasih.
            </marquee>
          </i>
        </div>
        <br>
          
        <?php
        if (empty($qpoli)) {
          echo "<h3>Tidak ada data poli yang bisa dinilai!</h3>";
        }else{
          foreach ($qpoli as $key){?>
            <a data-toggle="modal" data-target="#modalResponden" href="#" class="viewContact" data-id="<?php echo $key->ID_POLI;?>"><img src="<?php echo base_url(); ?>assets/image/poli.png"><br> <?php echo $key->NAMA_POLI ?> </a>
        
        <?php  }
      }
        ?>
    </div>
    <br>
    <a class="btn btn-info" href="<?php echo base_url()?>auth/login" align="right">Masuk ke halaman admin</a>
    <br>
    <br><br>
    <div id="modalResponden" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <center><img src="<?=base_url()?>assets/image/Logo.png" class="img-rounded" width="100" height="120"></center><br>
              <h5 class="modal-title">Silahkan isi data diri anda untuk memulai survei : </h5>
            </div>
            <div class="modal-body">
              <p id="showid"></p>
              <form action="<?=base_url()?>responden/form/aksi_add" method="post">
                <input type="hidden" name="ID_POLI" id="ID_POLI" class="form-control" >
                <table class="table table-striped">
                  <tr>
                    <td>Nama<br></td>
                    <td>
                      <div class="col-sm-10">
                        <input size="50" type="text" name="NAMA" class="form-control" required>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Umur<br></td>
                    <td>
                      <div class="col-sm-4">
                        <input type="number" name="UMUR" class="form-control" required>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Jenis Kelamin<br></td>
                    <td>
                      <div class="col-sm-8">
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
                      <div class="col-sm-10">
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
                      <div class="col-sm-10">
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
                      <div class="col-sm-10">
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
            <div class="modal-footer">
              
            </div>
          </div>
        </div>
      </div>
  </body>
</html>