<html>
<head>
<title>Data Perhitungan</title>
<style type="text/css">
    table { page-break-inside:always }
    div   { page-break-inside:avoid; } /* This is the key */
    thead { display:table-header-group }
    tfoot { display:table-footer-group }
</style>
</head>
<body>
<center>
	<h2>Rekapitulasi Hasil Perhitungan</h2>
</center>
<div>
<table border="1" align="center">
	<caption><h4>Hasil Perhitungan ServQual keseluruhan Rawat Jalan</h4></caption>
	<tbody>
		<tr>
			<th>No.</th>
			<th>Pernyataan Survei</th>
			<th>Rata-rata Nilai Persepsi</th>
			<th>Rata-rata Nilai Harapan</th>
			<th>Nilai Service Quality</th>
		</tr>
		<?php $no=0;
		foreach ($sub as $row) {
			$i=0;
			$no++;
			$persepsi = 0;
			$harapan = 0;
			foreach ($survei as $key) {
			    if ($row->ID_SUB == $key->ID_SUB) {
			      	$i++;
			      	$persepsi = $persepsi + $key->NILAI_PERSEPSI;
			      	$harapan = $harapan + $key->NILAI_HARAPAN;
			    }
			}
			if ($i!=0) {
				$rata_persepsi = $persepsi/$i;
				$rata_harapan = $harapan/$i;
				$servqual = $rata_persepsi - $rata_harapan;?>
			<tr>
				<td><?php echo $no;?></td>
				<td><?php echo $row->NAMA_SUB;?></td>
				<td><?php echo number_format($rata_persepsi,2);?></td>
				<td><?php echo number_format($rata_harapan,2);?></td>
				<td><?php echo number_format($servqual,2);?></td>
			</tr>
		<?php }
		}?>
	</tbody>
</table>
</div>
<div>
<table border="1" align="center" >
	<caption><h4>Hasil Perhitungan ServQual dan SAW Rawat Jalan</h4></caption>
	<tbody>         
		<tr>
         	<th>Ranking</th>
         	<th>Nama Poli</th>
         	<th>Penanggung Jawab</th>
         	<th>Jumlah perbaikan pelayanan</th>
         	<th>Nilai Akhir</th>
        </tr>
        <?php if(empty($ranking)){ ?>
         <tr>
          <td colspan="5">Data tidak ditemukan</td>
         </tr>
        <?php }else{
          $i=0;
          foreach($ranking as $row){
            $i++;?>
         <tr>
          <td><?php echo $i?></td>
          <td><?php echo $row->NAMA_POLI ?></td>
          <td><?php echo $row->PENANGGUNG_JAWAB ?></td>
          <td><?php echo $row->JUMLAH_PERBAIKAN ?></td>
          <td><?php echo $row->NILAI_AKHIR ?></td>
         </tr>
        <?php }}?>
	</tbody>
</table>
</div>
<?php $i=0;
foreach ($poli as $key) {
	foreach ($ranking as $row) {
		if ($row->ID_POLI == $key->ID_POLI) {
			$i++;
			$NAMA_POLI = $row->NAMA_POLI;
			$BULAN = $row->BULAN;
			$PENANGGUNG_JAWAB = $row->PENANGGUNG_JAWAB;
			$JUMLAH_PERBAIKAN = $row->JUMLAH_PERBAIKAN;
			$NILAI_AKHIR = $row->NILAI_AKHIR;
			$TAHUN = $row->TAHUN;
		}
	}
	if ($i>0) {
		?>
	<div>
	<table border="1" align="center">
	<caption><h4>Hasil Perhitungan ServQual pada <?php echo $NAMA_POLI?> </h4></caption>
        <tr>
          <td colspan="2">Nama Poli</td>
          <td colspan="2"><?php echo $NAMA_POLI?></td>
        </tr>
        <tr>
          <td colspan="2">Periode</td>
          <td colspan="2"><?php echo $BULAN?> - <?php echo $TAHUN?></td>
          </tr>
        <tr>
          <td colspan="2">Penanggung Jawab Poli</td>
          <td colspan="2"><?php echo $PENANGGUNG_JAWAB?></td>
        </tr>
        <tr>
          <td colspan="2">Jumlah Perbaikan</td>
          <td colspan="2"><?php echo $JUMLAH_PERBAIKAN?></td>
          </tr>
        <tr>
          <td colspan="2">Nilai Akhir</td>
          <td colspan="2"><?php echo $NILAI_AKHIR?></td>
        </tr>
        <thead>
         <tr>
         <th>No.</th>
         <th>Kriteria</th>
         <th>Pernyataan</th>
         <th>Nilai Servqual</th>
         </tr>
        </thead>
        <tbody>
        <?php if(empty($qservqual)){ ?>
         <tr>
          <td colspan="4">Data tidak ditemukan</td>
         </tr>
        <?php }else{
          $no=0;
          foreach($qservqual as $row){ 
          	if ($row->ID_POLI == $key->ID_POLI) {$no++;?>
         <tr>
          <td><?php echo $no ?></td>
          <td><?php echo $row->NAMA_KRITERIA ?></td>
          <td><?php echo $row->NAMA_SUB ?></td>
          <td><?php echo $row->NILAI_SERVQUAL ?></td>
         </tr>
        <?php }}
        }
    }?>
        </tbody>
       </table>
       </div>
<?php }?>
</body>
</html