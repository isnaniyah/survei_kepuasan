<?php $this->load->view('header');?>
<?php
if($aksi=='aksi_add'){
    $ID_POLI="";
    $NAMA_POLI="";
    $PENANGGUNG_JAWAB="";
}else{
 foreach($qpoli as $rowdata){
    $ID_POLI=$rowdata->ID_POLI;
    $NAMA_POLI=$rowdata->NAMA_POLI;
    $PENANGGUNG_JAWAB=$rowdata->PENANGGUNG_JAWAB;
  }
}

?>
<div class="container">
<div class="panel panel-default">
  <div class="panel-heading"><b>Form Data POLI</b></div>
  <div class="panel-body">
  <?php echo $this->session->flashdata('pesan')?>
     <form action="<?=base_url()?>admin_poli/form/<?=$aksi?>" method="post">
       <table class="table table-striped">
       <input type="hidden" name="ID_POLI" class="form-control" value="<?php echo $ID_POLI?>">
         <tr>
          <td>Nama Poli</td>
          <td>
            <div class="col-sm-4">
                <input type="text" name="NAMA_POLI" class="form-control" value="<?php echo $NAMA_POLI?>" required>
          </div>
          </td>
         </tr>
         <tr>
          <td>Penanggung Jawab/Kepala Poli</td>
          <td>
          <div class="col-sm-5">
            <textarea name="PENANGGUNG_JAWAB" class="form-control" required ><?php echo $PENANGGUNG_JAWAB?></textarea>
          </div>
          </td>
         </tr>
         <tr>
          <td colspan="2">
            <input type="submit" class="btn btn-success" value="Simpan">
            <a href="<?=base_url()?>admin_poli" class="btn btn-default">Batal</button>
          </td>
         </tr>
       </table>
     </form>
        </div>
    </div>    <!-- /panel -->

    </div> <!-- /container -->
<?php $this->load->view('footer');?>