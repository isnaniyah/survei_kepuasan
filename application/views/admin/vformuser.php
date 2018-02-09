<?php $this->load->view('header');?>
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
<div class="panel panel-default">
  <div class="panel-heading"><b>Form Data Upah</b></div>
  <div class="panel-body">
  <?php echo $this->session->flashdata('pesan')?>
     <form action="<?=base_url()?>admin_user/form/<?=$aksi?>" method="post">
       <table class="table table-striped">
       <input type="hidden" name="ket" class="form-control" value="<?php echo $ket ?>">
        <tr>
          <td>Username<br></td>
          <td>
            <?php
            if($aksi=='aksi_edit'){
              echo $USERNAME;
              echo '<input type="hidden" name="USERNAME" class="form-control" value="'.$USERNAME.'">';
              } else { ?>
            <div class="col-sm-5">
                <input type="text" name="USERNAME" class="form-control" value="<?php echo $USERNAME?>" required>
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
         <tr>
            <?php
            if($ket!='byid'){?>
          <td>Hak Akses</td>
          <td>
          <div class="col-sm-4">
            <select class="form-control" name="HAK_AKSES">
              <option value="Admin" <?php if($aksi=="aksi_edit"){if($HAK_AKSES=='Admin') {echo"selected";}}?> >Admin</option>
              <option value="Pengawas" <?php if($aksi=="aksi_edit"){if($HAK_AKSES=='Pengawas') {echo"selected";}}?> >Pengawas</option>
            </select>
            <?php } else{ ?>
              <input type="hidden" name="HAK_AKSES" class="form-control" value="Admin">
            <?php } ?>
          </div>
          </td>
         </tr>
         <tr>
          <td colspan="2">
            <input type="submit" class="btn btn-success" value="Simpan">
            <a href="<?=base_url()?>admin_user" class="btn btn-default">Batal</button>
          </td>
         </tr>
       </table>
     </form>
        </div>
    </div>    <!-- /panel -->

    </div> <!-- /container -->
<?php $this->load->view('footer');?>