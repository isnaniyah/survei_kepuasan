<?php $this->load->view('header');
foreach ($quser as $row) {
  $nama = $row->NAMA_USER;
}?>

    <div class="container">

      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
        <h1>Selamat Datang <?php echo $nama?></h1>
        <p>Ini merupakan web survei kepuasan pasien yang dilakukan di RSUD Syarifah Ambami Rato Ebuh Bangkalan dengan menggunakan metode survei Service Quality dan metode Simple Additive Weighting</p>
        <p>Hak akses : Admin </p>
        <p> 
        </p>
      </div>

    </div> <!-- /container -->
<?php $this->load->view('footer');?>