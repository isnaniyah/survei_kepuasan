<?php $this->load->view('header_pengawas');?>
<?php
 foreach($qranking as $rowdata){
    $NAMA_POLI =$rowdata->NAMA_POLI;
    $BULAN =$rowdata->BULAN;
    $TAHUN =$rowdata->TAHUN;
    $PENANGGUNG_JAWAB =$rowdata->PENANGGUNG_JAWAB;
    $JUMLAH_PERBAIKAN =$rowdata->JUMLAH_PERBAIKAN;
    $NILAI_AKHIR=$rowdata->NILAI_AKHIR;
  }
?>
    <div class="container">

      <!-- Main component for a primary marketing message or call to action -->
      <div class="panel panel-default">
  <div class="panel-heading"><b>Detail Data Kriteria</b></div>
  <div class="panel-body">
     <p><input type="button" value="Kembali" onclick="history.back(-1)" class="btn btn-sm btn-info"/></p>

       <table class="table table-striped">
         <tr>
          <td>Nama Poli</td>
          <td><?php echo $NAMA_POLI?></td>
          </tr>
         <tr>
          <td>Periode</td>
          <td><?php echo $BULAN?> - <?php echo $TAHUN?></td>
          </tr>
         <tr>
          <td>Penanggung Jawab Poli</td>
          <td><?php echo $PENANGGUNG_JAWAB?></td>
          </tr>
         <tr>
          <td>Jumlah Perbaikan</td>
          <td><?php echo $JUMLAH_PERBAIKAN?></td>
          </tr>
         <tr>
          <td>Nilai Akhir</td>
          <td><?php echo $NILAI_AKHIR?></td>
          </tr>
       </table>
        </div>
    </div>    <!-- /panel -->
    </div> <!-- /container -->
<?php $this->load->view('footer');?>