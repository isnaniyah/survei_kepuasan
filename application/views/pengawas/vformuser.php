<?php $this->load->view('header_pengawas');?>
<?php
if($aksi=='aksi_add'){
    $USERNAME="";
    $NAMA_USER="";
    $PASSWORD="";
    $HAK_AKSES="";
}else{
 foreach($quser as $rowdata){
    $USERNAME=$rowdata->USERNAME;
    $NAMA_USER=$rowdata->NAMA_USER;
    $PASSWORD=$rowdata->PASSWORD;
    $HAK_AKSES=$rowdata->HAK_AKSES;
  }
}

?>
<div class="container">
      <!-- Main component for a primary marketing message or call to action -->
<div class="panel panel-default">
  <div class="panel-heading"><b>Form Data User</b></div>
  <div class="panel-body">
  <?php echo $this->session->flashdata('pesan')?>
     <form action="<?=base_url()?>pengawas_user/form/<?=$aksi?>" method="post">
       <table class="table table-striped">
        <tr>
          <td>Username<br></td>
          <td>
            <?php
            if($aksi=='aksi_edit'){
              echo $USERNAME;
              echo '<input type="hidden" name="USERNAME" class="form-control" value="'.$USERNAME.'">';
              } else { ?>
            <div class="col-sm-5">
                <input type="text" name="USERNAME" class="form-control" value="<?php echo $USERNAME?>">
            </div>
                <?php } ?>
            </td>
         </tr>
         <tr>
          <td>Nama<br></td>
          <td>
            <div class="col-sm-5">
                <input type="text" name="NAMA_USER" class="form-control" value="<?php echo $NAMA_USER?>" required>
            </div>
            </td>
         </tr>
         <?php if($aksi=='aksi_edit'){?>
         <tr>
          <td>Kata Sandi Sebelumnya<br></td>
          <td>
            <div class="col-sm-5">
                <input type="password" name="PASSWORD_LAMA" class="form-control" required>
                <input type="hidden" name="PASSWORD_ACC" class="form-control" value="<?php echo $PASSWORD ?>">
            </div>
            </td>
         </tr>
          <?php } ?>
         <tr>
          <td>Kata Sandi <?php if($aksi=='aksi_edit'){ echo 'Baru'; }?></td>
          <td>
            <div class="col-sm-4">
                <input type="password" name="pass" class="form-control" required>
          </div>
          </td>
         </tr>
         <tr>
          <td>Konfirmasi Kata Sandi</td>
          <td>
            <div class="col-sm-4">
                <input type="password" name="KONFIRMASI_PASSWORD" class="form-control" required>
          </div>
          </td>
         </tr>
          <input type="hidden" name="HAK_AKSES" class="form-control" value="<?php echo $HAK_AKSES ?>">
         <tr>
          <td colspan="2">
            <input type="submit" class="btn btn-success" value="Simpan">
            <a href="<?=base_url()?>home/pengawas" class="btn btn-default">Batal</button>
          </td>
         </tr>
       </table>
     </form>
        </div>
    </div>    <!-- /panel -->

    </div> <!-- /container -->
<?php $this->load->view('footer');?>