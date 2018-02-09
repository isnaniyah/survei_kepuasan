<?php $this->load->view('header_petugas');?>
<div class="container">
      <!-- Main component for a primary marketing message or call to action -->
<div class="panel panel-default">
  <div class="panel-heading"><b>Form Data Penilaian</b></div>
  <div class="panel-body">
  <?php echo $this->session->flashdata('pesan');
    ?>
     <form action="<?=base_url()?>petugas_nilai/form/<?=$aksi?>" method="post">
       <table class="table table-hover">
       <tr>
          <th colspan="3">Tahun Penilaian</th>
        </tr>
        <tr>
          <td colspan="4"><div class="col-sm-3">
              <select class="form-control" name="ID_TAHUN">
              <?php foreach ($qtahun as $rowdata) {
                echo '<option value="'.$rowdata->ID_TAHUN.'" >'.$rowdata->TAHUN.'</option>';
                }
                echo '</select>';?>
          </div>
          </td>
          </tr>
        <?php if(empty($qsub)){ ?>
         <tr>
          <td colspan="3">Data tidak ditemukan</td>
         </tr>
        <?php }else{ ?>
        <tr>
          <th>No.</th>
          <th>Sub Kriteria</th>
          <th>Nilai</th>
        </tr>
       <?php
       $i=0;
       foreach ($qsupplier as $row) {
         $ID_SUPPLIER=$row->ID_SUPPLIER;
       }
       foreach ($qsub as $row) {
        $ID_SUB=$row->ID_SUB;
        $NAMA_SUB=$row->NAMA_SUB;?>
        <input type="hidden" name="ID_NILAI[]" class="form-control">
        <input type="hidden" name="ID_SUB[]" class="form-control" value="<?php echo $ID_SUB?>">
        <input type="hidden" name="ID_SUPPLIER" class="form-control" value="<?php echo $ID_SUPPLIER?>">
        <tr>
          <td>
            <?php echo $i+1?>
          </td>
          <td>
            <?php echo $NAMA_SUB;?>
          </td>
          <td>
              <div class="col-sm-3">
              <input type="text" name="NILAI_MATRIKS[]" class="form-control" required>
              </div>
          </td>
        </tr>
         <?php $i++;
                 } ?>
         <tr>
          <td colspan="4">
            <input type="submit" class="btn btn-success" value="Simpan">
            <a href="<?=base_url()?>petugas_supplier/detail/<?php echo $ID_SUPPLIER?>" class="btn btn-default">Batal</button>
          </td>
         </tr>
         <?php } ?>
       </table>
     </form>
        </div>
        
     <div class="panel-heading"><b>Keterangan</b></div>
     <div class="panel-body">
     <p>Silahkan isi nilai untuk setiap supplier. Apabila sub kriteria berupa kualitas(bukan dalam angka), silahkan masukan angka 1-5 sesuai dengan penilaian</p>
       </div>
    </div>    <!-- /panel -->

    </div> <!-- /container -->
<?php $this->load->view('footer');?>