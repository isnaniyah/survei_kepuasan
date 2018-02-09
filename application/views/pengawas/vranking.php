<?php $this->load->view('header_pengawas');?>
<div class="container">
  <div class="panel panel-default">
  <div class="panel-heading"><b>Daftar Ranking</b></div>
  <div class="panel-body">
  <p><?php echo $this->session->flashdata('pesan');?> </p>
  <table width="100%" align="center">
        <tr>
        <td>
  <div class="nav navbar-nav navbar-right">
  <table>
    <tr>
    <?php if(!empty($qranking)){?>
      <td><a href="<?=base_url()?>pengawas_ranking/cetak/<?php echo $id ?>" class="btn btn-info btn-sm"><i class="glyphicon glyphicon-download"></i> Download </a></td>
      <td>&nbsp&nbsp</td>
      <td><a href="<?=base_url()?>pengawas_ranking/perhitungan/<?php echo $id ?>" class="btn btn-warning btn-sm"><i class="glyphicon glyphicon-search"></i> Detail perhitungan</a></td>
      <?php }?>
      <td>
      <?php if(!empty($qperiode)){?>
        <form class="navbar-form navbar-left" role="search" action="<?=base_url()?>pengawas_ranking" method="post">
        <div class="form-group">
        <div class="col-sm-3">
              <select class="form-control" name="ID_PERIODE">
              <?php
              foreach ($qperiode as $rowdata) {

                echo '<option value="'.$rowdata->ID_PERIODE.'"';
                if ($id == $rowdata->ID_PERIODE){
                  echo 'selected="selected"';
                  $periode = "$rowdata->BULAN - $rowdata->TAHUN"; }
                echo '>'.$rowdata->BULAN.' - '.$rowdata->TAHUN.'</option>';
              }
                echo '</select>';?>
          </div>
      </div>
      <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i> Cari</button>
    </form>
    <?php }?>
      </td>
    </tr>
  </table>
  </div>
        </td>
      </tr>
    <tr>
      <td >
      <center>
      <div class="col-md-15">
        <div class="panel panel-primary">
          <div class="panel-heading">Grafik perbandingan hasil akhir setiap poli periode <?php if(!empty($periode)) echo $periode;?></div>
            <div class="panel-body">
              <?php if(empty($qranking)){echo "Data tidak ditemukan"; }?>
              <div id ="mygraph"></div>
            </div>
        </div>
      </div>
      </center>
      </td>
      </tr>
      <tr>
      <td>
        <table class="table table-striped">
        <thead>
         <tr>
         <th>Ranking</th>
         <th>Nama Poli</th>
         <th>Penanggung Jawab</th>
         <th>Jumlah perbaikan pelayanan</th>
         <th>Nilai Akhir</th>
         <th></th>
         </tr>
        </thead>
        <tbody>
        <?php if(empty($qranking)){ ?>
         <tr>
          <td colspan="5">Data tidak ditemukan</td>
         </tr>
        <?php }else{
          $i=0;
          foreach($qranking as $row){
            $i++;?>
         <tr>
          <td><?php echo $i?></td>
          <td><?php echo $row->NAMA_POLI ?></td>
          <td><?php echo $row->PENANGGUNG_JAWAB ?></td>
          <td><?php echo $row->JUMLAH_PERBAIKAN ?></td>
          <td><?php echo $row->NILAI_AKHIR ?></td>
          <td><a href="<?=base_url()?>pengawas_ranking/detail/<?php echo $row->ID_POLI ?>/<?php echo $row->ID_PERIODE ?>" class="btn btn-warning btn-sm"><i class="glyphicon glyphicon-search"></i></a></td>
         </tr>
        <?php }}?>
        </tbody>
       </table>
      </td>
    </tr>
  </table>
       
        </div>
    </div>
  <script>
    var chart1 = null;
    $(document).ready(function() {
        chart1 = new Highcharts.Chart({
         chart: {
          renderTo: 'mygraph',
          type: 'column'
         }, 
         title: {
          text: 'Hasil akhir perhitungan SAW'
         },
         xAxis: {
          categories: ['Poli']
         },
         yAxis: {
          title: {
             text: 'Nilai akhir'
          }
         },
            series:             
          [
            <?php
            foreach ($qranking as $key) {
               $nama_poli = $key->NAMA_POLI;
               $nilai = $key->NILAI_AKHIR;             
            ?>
              {
                name: '<?php echo $nama_poli; ?>',
                data: [<?php echo $nilai; ?>]
              },
              <?php 
            }   ?>
            ]
        });
       });  
  </script>
    </div> <!-- /container -->
<?php $this->load->view('footer');?>