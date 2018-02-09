<?php $this->load->view('header');?>
<?php
 foreach($qkriteria as $rowdata){
    $ID_KRITERIA=$rowdata->ID_KRITERIA;
    $NAMA_KRITERIA=$rowdata->NAMA_KRITERIA;
    $BOBOT_KRITERIA=$rowdata->BOBOT_KRITERIA;
  }
?>
    <div class="container">

      <!-- Main component for a primary marketing message or call to action -->
      <div class="panel panel-default">
  <div class="panel-heading"><b>Detail Data Kriteria</b></div>
  <div class="panel-body">
     <p> <a href="<?=base_url()?>admin_kriteria" class="btn btn-sm btn-info"><i class="glyphicon glyphicon-repeat"></i> Kembali</a>
     </p>

       <table class="table table-striped">
         <tr>
          <td>Nama Kriteria</td>
          <td><?php echo $NAMA_KRITERIA?></td>
          </tr>
         <tr>
          <td>Bobot Kriteria</td>
          <td><?php echo $BOBOT_KRITERIA?></td>
          </tr>
       </table>
        </div>
    </div>    <!-- /panel -->
    </div> <!-- /container -->
<?php $this->load->view('footer');?>