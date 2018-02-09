<?php $this->load->view('header_pengawas');?>
    <div class="container">
    <div class="panel panel-default">
  <div class="panel-heading"><b>Daftar Aktifitas Admin</b></div>
  <div class="panel-body">
  <p><?php echo $this->session->flashdata('pesan')?> </p>
  <?php if(!empty($tgl)){
      $tgl_masuk = "Pencarian tanggal : ".date('d F Y', strtotime($tgl));
      $tgl = date("Y-m-d", strtotime($tgl));
    }else{
      $tgl_masuk ="";
      $tgl = "";
    }?>
  <div class="nav navbar-nav navbar-right">
    <form class="navbar-form navbar-left" role="search" action="<?=base_url()?>kritik/search" method="get">
      <div class="form-group">
        <div class="col-sm-3">
          <input type="date" name="tgl" class="form-control" value="<?php echo $tgl;?>">
        </div>
      </div>
      <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i> Cari</button>
    </form>
  </div>
       <table class="table table-striped">
          <h4><?php echo $tgl_masuk?></h4>
          <thead>
         <tr>
         <th>No.</th>
         <th>Tanggal Masuk</th>
         <th>Nama Pasien</th>
         <th colspan="2">Kritik & Saran</th>
         <th></th>
         </tr>
        </thead>
        <tbody>
        <?php if(empty($qkritik)){ ?>
         <tr>
          <td colspan="5">Data tidak ditemukan</td>
         </tr>
         <?php }else{
          if (empty($nomer)) {
            $i=0;
          }else{
            $i = $nomer;
          }
            foreach($qkritik as $row){
              $i++;?>
         <tr>
          <td><?php echo $i ?></td>
          <td><?php echo $row->TANGGAL_MASUK ?></td>
          <td><?php echo $row->NAMA ?></td>
          <td><?php echo $row->KRITIK_SARAN ?></td>
          <td>
            <a href="<?=base_url()?>kritik/hapus/<?php echo $row->ID_KRITIK_SARAN ?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus data ini?')"><i class="glyphicon glyphicon-trash"></i></a>
          </td>
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