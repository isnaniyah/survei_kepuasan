<?php $this->load->view('header_pengawas');?>
    <div class="container">
    <div class="panel panel-default">
  <div class="panel-heading"><b>Daftar Aktifitas Admin</b></div>
  <div class="panel-body">
    <p><?php echo $this->session->flashdata('pesan');
    if ($tgl!=null) {
      $tgl = date("Y-m-d", strtotime($tgl));
    }?> </p>
      <table class="nav navbar-nav navbar-right">
      <form class="navbar-form navbar-left" role="search" action="<?=base_url()?>pengawas_log/filter/" method="get">
      <div class="form-group">
        <tr>
          <td class="col-sm-20">
            <input class="form-control" name="tgl" type="date" value="<?php echo $tgl;?>" />
          </td>
          <td>&nbsp&nbsp&nbsp</td>
          <td class="col-sm-20">
            <select class="form-control" name="admin">
              <option value="null"> -Pilih username </option>
              <?php foreach ($qadmin as $rowdata) {
              echo '<option value="'.$rowdata->USERNAME.'"';
                if ($admin == $rowdata->USERNAME){
                  echo 'selected="selected"'; }
                  echo '" >'.$rowdata->NAMA_USER.'</option>';
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
         <th>Username admin</th>
         <th>Waktu aktifitas</th>
         <th colspan="2">Aktifitas</th>
         </tr>
        </thead>
        <tbody>
        <?php if(empty($qlog)){ ?>
         <tr>
          <td colspan="4">Data tidak ditemukan</td>
         </tr>
         <?php }else{
            foreach($qlog as $row){?>
         <tr>
          <td><?php echo $row->USERNAME ?></td>
          <td><?php echo $row->WAKTU ?></td>
          <td><?php echo $row->AKTIVITAS ?></td>
         </tr>
        <?php } }?>
        </tbody>
       </table>
       <div class="panel-footer">
       <h5>Jumlah data : <?php echo $jumlah_data?></h5>
         <?php echo $page?>
       </div>
        </div>
    </div>
    </div>
<?php $this->load->view('footer');?>