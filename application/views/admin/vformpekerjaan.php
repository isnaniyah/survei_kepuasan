<?php $this->load->view('header');?>
<?php
if($aksi=='aksi_add'){
    $ID_PEKERJAAN="";
    $NAMA_PEKERJAAN="";
    $KETERANGAN="";
}else{
 foreach($qpekerjaan as $rowdata){
    $ID_PEKERJAAN=$rowdata->ID_PEKERJAAN;
    $NAMA_PEKERJAAN=$rowdata->NAMA_PEKERJAAN;
    $KETERANGAN=$rowdata->KETERANGAN;
  }
}

?>
<div class="container">
<div class="panel panel-default">
  <div class="panel-heading"><b>Form Data Pekerjaan</b></div>
  <div class="panel-body">
  <?php echo $this->session->flashdata('pesan')?>
     <form action="<?=base_url()?>admin_pekerjaan/form/<?=$aksi?>" method="post">
       <table class="table table-striped">
       <input type="hidden" name="ID_PEKERJAAN" class="form-control" value="<?php echo $ID_PEKERJAAN?>">
         <tr>
          <td>Pekerjaan</td>
          <td>
          <div class="col-sm-5">
            <input type="text" name="NAMA_PEKERJAAN" class="form-control" value="<?php echo $NAMA_PEKERJAAN?>" required>
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
            <a href="<?=base_url()?>admin_pekerjaan" class="btn btn-default">Batal</button>
          </td>
         </tr>
       </table>
     </form>
        </div>
    </div>    <!-- /panel -->

    </div> <!-- /container -->
<?php $this->load->view('footer');?>