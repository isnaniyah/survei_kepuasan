<html>
<head>
<title>Data Responden</title>
<style type="text/css">
    table { page-break-inside:avoid }
    div   { page-break-inside:always; } /* This is the key */
    thead { display:table-header-group }
    tfoot { display:table-footer-group }
</style>
</head>
<body>
<center>
	<h2>Rekapitulasi Data Responden</h2>
</center>
<table border="1" align="center">
	<caption><h4>Rekapitulasi data responden berdasarkan jenis kelamin</h4></caption>
	<tbody>
		<tr>
			<th>Jenis Kelamin</th>
			<th>Jumlah Responden</th>
		</tr>
		<tr>
			<td>Laki-laki</td>
			<?php $i=0;
			$total=0;
			foreach ($responden as $key) {
				if ($key->JENIS_KELAMIN == "Laki-laki") {
					$i++;
				}
			}
			$total=$total+$i;?>
			<td><?php echo $i;?></td>
		</tr>
		<tr>
			<td>Perempuan</td>
			<?php $i=0;
			foreach ($responden as $key) {
				if ($key->JENIS_KELAMIN == "Perempuan") {
					$i++;
				}
			}
			$total=$total+$i;?>
			<td><?php echo $i;?></td>
		</tr>
		<tr>
			<th>Total</th>
			<td><?php echo $total;?></td>
		</tr>
	</tbody>
</table>
<table border="1" align="center">
	<caption><h4>Rekapitulasi data responden berdasarkan umur</h4></caption>
	<tbody>
		<tr>
			<th>Range umur</th>
			<th>Jumlah Responden</th>
		</tr>
		<tr>
			<td>0-15</td>
			<?php $i=0;
			$total=0;
			foreach ($responden as $key) {
				if ($key->UMUR <= 15) {
					$i++;
				}
			}
			$total=$total+$i;?>
			<td><?php echo $i;?></td>			
		</tr>
		<tr>
			<td>16-30</td>
			<?php $i=0;
			foreach ($responden as $key) {
				if ($key->UMUR >= 16 && $key->UMUR <= 30) {
					$i++;
				}
			}
			$total=$total+$i;?>
			<td><?php echo $i;?></td>
		</tr>
		<tr>
			<td>31-45</td>
			<?php $i=0;
			foreach ($responden as $key) {
				if ($key->UMUR >= 31 && $key->UMUR <=45) {
					$i++;
				}
			}
			$total=$total+$i;?>
			<td><?php echo $i;?></td>
		</tr>
		<tr>
			<td>46-60</td>
			<?php $i=0;
			foreach ($responden as $key) {
				if ($key->UMUR >= 46 && $key->UMUR <= 60) {
					$i++;
				}
			}
			$total=$total+$i;?>
			<td><?php echo $i;?></td>
		</tr>
		<tr>
			<td>>=61</td>
			<?php $i=0;
			foreach ($responden as $key) {
				if ($key->UMUR >= 61) {
					$i++;
				}
			}
			$total=$total+$i;?>
			<td><?php echo $i;?></td>
		</tr>
		<tr>
			<th>Total</th>
			<td><?php echo $total;?></td>
		</tr>
	</tbody>
</table>
<table border="1" align="center">
	<caption><h4>Rekapitulasi data responden berdasarkan pekerjaan</h4></caption>
	<tbody>
		<tr>
			<th>Jenis Pekerjaan</th>
			<th>Jumlah Responden</th>
		</tr>
			<?php $total=0;
			foreach ($pekerjaan as $key) {
				echo "<tr>";
				echo "<td>".$key->NAMA_PEKERJAAN."</td>";
				$i=0;
				foreach ($responden as $key_responden) {
					if ($key_responden->ID_PEKERJAAN == $key->ID_PEKERJAAN) {
						$i++;
					}
				}
				$total = $total + $i;
				echo "<td>".$i."</td";
				echo "</tr>";
			}?>

		<tr>
			<th>Total</th>
			<td><?php echo $total;?></td>
		</tr>
	</tbody>
</table>
<table border="1" align="center">
	<caption><h4>Rekapitulasi data responden berdasarkan pendidikan</h4></caption>
	<tbody>
		<tr>
			<th>Jenis Pendidikan</th>
			<th>Jumlah Responden</th>
		</tr>
			<?php $total =0;
			foreach ($pendidikan as $key) {
				echo "<tr>";
				echo "<td>".$key->NAMA_PENDIDIKAN."</td>";
				$i=0;
				foreach ($responden as $key_responden) {
					if ($key_responden->ID_PENDIDIKAN == $key->ID_PENDIDIKAN) {
						$i++;
					}
				}
				$total = $total + $i;
				echo "<td>".$i."</td";
				echo "</tr>";
			}?>
		<tr>
			<th>Total</th>
			<td><?php echo $total;?></td>
		</tr>
	</tbody>
</table>
<table border="1" align="center">
	<caption><h4>Rekapitulasi data responden berdasarkan tanggungan biaya</h4></caption>
	<tbody>
		<tr>
			<th>Jenis Tanggungan Biaya</th>
			<th>Jumlah Responden</th>
		</tr>
			<?php $total = 0;
			foreach ($tanggungan_biaya as $key) {
				echo "<tr>";
				echo "<td>".$key->NAMA_TANGGUNGAN_BIAYA."</td>";
				$i=0;
				foreach ($responden as $key_responden) {
					if ($key_responden->ID_TANGGUNGAN_BIAYA == $key->ID_TANGGUNGAN_BIAYA) {
						$i++;
					}
				}
				$total = $total + $i;
				echo "<td>".$i."</td";
				echo "</tr>";
			}?>
		<tr>
			<th>Total</th>
			<td><?php echo $total;?></td>
		</tr>
	</tbody>
</table>
<?php 
$i=0;
foreach ($responden as $key) {
	$i++;
}
if ($i>100) {
	echo "<h1>Time Out!</h1>";
	echo $i;
} else {?>
<table border="1">
<caption><h4>Nilai Persepsi Responden</h4></caption>
	<tbody>
		<tr>
			<th>No.</th>
			<th>Nama Responden</th>
			<th>Nama Poli</th>
			<th>Waktu Input</th>
			<?php foreach ($sub as $row) {
			        $i=0;
			        foreach ($survei as $key) {
				        if ($row->ID_SUB == $key->ID_SUB) {
				        	$i++;
				        }
			        }
			        if ($i!=0) {?>
			          <th>Nilai <?php echo $row->ID_SUB;?></th>
					<?php }
				}?>
		</tr>
		<?php $i=0;
			foreach ($responden as $key) { $i++;?>
			<tr>
				<td><?php echo $i;?></td>
				<td> <?php echo $key->NAMA;?></td>
				<td> <?php echo $key->NAMA_POLI;?></td>
				<td> <?php echo $key->WAKTU_INPUT;?></td>
				<?php foreach ($sub as $key_sub) {
					foreach ($survei as $key_survei) {
						if ($key_survei->ID_SUB == $key_sub->ID_SUB) {
							if ($key_survei->ID_RESPONDEN == $key->ID_RESPONDEN) {?>
								<td><?php echo $key_survei->NILAI_PERSEPSI;?></td>
							<?php }
						}
					}
				}?>
			</tr>
		<?php }?>
		<tr>
		</tr>
	</tbody>
</table>
<br><br><br>
<table border="1">
<caption><h4>Nilai Harapan Responden</h4></caption>
	<tbody>
		<tr>
			<th>No.</th>
			<th>Nama Responden</th>
			<th>Nama Poli</th>
			<th>Waktu Input</th>
			<?php foreach ($sub as $row) {
			        $i=0;
			        foreach ($survei as $key) {
				        if ($row->ID_SUB == $key->ID_SUB) {
				        	$i++;
				        }
			        }
			        if ($i!=0) {?>
			          <th>Nilai <?php echo $row->ID_SUB;?></th>
					<?php }
				}?>
		</tr>
		<?php $i=0;
			foreach ($responden as $key) { $i++;?>
			<tr>
				<td><?php echo $i;?></td>
				<td> <?php echo $key->NAMA;?></td>
				<td> <?php echo $key->NAMA_POLI;?></td>
				<td> <?php echo $key->WAKTU_INPUT;?></td>
				<?php foreach ($sub as $key_sub) {
					foreach ($survei as $key_survei) {
						if ($key_survei->ID_SUB == $key_sub->ID_SUB) {
							if ($key_survei->ID_RESPONDEN == $key->ID_RESPONDEN) {?>
								<td><?php echo $key_survei->NILAI_HARAPAN;?></td>
							<?php }
						}
					}
				}?>
			</tr>
		<?php }?>
		<tr>
		</tr>
	</tbody>
</table>
<?php }?>
</body>
</html>