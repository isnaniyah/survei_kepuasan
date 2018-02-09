<?php $this->load->view('header');?>

    <div class="container">

      <div class="panel panel-default">
  <div class="panel-heading"><b>Daftar Responden</b></div>
  <div class="panel-body">
  <p><?php echo $this->session->flashdata('pesan')?> </p>
  <div class="nav navbar-nav navbar-right">
    <form class="navbar-form navbar-left" role="search" action="<?=base_url()?>admin_responden/filter/<?=$filter?>" method="get">
      <div class="form-group">
        <div class="col-sm-3">
              <select class="form-control" name="ID_PERIODE">
              <?php foreach ($qperiode as $rowdata) {
                echo '<option value="'.$rowdata->ID_PERIODE.'" >'.$rowdata->BULAN.' - '.$rowdata->TAHUN.'</option>';
                }?>
              </select>
          </div>
      </div>
      <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i> Cari</button>
    </form>
  </div>
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
          $i=0;
          foreach($qresponden as $row){ $i++;?>
         <tr>
          <td><?php echo $i ?></td>
          <td><?php echo $row->NAMA ?></td>
          <td><?php echo $row->NAMA_POLI ?></td>
          <td><?php echo $row->WAKTU_INPUT ?></td>
          <td><?php echo $row->JENIS_KELAMIN ?></td>
          <td><?php echo $row->ID_PERIODE ?></td>
          <td>            
           <a href="<?=base_url()?>admin_responden/detail/<?php echo $row->ID_RESPONDEN ?>" class="btn btn-warning btn-sm"><i class="glyphicon glyphicon-search"></i></a>
           <a href="<?=base_url()?>admin_responden/hapus/<?php echo $row->ID_RESPONDEN ?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus data ini?')"><i class="glyphicon glyphicon-trash"></i></a>
          </td>
         </tr>
        <?php }}?>
        </tbody>
       </table>
        </div>
    </div>    <!-- /panel -->

    </div> <!-- /container -->
<?php $this->load->view('footer');?>