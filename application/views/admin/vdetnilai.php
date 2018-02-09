<?php $this->load->view('header');?>
    <div class="container">
      <?php foreach ($qnilai as $row) {
    foreach ($qtahun as $rowtahun) {
      if ($row->ID_TAHUN == $rowtahun->ID_TAHUN) {
        $tahun = $rowtahun->TAHUN;
      }
    }
  }?>
    <div class="panel panel-default">
  <div class="panel-heading"><b>Daftar Nilai <?php echo $tahun?></b></div>
  <div class="panel-body">

    <p><?php echo $this->session->flashdata('pesan')?> </p>
       <table class="table table-striped">
        <thead>
         <tr>
         <th>Sub Kriteria</th>
         <th>Nilai</th>
         <th></th>
         </tr>
        </thead>
        <tbody>
        <?php if(empty($qnilai)){ ?>
         <tr>
          <td colspan="4">Data tidak ditemukan</td>
         </tr>
         <?php }else{
            foreach($qnilai as $row){
              foreach ($qsub as $rowdata) {
                if ($row->ID_SUB == $rowdata->ID_SUB) {
                  $sub = $rowdata->NAMA_SUB;
                }
              }?>
         <tr>
          <td><?php echo $sub ?></td>
          <td><?php echo $row->NILAI_MATRIKS ?></td>
          <td>
           <a href="<?=base_url()?>petugas_nilai/form/edit/<?php echo $row->ID_NILAI ?>" class="btn btn-info btn-sm"><i class="glyphicon glyphicon-pencil"></i></a>
          </td>
         </tr>
        <?php } }?>
        </tbody>
       </table>
        </div>
    </div>
    </div>
<?php $this->load->view('footer');?>