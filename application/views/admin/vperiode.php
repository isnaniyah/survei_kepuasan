<?php $this->load->view('header');?>
    <div class="container">
    <div class="panel panel-default">
  <div class="panel-heading"><b>Daftar periode</b></div>
  <div class="panel-body">
    <p><?php echo $this->session->flashdata('pesan')?> </p>
       <table class="table table-striped">
        <thead>
         <tr>
         <th>No </th>
         <th>Bulan</th>
         <th>Tahun</th>
         <th></th>
         </tr>
        </thead>
        <tbody>
        <?php if(empty($qperiode)){ ?>
         <tr>
          <td colspan="4">Data tidak ditemukan</td>
         </tr>
         <?php }else{
          $i=0;
            foreach($qperiode as $row){$i++;?>
         <tr>
          <td><?php echo $i ?></td>
          <td><?php echo $row->BULAN ?></td>
          <td><?php echo $row->TAHUN ?></td>
          <td>
           <a href="<?=base_url()?>admin_periode/detail/<?php echo $row->ID_PERIODE ?>" class="btn btn-warning btn-sm"><i class="glyphicon glyphicon-search"></i></a>
           <a href="<?=base_url()?>admin_periode/hapus/<?php echo $row->ID_PERIODE ?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin menghapus data ini? Menghapus data akan menyebabkan semua data yang berkaitan dengan periode ini akan terhapus')"><i class="glyphicon glyphicon-trash"></i></a>
          </td>
         </tr>
        <?php } }?>
        </tbody>
       </table>
        </div>
    </div>
    </div>
<?php $this->load->view('footer');?>