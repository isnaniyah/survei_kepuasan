<?php $this->load->view('header');?>
<?php
if($aksi=='aksi_add'){
    $ID_TANGGUNGAN_BIAYA="";
    $NAMA_TANGGUNGAN_BIAYA="";
    $KETERANGAN="";
}else{
 foreach($qtanggungan_biaya as $rowdata){
    $ID_TANGGUNGAN_BIAYA=$rowdata->ID_TANGGUNGAN_BIAYA;
    $NAMA_TANGGUNGAN_BIAYA=$rowdata->NAMA_TANGGUNGAN_BIAYA;
    $KETERANGAN=$rowdata->KETERANGAN;
  }
}

?>
<div class="container">
<div class="panel panel-default">
  <div class="panel-heading"><b>Form Data Tanggungan Biaya</b></div>
  <div class="panel-body">
  <?php echo $this->session->flashdata('pesan')?>
     <form action="<?=base_url()?>admin_tanggungan_biaya/form/<?=$aksi?>" method="post">
       <table class="table table-striped">
       <input type="hidden" name="ID_TANGGUNGAN_BIAYA" class="form-control" value="<?php echo $ID_TANGGUNGAN_BIAYA?>">
         <tr>
          <td>Tanggungan Biaya</td>
          <td>
          <div class="col-sm-5">
            <input type="text" name="NAMA_TANGGUNGAN_BIAYA" class="form-control" value="<?php echo $NAMA_TANGGUNGAN_BIAYA?>" required>
          </div>
          </td>
         </tr>
         <tr>
          <td>Keterangan</td>
          <td>
          <div class="col-sm-5">
            <textarea rows="10" cols="60" name="KETERANGAN" class="form-control"><?php echo $KETERANGAN?></textarea>
          </div>
          </td>
         </tr>
         <tr>
          <td colspan="2">
            <input type="submit" class="btn btn-success" value="Simpan">
            <a href="<?=base_url()?>admin_tanggungan_biaya" class="btn btn-default">Batal</button>
          </td>
         </tr>
       </table>
     </form>
        </div>
    </div>    <!-- /panel -->

    </div> <!-- /container -->
<?php $this->load->view('footer');?>