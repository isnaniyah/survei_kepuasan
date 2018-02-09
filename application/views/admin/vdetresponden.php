<?php $this->load->view('header');?>
<?php
 foreach($qresponden as $rowdata){
    $ID_RESPONDEN=$rowdata->ID_RESPONDEN;
    $NAMA=$rowdata->NAMA;
    $UMUR=$rowdata->UMUR;
    $NAMA_POLI=$rowdata->NAMA_POLI;
    $WAKTU_INPUT=$rowdata->WAKTU_INPUT;
    $JENIS_KELAMIN=$rowdata->JENIS_KELAMIN;
    $PENDIDIKAN=$rowdata->NAMA_PENDIDIKAN;
    $PEKERJAAN=$rowdata->NAMA_PEKERJAAN;
    $TANGGUNGAN_BIAYA=$rowdata->NAMA_TANGGUNGAN_BIAYA;
  }
?>
    <div class="container">

      <!-- Main component for a primary marketing message or call to action -->
      <div class="panel panel-default">
  <div class="panel-heading"><b>Detail Data Reponden</b></div>
  <div class="panel-body">
     <p><input type="button" value="Kembali" onclick="history.back(-1)" class="btn btn-sm btn-info"/></p>
     </p>

       <table class="table table-striped">
         <tr>
          <td>Nama Reponden</td>
          <td><?php echo $NAMA?></td>
        </tr>
         <tr>
          <td>Umur Reponden</td>
          <td><?php echo $UMUR?></td>
        </tr>
        <tr>
          <td>Poli yang Dinilai</td>
          <td><?php echo $NAMA_POLI?></td>
        </tr>
        <tr>
          <td>Waktu Survei</td>
          <td><?php echo $WAKTU_INPUT?></td>
        </tr>
        <tr>
          <td>Jenis Kelamin</td>
          <td><?php echo $JENIS_KELAMIN?></td>
        </tr>
        <tr>
          <td>Pendidikan Terakhir</td>
          <td><?php echo $PENDIDIKAN?></td>
        </tr>
        <tr>
          <td>Pekerjaan</td>
          <td><?php echo $PEKERJAAN?></td>
        </tr>
        <tr>
          <td>Tanggungan Biaya</td>
          <td><?php echo $TANGGUNGAN_BIAYA?></td>
        </tr>
       </table>
        </div>
    </div>    <!-- /panel -->
    </div> <!-- /container -->
<?php $this->load->view('footer');?>