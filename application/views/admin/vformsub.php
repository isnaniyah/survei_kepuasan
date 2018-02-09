<?php $this->load->view('header');?>
<?php
if($aksi=='aksi_add'){
    $ID_SUB="";
    $NAMA_SUB="";
    $JENIS_KRITERIA="";
    $KETERANGAN="";
    $STATUS="";
    $BOBOT_SUB="";
    foreach($qkriteria as $row) {
      $ID_KRITERIA = $row->ID_KRITERIA;
    }
}else{
 foreach($qsub as $rowdata){
    $ID_SUB=$rowdata->ID_SUB;
    $ID_KRITERIA=$rowdata->ID_KRITERIA;
    $NAMA_SUB=$rowdata->NAMA_SUB;
    $JENIS_KRITERIA=$rowdata->JENIS_KRITERIA;
    $KETERANGAN=$rowdata->KETERANGAN;
    $STATUS=$rowdata->STATUS;
    $BOBOT_SUB=$rowdata->BOBOT_SUB;
  }
}
?>
<div class="container">
<div class="panel panel-default">
  <div class="panel-heading"><b>Form Data Sub Kriteria</b></div>
  <div class="panel-body">
  <?php echo $this->session->flashdata('pesan')?>
     <form action="<?=base_url()?>admin_sub/form/<?=$aksi?>" method="post">
       <table class="table table-striped">
         <tr>
            <input type="hidden" name="ID_SUB" class="form-control" value="<?php echo $ID_SUB?>">
            <input type="hidden" name="BOBOT_SUB" class="form-control" value="<?php echo $BOBOT_SUB?>">
            <input type="hidden" name="ID_KRITERIA" class="form-control" value="<?php echo $ID_KRITERIA ?>">
          </tr>
         <tr>
          <td>Pernyataan</td>
          <td>
            <div class="col-sm-6">
                <input type="text" name="NAMA_SUB" class="form-control" value="<?php echo $NAMA_SUB?>" required>
          </div>
          </td>
         </tr>
         <tr>
          <td>Jenis Kriteria</td>
          <td>
            <div class="col-sm-3">
            <select class="form-control" name="JENIS_KRITERIA">
              <option value="Benefit" <?php if($aksi=="aksi_edit"){if($JENIS_KRITERIA=='Benefit') {echo"selected";}}?> >Benefit</option>
              <option value="Cost" <?php if($aksi=="aksi_edit"){if($JENIS_KRITERIA=='Cost') {echo"selected";}}?> >Cost</option>
            </select>
            </div>
            </td>
         </tr>
         <tr>
          <td>Keterangan</td>
          <td>
          <div class="col-sm-10">
          <textarea name="KETERANGAN" class="form-control" required><?php echo $KETERANGAN?></textarea>
          </div>
          </td>
         </tr>
         <tr>
          <td>Status</td>
          <td>
            <div class="col-sm-3">
            <select class="form-control" name="STATUS">
              <option value="Aktif" <?php if($aksi=="aksi_edit"){if($STATUS=='Aktif') {echo"selected";}}?> >Aktif</option>
              <option value="Nonaktif" <?php if($aksi=="aksi_edit"){if($STATUS=='Nonaktif') {echo"selected";}}?> >Nonaktif</option>
            </select>
            </div>
            </td>
         </tr>
         <tr>
          <td colspan="2">
            <input type="submit" class="btn btn-success" value="Simpan">
            <a href="<?=base_url()?>admin_kriteria/detail/<?php echo $ID_KRITERIA;?>" class="btn btn-default">Batal</button>
          </td>
         </tr>
       </table>
     </form>
        </div>
    </div>
    </div>
<?php $this->load->view('footer');?>