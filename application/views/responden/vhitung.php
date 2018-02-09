<?php $this->load->view('header_petugas');?>
<?php foreach ($qtahun as $row) {
  $tahun = $row->ID_TAHUN;
}
?>
<div class="container">
<p> <a href="<?=base_url()?>petugas_ranking/detail/<?php echo $tahun?>" class="btn btn-sm btn-info"><i class="glyphicon glyphicon-repeat"></i> Kembali</a>
  <div class="panel panel-default">
    </p>
    <div class="panel-heading"><b>Nilai Matriks</b></div>
    <div class="panel-body">
      <table class="table table-striped">
        <thead>
         <tr>
         <th>Alternatif</th>
         <?php
         foreach ($qsub as $row) {?>
           <th><?php echo $row->NAMA_SUB ?></th>
         <?php }?>
         </tr>
        </thead>
        <tbody>
        <tr>
        <?php
          foreach ($qsupplier as $rowdata) {
            $id = $rowdata->ID_SUPPLIER;
            $nama = $rowdata->NAMA_SUPPLIER;?>
            <td><?php echo $nama;?></td>
            <?php foreach ($qnilai as $nilai) {
            if ($id == $nilai->ID_SUPPLIER) {
              foreach ($qsub as $sub) {
                if ($sub->ID_SUB == $nilai->ID_SUB) {?>
                  <td><?php echo $nilai->NILAI_MATRIKS?></td>
                <?php }
              }
            }
          }
          echo '</tr>';
        }
        ?>
        </tbody>
      </table>
    </div>
    <div class="panel-heading"><b>Nilai Normalisasi</b></div>
    <div class="panel-body">
      <table class="table table-striped">
        <thead>
         <tr>
         <th>Alternatif</th>
         <?php
         foreach ($qsub as $row) {?>
           <th><?php echo $row->NAMA_SUB ?></th>
         <?php }?>
         </tr>
        </thead>
        <tbody>
        <tr>
        <?php
          foreach ($qsupplier as $rowdata) {
            $id = $rowdata->ID_SUPPLIER;
            $nama = $rowdata->NAMA_SUPPLIER;?>
            <td><?php echo $nama;?></td>
            <?php foreach ($qnilai as $nilai) {
            if ($id == $nilai->ID_SUPPLIER) {
              foreach ($qsub as $sub) {
                if ($sub->ID_SUB == $nilai->ID_SUB) {?>
                  <td><?php echo $nilai->NILAI_NORMALISASI?></td>
                <?php }
              }
            }
          }
          echo '</tr>';
        }
        ?>
        </tbody>
      </table>
    </div>
    <div class="panel-heading"><b>Nilai Bobot</b></div>
    <div class="panel-body">
      <table class="table table-striped">
        <thead>
         <tr>
         <th>Alternatif</th>
         <th>Nilai Bobot</th>
         </tr>
        </thead>
        <tbody>
        <tr>
        <?php
          foreach ($qsupplier as $rowdata) {
            $id = $rowdata->ID_SUPPLIER;
            $nama = $rowdata->NAMA_SUPPLIER;?>
            <td><?php echo $nama;?></td>
            <?php foreach ($qranking as $rank) {
            if ($id == $rank->ID_SUPPLIER) {?>
              <td><?php echo $rank->NILAI_AKHIR;?></td>
            <?php }
          }
          echo '</tr>';
        }
        ?>
        </tbody>
      </table>
    </div>
  </div>    <!-- /panel -->
</div> <!-- /container -->
<?php $this->load->view('footer');?>