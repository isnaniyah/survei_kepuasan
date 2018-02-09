<?php $this->load->view('header');?>
<?php
if($aksi=='aksi_add'){
    $ID_PENDIDIKAN="";
    $NAMA_PENDIDIKAN="";
    $KETERANGAN="";
}else{
 foreach($qpendidikan as $rowdata){
    $ID_PENDIDIKAN=$rowdata->ID_PENDIDIKAN;
    $NAMA_PENDIDIKAN=$rowdata->NAMA_PENDIDIKAN;
    $KETERANGAN=$rowdata->KETERANGAN;
  }
}

?>
<div class="container">
<div class="panel panel-default">
  <div class="panel-heading"><b>Form Data Pendidikan</b></div>
  <div class="panel-body">
  <?php echo $this->session->flashdata('pesan')?>
     <form action="<?=base_url()?>admin_pendidikan/form/<?=$aksi?>" method="post">
       <table class="table table-striped">
       <input type="hidden" name="ID_PENDIDIKAN" class="form-control" value="<?php echo $ID_PENDIDIKAN?>">
         <tr>
          <td>Pendidikan</td>
          <td>
          <div class="col-sm-5">
            <input type="text" name="NAMA_PENDIDIKAN" class="form-control" value="<?php echo $NAMA_PENDIDIKAN?>" required>
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
            <a href="<?=base_url()?>admin_pendidikan" class="btn btn-default">Batal</button>
          </td>
         </tr>
       </table>
     </form>
        </div>
    </div>    <!-- /panel -->

    </div> <!-- /container -->
<?php $this->load->view('footer');?>