    <div class="container">
      <div class="panel panel-default">
  <div class="panel-heading"><b>Hasil survei yang sudah dilakukan responden</b></div>
  <div class="panel-body">
  <p><?php echo $this->session->flashdata('pesan')?> </p>
  <!-- <div class="nav navbar-nav navbar-right">
    <form class="navbar-form navbar-left" role="search" action="<?=base_url()?>admin_sub/search" method="post">
      <div class="form-group">
        <input type="text" class="form-control" placeholder="Masukkan no kontrak" name="ID_KRITERIA">
      </div>
      <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i> Cari</button>
    </form>
  </div>-->
       <table class="table table-striped">
        <thead>
         <tr>
         <th>No.</th>
         <th>Pertanyaan survei</th>
         <th>Nilai Persepsi</th>
         <th>Nilai Harapan</th>
         </tr>
        </thead>
        <tbody>
        <?php if(empty($qsurvei)){ ?>
         <tr>
          <td colspan="4">Data tidak ditemukan</td>
         </tr>
        <?php }else{
          $i=0;
          foreach($qsurvei as $row){ $i++;?>
         <tr>
          <td><?php echo $i ?></td>
          <td><?php echo $row->NAMA_SUB ?></td>
          <td><?php echo $row->NILAI_PERSEPSI ?></td>
          <td><?php echo $row->NILAI_HARAPAN ?></td>
         </tr>
        <?php }}?>
        </tbody>
       </table>
        </div>
    </div>
    </div>
<?php $this->load->view('footer');?>