<?php $this->load->view('header');?>

    <div class="container">

      <div class="panel panel-default">
  <div class="panel-heading"><b>Daftar Responden</b></div>
  <div class="panel-body">
  <p><?php echo $this->session->flashdata('pesan');?> </p>
      <table class="nav navbar-nav navbar-right">
      <form class="navbar-form navbar-left" role="search" action="<?=base_url()?>admin_responden/filter/" method="get">
      <div class="form-group">
        <tr>
        <?php if ($periode != "null"){?>
          <td><a href="<?=base_url()?>admin_responden/cetak/<?php echo $periode ?>/<?php echo $poli ?>" class="btn btn-info btn-sm"><i class="glyphicon glyphicon-download"></i> Download </a></td>
          <td>&nbsp&nbsp</td>
          <?php } ?>
          <td class="col-sm-20">
              <select class="form-control" name="ID_PERIODE">
              <option value="null"> -Pilih periode- </option>
              <?php foreach ($qperiode as $rowdata) {
                echo '<option value="'.$rowdata->ID_PERIODE.'"';
                if ($periode == $rowdata->ID_PERIODE){
                  echo 'selected="selected"'; }
                  echo '" >'.$rowdata->BULAN.' - '.$rowdata->TAHUN.'</option>';
              }?>
              </select>
          </td>
          <td>&nbsp&nbsp&nbsp</td>
          <td class="col-sm-20">
            <select class="form-control" name="ID_POLI">
              <option value="null"> -Pilih poli- </option>
              <?php foreach ($qpoli as $rowdata) {
              echo '<option value="'.$rowdata->ID_POLI.'"';
                if ($poli == $rowdata->ID_POLI){
                  echo 'selected="selected"'; }
                  echo '" >'.$rowdata->NAMA_POLI.'</option>';
              }?>
            </select>
          </td>
          <td>&nbsp&nbsp&nbsp</td>
          <td>
            <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i> Cari</button>
          </td>
        </tr>
        </div>
        </form>
      </table>
       <table class="table table-striped">
        <thead>
         <tr>
         <th>No</th>
         <th>Nama Responden</th>
         <th>Poli</th>
         <th>Waktu Survei</th>
         <th>Jenis Kelamin</th>
         <th>Periode</th>
         <th></th>
         </tr>
        </thead>
        <tbody>
        <?php if(empty($qresponden)){ ?>
         <tr>
          <td colspan="7">Data tidak ditemukan</td>
         </tr>
        <?php }else{
          if (empty($nomer)) {
            $i=0;
          }else{
            $i = $nomer;
          }
          foreach($qresponden as $row){ $i++;?>
         <tr>
          <td><?php echo $i ?></td>
          <td><?php echo $row->NAMA ?></td>
          <td><?php echo $row->NAMA_POLI ?></td>
          <td><?php echo $row->WAKTU_INPUT ?></td>
          <td><?php echo $row->JENIS_KELAMIN ?></td>
          <td><?php echo $row->BULAN ?> - <?php echo $row->TAHUN ?></td>
          <td>            
           <a href="<?=base_url()?>admin_responden/detail/<?php echo $row->ID_RESPONDEN ?>" class="btn btn-warning btn-sm"><i class="glyphicon glyphicon-search"></i></a>
           <a href="<?=base_url()?>admin_responden/hapus/<?php echo $row->ID_RESPONDEN ?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus data ini?')"><i class="glyphicon glyphicon-trash"></i></a>
          </td>
         </tr>
        <?php }}?>
        </tbody>
       </table>
       <div class="panel-footer">
       <h5>Jumlah data : <?php echo $jumlah_data?></h5>
         <?php echo $page?>
       </div>
        </div>
    </div>    <!-- /panel -->

    </div> <!-- /container -->
<?php $this->load->view('footer');?>