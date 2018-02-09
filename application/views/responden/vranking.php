<?php $this->load->view('header_petugas');?>

    <div class="container">

      <div class="panel panel-default">
  <div class="panel-heading"><b>Daftar Ranking</b></div>
  <div class="panel-body">
  <p><?php echo $this->session->flashdata('pesan')?> </p>
  <div class="nav navbar-nav navbar-right">
    <form class="navbar-form navbar-left" role="search" action="<?=base_url()?>petugas_ranking/search" method="post">
      <div class="form-group">
        <div class="col-sm-3">
              <select class="form-control" name="ID_TAHUN">
              <?php foreach ($qtahun as $rowdata) {
                echo '<option value="'.$rowdata->ID_TAHUN.'" >'.$rowdata->TAHUN.'</option>';
                }
                echo '</select>';?>
          </div>
      </div>
      <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i> Cari</button>
    </form>
  </div>
       <table class="table table-striped">
        <thead>
         <tr>
         <th>Tahun</th>
         <th>Nama Supplier</th>
         <th>Alamat</th>
         <th>No. Telepon</th>
         <th>Nilai Akhir</th>
         </tr>
        </thead>
        <tbody>
        <?php if(empty($qranking)){ ?>
         <tr>
          <td colspan="5">Data tidak ditemukan</td>
         </tr>
        <?php }else{
          foreach($qranking as $row){?>
         <tr>
          <td><?php echo $row->TAHUN;
          $hitungtahun = $row->ID_TAHUN;?></td>
          <td><?php echo $row->NAMA_SUPPLIER ?></td>
          <td><?php echo $row->ALAMAT ?></td>
          <td><?php echo $row->NO_TELP ?></td>
          <td><?php echo $row->NILAI_AKHIR?></td>
         </tr>
        <?php }}?>
        </tbody>
       </table>
       <?php if ($ket == 'search' && !empty($qranking)) {?>
       <a href="<?=base_url()?>petugas_hitung/detail/<?php echo $hitungtahun ?>" class="btn btn-warning btn-sm"><i class="glyphicon glyphicon-search"></i> Cek Perhitungan </a>
        <?php }?>
        </div>
    </div>    <!-- /panel -->

    </div> <!-- /container -->
<?php $this->load->view('footer');?>