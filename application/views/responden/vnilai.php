    <div class="container">

      <!-- Main component for a primary marketing message or call to action -->
      <div class="panel panel-default">
  <div class="panel-heading"><b>Daftar Tahun Penilaian</b></div>
  <div class="panel-body">
    <p><?php echo $this->session->flashdata('pesan')?> </p>
    <?php foreach($qsupplier as $row){
      $ID_SUPPLIER = $row->ID_SUPPLIER;
      }?>
      <a href="<?=base_url()?>petugas_nilai/form/add/<?php echo $ID_SUPPLIER ?>" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-plus"></i> Tambah</a>
       <table class="table table-striped">
        <thead>
         <tr>
         <th>No</th>
         <th>Tahun</th>
         <th></th>
         </tr>
        </thead>
        <tbody>
        <?php if(empty($qnilai)){ ?>
         <tr>
          <td colspan="6">Data tidak ditemukan</td>
         </tr>
        <?php }else{
          $i=0;
          foreach($qnilai as $row){
            $i++;
            foreach ($qtahun as $rowdata) {
              if ($row->ID_TAHUN == $rowdata->ID_TAHUN) {
                $tahunnya = $rowdata->TAHUN;
              }
            }
            ?>
         <tr>
          <td><?php echo $i ?></td>
          <td><?php echo $tahunnya ?></td>
          <td>
           <a href="<?=base_url()?>petugas_nilai/detail/<?php echo $row->ID_TAHUN?>/<?php echo $row->ID_SUPPLIER ?>" class="btn btn-warning btn-sm"><i class="glyphicon glyphicon-search"></i></a>
           <a href="<?=base_url()?>petugas_nilai/delete/<?php echo $row->ID_TAHUN?>/<?php echo $row->ID_SUPPLIER ?>"class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin menghapus data ini? Semua data yang terkait akan ikut terhapus')"><i class="glyphicon glyphicon-trash"></i></a>
          </td>
         </tr>
        <?php }}?>
        </tbody>
       </table>
        </div>
    </div>