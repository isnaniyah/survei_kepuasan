<?php $this->load->view('header_petugas');
foreach ($quser as $row) {
  $nama = $row->NAMA_USER;
}?>

    <div class="container">

      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
        <h1>Selamat Datang <?php echo $nama?></h1>
        <p>Ini merupakan web Sistem Pendukung Keputusan menggunakan metode SAW untuk memilih Supplier terbaik yang sesuai kriteria PT. Adira</p>
        <p>Hak akses : Petugas </p>
        <p> 
        </p>
      </div>

    </div> <!-- /container -->
<?php $this->load->view('footer');?>