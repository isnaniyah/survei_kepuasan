<?php $this->load->view('header_petugas');?>

    <div class="container">

      <!-- Main component for a primary marketing message or call to action -->
      <div class="panel panel-default">
  <div class="panel-heading"><b>Daftar Supplier</b></div>
  <div class="panel-body">
  <p><?php echo $this->session->flashdata('pesan')?> </p>
       <table class="table table-striped">
        <thead>
         <tr>
         <th>No</th>
         <th>Nama</th>
         <th>Alamat</th>
         <th>No Telp</th>
         <th></th>
         </tr>
        </thead>
        <tbody>
        <?php if(empty($qsupplier)){ ?>
         <tr>
          <td colspan="5">Data tidak ditemukan</td>
         </tr>
        <?php }else{
          $i=0;
          foreach($qsupplier as $row){ $i++;?>
         <tr>
          <td><?php echo $i ?></td>
          <td><?php echo $row->NAMA_SUPPLIER ?></td>
          <td><?php echo $row->ALAMAT ?></td>
          <td><?php echo $row->NO_TELP ?></td>
          <td>
           <a href="<?=base_url()?>petugas_supplier/detail/<?php echo $row->ID_SUPPLIER ?>" class="btn btn-warning btn-sm"><i class="glyphicon glyphicon-search"></i></a>
          </td>
         </tr>
        <?php }}?>
        </tbody>
       </table>
        </div>
    </div>    <!-- /panel -->

    </div> <!-- /container -->
<?php $this->load->view('footer');?>