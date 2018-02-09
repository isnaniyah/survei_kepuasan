<?php $this->load->view('header');?>
<?php
if($aksi=='aksi_add'){
    $ID_KRITERIA="";
    $NAMA_KRITERIA="";
    $BOBOT_KRITERIA="";
}else{
 foreach($qkriteria as $rowdata){
    $ID_KRITERIA=$rowdata->ID_KRITERIA;
    $NAMA_KRITERIA=$rowdata->NAMA_KRITERIA;
    $BOBOT_KRITERIA=$rowdata->BOBOT_KRITERIA;
  }
}
?>
<div class="container">
<div class="panel panel-default">
  <div class="panel-heading"><b>Form Data Kriteria</b></div>
  <div class="panel-body">
  <?php echo $this->session->flashdata('pesan')?>
     <form action="<?=base_url()?>admin_kriteria/form/<?=$aksi?>" method="post">
       <table class="table table-striped">
         <tr>
            <input type="hidden" name="ID_KRITERIA" class="form-control" value="<?php echo $ID_KRITERIA?>">
            <input type="hidden" name="BOBOT_KRITERIA" class="form-control" value="<?php echo $BOBOT_KRITERIA?>">
          </tr>
         <tr>
          <td>Nama Kriteria</td>
          <td>
            <div class="col-sm-6">
                <input type="text" name="NAMA_KRITERIA" class="form-control" value="<?php echo $NAMA_KRITERIA?>" required>
          </div>
          </td>
         </tr>
         <tr>
          <td colspan="2">
            <input type="submit" class="btn btn-success" value="Simpan">
            <a href="<?=base_url()?>admin_kriteria" class="btn btn-default">Batal</button>
          </td>
         </tr>
       </table>
     </form>
        </div>
    </div>
    </div>
<?php $this->load->view('footer');?>