<?php $this->load->view('header');?>
<?php
if($aksi=='aksi_add'){
    $ID_TAHUN="";
    $TAHUN="";
}else{
 foreach($qumk as $rowdata){
    $ID_TAHUN=$rowdata->ID_TAHUN;
    $TAHUN=$rowdata->TAHUN;
  }
}

?>
<div class="container">
<div class="panel panel-default">
  <div class="panel-heading"><b>Form Data Tahun</b></div>
  <div class="panel-body">
  <?php echo $this->session->flashdata('pesan')?>
     <form action="<?=base_url()?>admin_tahun/form/<?=$aksi?>" method="post">
       <table class="table table-striped">
       <input type="hidden" name="ID_TAHUN" class="form-control" value="<?php echo $ID_TAHUN?>">
         <tr>
          <td>Tahun</td>
          <td>
          <div class="col-sm-3">
            <input type="text" name="TAHUN" class="form-control" value="<?php echo $TAHUN?>" required>
          </div>
          </td>
         </tr>
         <tr>
          <td colspan="2">
            <input type="submit" class="btn btn-success" value="Simpan">
            <a href="<?=base_url()?>admin_tahun" class="btn btn-default">Batal</button>
          </td>
         </tr>
       </table>
     </form>
        </div>
    </div>    <!-- /panel -->

    </div> <!-- /container -->
<?php $this->load->view('footer');?>