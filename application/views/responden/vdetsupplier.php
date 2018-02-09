<?php $this->load->view('header_petugas');?>
<?php
 foreach($qsupplier as $rowdata){
    $NAMA_SUPPLIER=$rowdata->NAMA_SUPPLIER;
    $ALAMAT=$rowdata->ALAMAT;
    $NO_TELP=$rowdata->NO_TELP;
  }
?>
    <div class="container">
      <div class="panel panel-default">
  <div class="panel-heading"><b>Detail Data Supplier</b></div>
  <div class="panel-body">
     <p> <a href="<?=base_url()?>petugas_supplier" class="btn btn-sm btn-info"><i class="glyphicon glyphicon-repeat"></i> Kembali</a>
     </p>

       <table class="table table-striped">
         <tr>
          <td>Nama Supplier</td>
          <td><?php echo $NAMA_SUPPLIER?></td>
         </tr>
         <tr>
          <td>Alamat</td>
          <td><?php echo $ALAMAT?></td>
          </tr>
         <tr>
          <td>No Telepon</td>
          <td><?php echo $NO_TELP?></td>
          </tr>
       </table>
        </div>
    </div>    <!-- /panel -->
    </div> <!-- /container -->
<?php $this->load->view('footer');?>