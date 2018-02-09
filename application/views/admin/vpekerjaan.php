<?php $this->load->view('header');?>

    <div class="container">

      <!-- Main component for a primary marketing message or call to action -->
      <div class="panel panel-default">
  <div class="panel-heading"><b>Daftar Pekerjaan</b></div>
  <div class="panel-body">
    <p><?php echo $this->session->flashdata('pesan')?> </p>
      <a href="<?=base_url()?>admin_pekerjaan/form/add" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-plus"></i> Tambah</a>

       <table class="table table-striped">
        <thead>
         <tr>
         <th>Pekerjaan</th>
         <th>Keterangan</th>
         <th></th>
         </tr>
        </thead>
        <tbody>
        <?php if(empty($qpekerjaan)){ ?>
         <tr>
          <td colspan="2">Data tidak ditemukan</td>
         </tr>
        <?php }else{
          foreach($qpekerjaan as $row){?>
         <tr>
          <td><?php echo $row->NAMA_PEKERJAAN ?></td>
          <td><?php echo $row->KETERANGAN ?></td>
          <td>
           <a href="<?=base_url()?>admin_pekerjaan/form/edit/<?php echo $row->ID_PEKERJAAN ?>" class="btn btn-info btn-sm"><i class="glyphicon glyphicon-pencil"></i></a>
           <a href="<?=base_url()?>admin_pekerjaan/hapus/<?php echo $row->ID_PEKERJAAN ?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda Yakin menghapus data ini?')"><i class="glyphicon glyphicon-trash"></i></a>
          </td>
         </tr>
        <?php } }?>
        </tbody>
       </table>
        </div>
    </div>    <!-- /panel -->

    </div> <!-- /container -->
<?php $this->load->view('footer');?>