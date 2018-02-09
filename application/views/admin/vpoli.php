<?php $this->load->view('header');?>
    <div class="container">
    <div class="panel panel-default">
  <div class="panel-heading"><b>Daftar poli</b></div>
  <div class="panel-body">
    <p><?php echo $this->session->flashdata('pesan')?> </p>
      <a href="admin_poli/form/add" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-plus"></i> Tambah</a>

       <table class="table table-striped">
        <thead>
         <tr>
         <th>No</th>
         <th>Nama poli</th>
         <th>Penanggung Jawab/Kepala Poli</th>
         <th></th>
         </tr>
        </thead>
        <tbody>
        <?php if(empty($qpoli)){ ?>
         <tr>
          <td colspan="4">Data tidak ditemukan</td>
         </tr>
         <?php }else{$i=0;
            foreach($qpoli as $row){ $i++;?>
         <tr>
          <td><?php echo $i ?></td>
          <td><?php echo $row->NAMA_POLI ?></td>
          <td><?php echo $row->PENANGGUNG_JAWAB ?></td>
          <td>
           <a href="<?=base_url()?>admin_poli/form/edit/<?php echo $row->ID_POLI ?>" class="btn btn-info btn-sm"><i class="glyphicon glyphicon-pencil"></i></a>
           <a href="<?=base_url()?>admin_poli/hapus/<?php echo $row->ID_POLI ?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin menghapus data ini? Menghapus data akan menyebabkan semua data yang berkaitan dengan poli ini akan terhapus')"><i class="glyphicon glyphicon-trash"></i></a>
          </td>
         </tr>
        <?php } }?>
        </tbody>
       </table>
        </div>
    </div>
    </div>
<?php $this->load->view('footer');?>