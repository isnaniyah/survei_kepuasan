<?php $this->load->view('header_petugas');
     foreach($qnilai as $rowdata){
        $ID_NILAI=$rowdata->ID_NILAI;
        $ID_SUPPLIER=$rowdata->ID_SUPPLIER;
        $ID_SUB=$rowdata->ID_SUB;
        $ID_TAHUN=$rowdata->ID_TAHUN;
        $NILAI_MATRIKS=$rowdata->NILAI_MATRIKS;
        $NILAI_NORMALISASI=$rowdata->NILAI_NORMALISASI;
        foreach ($qsub as $row) {
          if ($rowdata->ID_SUB == $row->ID_SUB) {
            $sub = $row->NAMA_SUB;
          }
        }
  }
?>
<div class="container">
      <!-- Main component for a primary marketing message or call to action -->
<div class="panel panel-default">
  <div class="panel-heading"><b>Form Data Penilaian</b></div>
  <div class="panel-body">
  <?php echo $this->session->flashdata('pesan');
    ?>
     <form action="<?=base_url()?>petugas_nilai/form/<?=$aksi?>" method="post">
       <table class="table table-striped">
        <tr>
          <th>Sub Kategori</th>
          <th>Nilai</th>
        </tr>
       <input type="hidden" name="ID_NILAI" class="form-control" value="<?php echo $ID_NILAI?>">
       <input type="hidden" name="ID_SUPPLIER" class="form-control" value="<?php echo $ID_SUPPLIER?>">
       <input type="hidden" name="ID_SUB" class="form-control" value="<?php echo $ID_SUB?>">
       <input type="hidden" name="ID_TAHUN" class="form-control" value="<?php echo $ID_TAHUN?>">
       <input type="hidden" name="NILAI_NORMALISASI" class="form-control" value="<?php echo $NILAI_NORMALISASI?>">
       <tr>
          <td>
            <?php echo $sub?>
          </td>
          <td>
            <div class="col-sm-3">
              <input type="text" name="NILAI_MATRIKS" class="form-control" value="<?php echo $NILAI_MATRIKS?>" required>
            </div>
          </td>
        </tr>
         <tr>
          <td colspan="2">
            <input type="submit" class="btn btn-success" value="Simpan">
            <a href="javascript:window.history.go(-1);" class="btn btn-default">Batal</button></a>
          </td>
         </tr>
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