    <div class="container">
      <div class="panel panel-default">
  <div class="panel-heading"><b>Daftar Sub Kriteria</b></div>
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
  <a href="<?=base_url()?>admin_sub/form/add/<?php echo $ID_KRITERIA?>" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-plus"></i> Tambah</a>
       <table class="table table-striped">
        <thead>
         <tr>
         <th>No.</th>
         <th>Nama Sub</th>
         <th>Keterangan</th>
         <th>Status</th>
         <th>Bobot Sub</th>
         <th>Bobot Global</th>
         <th></th>
         </tr>
        </thead>
        <tbody>
        <?php if(empty($qsub)){ ?>
         <tr>
          <td colspan="7">Data tidak ditemukan</td>
         </tr>
        <?php }else{
          $i=0;
          foreach($qsub as $row){ $i++;?>
         <tr>
          <td><?php echo $i ?></td>
          <td><?php echo $row->NAMA_SUB ?></td>
          <td><?php echo $row->KETERANGAN ?></td>
          <td><?php echo $row->STATUS ?></td>
          <td><?php echo $row->BOBOT_SUB ?></td>
          <td><?php echo $row->BOBOT_GLOBAL ?></td>
          <td>
           <a href="<?=base_url()?>admin_sub/form/edit/<?php echo $row->ID_KRITERIA?>/<?php echo $row->ID_SUB ?>" class="btn btn-info btn-sm"><i class="glyphicon glyphicon-pencil"></i></a>
           <a href="<?=base_url()?>admin_sub/hapus/<?php echo $row->ID_SUB ?>/<?php echo $row->ID_KRITERIA ?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda Yakin menghapus data ini?')"><i class="glyphicon glyphicon-trash"></i></a>
          </td>
         </tr>
        <?php }}?>
        </tbody>
       </table>
        </div>
    </div>
    </div>
<?php $this->load->view('footer');?>