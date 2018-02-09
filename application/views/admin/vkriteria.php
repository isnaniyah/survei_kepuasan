<?php $this->load->view('header');?>
    <div class="container">
      <div class="panel panel-default">
  <div class="panel-heading"><b>Daftar Kriteria</b></div>
  <div class="panel-body">
  <p><?php echo $this->session->flashdata('pesan')?> </p>
  <!-- <div class="nav navbar-nav navbar-right">
    <form class="navbar-form navbar-left" role="search" action="<?=base_url()?>admin_kriteria/search" method="post">
      <div class="form-group">
        <input type="text" class="form-control" placeholder="Masukkan no kontrak" name="ID_KRITERIA">
      </div>
      <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i> Cari</button>
    </form>
  </div>-->
  <a href="admin_kriteria/form/add" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-plus"></i> Tambah</a>
       <table class="table table-striped">
        <thead>
         <tr>
         <th>No.</th>
         <th>Nama Kriteria</th>
         <th>Bobot Kriteria</th>
         <th></th>
         </tr>
        </thead>
        <tbody>
        <?php if(empty($qkriteria)){ ?>
         <tr>
          <td colspan="4">Data tidak ditemukan</td>
         </tr>
        <?php }else{
          $i=0;
          foreach($qkriteria as $row){ $i++;?>
         <tr>
          <td><?php echo $i ?></td>
          <td><?php echo $row->NAMA_KRITERIA ?></td>
          <td><?php echo $row->BOBOT_KRITERIA ?></td>
          <td>
           <a href="<?=base_url()?>admin_kriteria/form/edit/<?php echo $row->ID_KRITERIA ?>" class="btn btn-info btn-sm"><i class="glyphicon glyphicon-pencil"></i></a>
           <a href="<?=base_url()?>admin_kriteria/detail/<?php echo $row->ID_KRITERIA ?>" class="btn btn-warning btn-sm"><i class="glyphicon glyphicon-search"></i></a>
           <a href="<?=base_url()?>admin_kriteria/hapus/<?php echo $row->ID_KRITERIA ?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda Yakin menghapus data ini?')"><i class="glyphicon glyphicon-trash"></i></a>
          </td>
         </tr>
         <?php if(empty($qsub)){

         }else{
            foreach ($qsub as $rowkey) {
              if ($row->ID_KRITERIA == $rowkey->ID_KRITERIA && $rowkey->STATUS == "Aktif") {
         ?>
         <tr>
           <td> </td>
           <td colspan="3"><?php echo $rowkey->NAMA_SUB ?></td>
         </tr>
        <?php }}}}}?>
        </tbody>
       </table>
        </div>
    </div>
    </div>
<?php $this->load->view('footer');?>