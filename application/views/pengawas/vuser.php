<?php $this->load->view('header_pengawas');?>
<div class="container">
      <!-- Main component for a primary marketing message or call to action -->
  <div class="panel panel-default">
  <div class="panel-heading"><b>Ubah Password</b></div>
  <div class="panel-body">
    <p><?php echo $this->session->flashdata('pesan')?> </p>
       <table class="table table-striped">
        <thead>
         <tr>
         <th>Username</th>
         <th>Nama</th>
         <th></th>
         </tr>
        </thead>
        <tbody>
        <?php if(empty($quser)){ ?>
         <tr>
          <td colspan="4">Data tidak ditemukan</td>
         </tr>
        <?php }else{
          foreach($quser as $row){?>
         <tr>
          <td><?php echo $row->USERNAME ?></td>
          <td><?php echo $row->NAMA_USER ?></td>
          <td>
            <a href="<?=base_url()?>pengawas_user/form/edit/<?php echo $row->USERNAME ?>" class="btn btn-info btn-sm"><i class="glyphicon glyphicon-pencil"></i></a>
          </td>
         </tr>
        <?php }}?>
        </tbody>
       </table>
        </div>
    </div>
        </div> <!-- /container -->
<?php $this->load->view('footer');?>