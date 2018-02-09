<?php $this->load->view('header');?>
<div class="container">
      <!-- Main component for a primary marketing message or call to action -->
<div class="panel panel-default">
  <div class="panel-heading"><b>Form Atur Ulang Bobot Kriteria</b></div>
  <div class="panel-body">
  <?php echo $this->session->flashdata('pesan');
    ?>
     <form action="<?=base_url()?>admin_kriteria/proses_edit" method="post">
       <table class="table table-hover">
        <?php if(empty($qkriteria)){ ?>
         <tr>
          <td colspan="3">Data tidak ditemukan</td>
         </tr>
        <?php }else{ ?>
        <tr>
          <th>No.</th>
          <th>Kriteria</th>
          <th>Bobot (%)</th>
        </tr>
       <?php
       $i=0;
       foreach ($qkriteria as $row) {?>
        <input type="hidden" name="ID_KRITERIA[]" class="form-control" value="<?php echo $row->ID_KRITERIA?>">
        <input type="hidden" name="NAMA_KRITERIA[]" class="form-control" value="<?php echo $row->NAMA_KRITERIA?>">
        <tr>
          <td>
            <?php echo $i+1?>
          </td>
          <td>
            <?php echo $row->NAMA_KRITERIA;?>
          </td>
          <td>
              <div class="col-sm-3">
              <input type="text" name="BOBOT_KRITERIA[]" class="form-control" value="<?php echo $row->BOBOT_KRITERIA?>" required>
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