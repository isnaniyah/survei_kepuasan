<?php $this->load->view('header');?>
<div class="container">
      <!-- Main component for a primary marketing message or call to action -->
<div class="panel panel-default">
  <div class="panel-heading"><b>Form Atur Ulang Bobot Kriteria</b></div>
  <div class="panel-body">
  <?php echo $this->session->flashdata('pesan');
  foreach ($qkriteria as $rowdata) {
    $ID_KRITERIA = $rowdata->ID_KRITERIA;
  }
    ?>
     <form action="<?=base_url()?>admin_sub/proses_edit/<?php echo $ID_KRITERIA?>" method="post">
       <table class="table table-hover">
        <?php if(empty($qsub)){ ?>
         <tr>
          <td colspan="3">Tidak ada data Sub kriteria yang Aktif</td>
         </tr>
         <p> <a href="<?=base_url()?>admin_kriteria/detail/<?php echo $ID_KRITERIA?>" class="btn btn-sm btn-info"><i class="glyphicon glyphicon-repeat"></i> Kembali</a>
        <?php }else{ ?>
        <tr>
          <th>No.</th>
          <th>Kriteria</th>
          <th>Bobot (%)</th>
        </tr>
       <?php
       $i=0;
       foreach ($qsub as $row) {?>
        <input type="hidden" name="ID_SUB[]" class="form-control" value="<?php echo $row->ID_SUB?>">
        <input type="hidden" name="NAMA_SUB[]" class="form-control" value="<?php echo $row->NAMA_SUB?>">
        <tr>
          <td>
            <?php echo $i+1?>
          </td>
          <td>
            <?php echo $row->NAMA_SUB;?>
          </td>
          <td>
              <div class="col-sm-4">
              <input type="text" name="BOBOT_SUB[]" class="form-control" value="<?php echo $row->BOBOT_SUB?>" required>
              </div>
          </td>
        </tr>
         <?php $i++;
                 } ?>
         <tr>
          <td colspan="4">
            <input type="submit" class="btn btn-success" value="Simpan">
          </td>
         </tr>
         <?php } ?>
       </table>
     </form>
        </div>
    </div>    <!-- /panel -->

    </div> <!-- /container -->
<?php $this->load->view('footer');?>