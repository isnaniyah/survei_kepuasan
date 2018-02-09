<?php $this->load->view('header');?>
<div class="container">
      <!-- Main component for a primary marketing message or call to action -->
  <div class="panel panel-default">
  <?php if ($ket!='byid') { ?>
    <div class="panel-heading"><b>Daftar User</b></div>
  <?php }else {?>
    <div class="panel-heading"><b>Ubah Password</b></div>
  <?php } ?>
  
  <div class="panel-body">
    <p><?php echo $this->session->flashdata('pesan')?> </p>
    <?php if ($ket!='byid') { ?>
      <a href="admin_user/form/add/<?php echo $ket ?>" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-plus"></i> Tambah</a>
    <?php }?>
       <table class="table table-striped">
        <thead>
         <tr>
         <th>Username</th>
         <th>Nama</th>
         <th>Hak Akses</th>
         <th></th>
         </tr>
        </thead>
        <tbody>
        <?php if(empty($quser)){ ?>
         <tr>
          <td colspan="4">Data tidak ditemukan</td>
         </tr>
        <?php }else{
          foreach($quser as $row){?>
         <tr>
          <td><?php echo $row->USERNAME ?></td>
          <td><?php echo $row->NAMA_USER ?></td>
          <td><?php echo $row->HAK_AKSES ?></td>
          <td>
            <a href="<?=base_url()?>admin_user/form/edit/<?php echo $ket ?>/<?php echo $row->USERNAME ?>" class="btn btn-info btn-sm"><i class="glyphicon glyphicon-pencil"></i></a>
            <?php if ($ket!='byid' && $row->USERNAME != $user) { ?>
            <a href="<?=base_url()?>admin_user/hapus/<?php echo $row->USERNAME ?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda Yakin menghapus data ini?')"><i class="glyphicon glyphicon-trash"></i></a>
            <?php }?>
          </td>
         </tr>
        <?php }}?>
        </tbody>
       </table>
        </div>
    </div>
        </div> <!-- /container -->
<?php $this->load->view('footer');?>