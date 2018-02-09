<?php $this->load->view('header');?>
<?php foreach ($qperiode as $row) {
  $bulan = $row->BULAN;
  $tahun = $row->TAHUN;
}
?>
<div class="container">
<p><input type="button" value="Kembali" onclick="history.back(-1)" class="btn btn-sm btn-info"/></p>
  <div class="panel panel-default">
  <center><h4>Perhitungan untuk survei periode <?php echo $bulan;?> - <?php echo $tahun;?></h4></center>
  <?php if (empty($qranking)) {?>
    <div class="panel-heading"><b>Data tidak ditemukan</b></div>
    <div class="panel-body">
    </div>
  <?php }else{?>
    <div class="panel-heading"><b>Kode dan nama sub kriteria</b></div>
    <div class="panel-body">
      <table class="table table-striped">
        <thead>
         <tr>
         <th>Daftar kode sub</th>
         <th>Nama sub</th>
         </tr>
        </thead>
        <tbody>
         <?php
         foreach ($qsub as $row) {
          $i=0;
          foreach ($qsurvei as $key) {
            if ($row->ID_SUB == $key->ID_SUB) {
              $i++;
            }
          }
          if ($i!=0) {?>
         <tr>
          <td><?php echo $row->ID_SUB ?></td>
          <td><?php echo $row->NAMA_SUB ?></td>
          </tr>
         <?php }
         }?>

        </tbody>
      </table>
    <div class="panel-heading"><b>Nilai Rata-rata Persepsi</b></div>
    <div class="panel-body">
      <table class="table table-striped">
        <thead>
         <tr>
         <th>Alternatif/Poli</th>
         <?php
         foreach ($qsub as $row) {?>
           <th><?php echo $row->ID_SUB ?></th>
         <?php }?>
         </tr>
        </thead>
        <tbody>
        <?php
          foreach ($qpoli as $poli) {?>
          <tr>
          <?php $a=0;
          foreach ($qranking as $key) {
            if ($poli->ID_POLI == $key->ID_POLI) {
              $a++;
            }
          }
          if ($a>0) {?>
            <td><?php echo $poli->NAMA_POLI;?></td>

            <?php foreach ($qsurvei as $nilai) {
            if ($poli->ID_POLI == $nilai->ID_POLI) {?>
            <?php foreach ($qsub as $sub) {
                if ($sub->ID_SUB == $nilai->ID_SUB) {?>
                  <td><?php echo $nilai->RATA_PERSEPSI?></td>
                <?php }
              }
            }
          }
          echo '</tr>';
        }
      }
        ?>
        </tbody>
      </table>
    </div>
    <div class="panel-heading"><b>Nilai Rata-rata Harapan</b></div>
    <div class="panel-body">
      <table class="table table-striped">
        <thead>
         <tr>
         <th>Alternatif/Poli</th>
         <?php
         foreach ($qsub as $row) {?>
           <th><?php echo $row->ID_SUB ?></th>
         <?php }?>
         </tr>
        </thead>
        <tbody>
        <?php
          foreach ($qpoli as $poli) {?>
          <tr>
          <?php $a=0;
          foreach ($qranking as $key) {
            if ($poli->ID_POLI == $key->ID_POLI) {
              $a++;
            }
          }
          if ($a>0) {?>
            <td><?php echo $poli->NAMA_POLI;?></td>
            <?php foreach ($qsurvei as $nilai) {
            if ($poli->ID_POLI == $nilai->ID_POLI) {?>
            <?php foreach ($qsub as $sub) {
                if ($sub->ID_SUB == $nilai->ID_SUB) {?>
                  <td><?php echo $nilai->RATA_HARAPAN?></td>
                <?php }
              }
            }
          }
          echo '</tr>';
        }
      }
        ?>
        </tbody>
      </table>
    </div>
    <div class="panel-heading"><b>Nilai Service Quality</b></div>
    <div class="panel-body">
      <table class="table table-striped">
        <thead>
         <tr>
         <th>Alternatif/Poli</th>
         <?php
         foreach ($qsub as $row) {?>
           <th><?php echo $row->ID_SUB ?></th>
         <?php }?>
         </tr>
        </thead>
        <tbody>
        <?php
          foreach ($qpoli as $poli) {?>
          <tr>
          <?php $a=0;
          foreach ($qranking as $key) {
            if ($poli->ID_POLI == $key->ID_POLI) {
              $a++;
            }
          }
          if ($a>0) {?>
            <td><?php echo $poli->NAMA_POLI;?></td>
            <?php foreach ($qsurvei as $nilai) {
            if ($poli->ID_POLI == $nilai->ID_POLI) {?>
            <?php foreach ($qsub as $sub) {
                if ($sub->ID_SUB == $nilai->ID_SUB) {?>
                  <td><?php echo $nilai->NILAI_SERVQUAL?></td>
                <?php }
              }
            }
          }
          echo '</tr>';
        }
      }
        ?>
        </tbody>
      </table>
    </div>
    <div class="panel-heading"><b>Nilai Matriks (himpunan fuzzy)</b></div>
    <div class="panel-body">
      <table class="table table-striped">
        <thead>
         <tr>
         <th>Alternatif/Poli</th>
         <?php
         foreach ($qsub as $row) {?>
           <th><?php echo $row->ID_SUB ?></th>
         <?php }?>
         </tr>
        </thead>
        <tbody>
        <?php
          foreach ($qpoli as $poli) {?>
          <tr>
          <?php $a=0;
          foreach ($qranking as $key) {
            if ($poli->ID_POLI == $key->ID_POLI) {
              $a++;
            }
          }
          if ($a>0) {?>
            <td><?php echo $poli->NAMA_POLI;?></td>
            <?php foreach ($qsurvei as $nilai) {
            if ($poli->ID_POLI == $nilai->ID_POLI) {?>
            <?php foreach ($qsub as $sub) {
                if ($sub->ID_SUB == $nilai->ID_SUB) {?>
                  <td><?php echo $nilai->NILAI_MATRIKS?></td>
                <?php }
              }
            }
          }
          echo '</tr>';
        }
      }
        ?>
        </tbody>
      </table>
    </div>
    <div class="panel-heading"><b>Nilai Matriks</b></div>
    <div class="panel-body">
      <table class="table table-striped">
        <thead>
         <tr>
         <th>Alternatif/Poli</th>
         <?php
         foreach ($qsub as $row) {?>
           <th><?php echo $row->ID_SUB ?></th>
         <?php }?>
         </tr>
        </thead>
        <tbody>
        <?php
          foreach ($qpoli as $poli) {?>
          <tr>
          <?php $a=0;
          foreach ($qranking as $key) {
            if ($poli->ID_POLI == $key->ID_POLI) {
              $a++;
            }
          }
          if ($a>0) {?>
            <td><?php echo $poli->NAMA_POLI;?></td>
            <?php foreach ($qsurvei as $nilai) {
            if ($poli->ID_POLI == $nilai->ID_POLI) {?>
            <?php foreach ($qsub as $sub) {
                if ($sub->ID_SUB == $nilai->ID_SUB) {?>
                  <td><?php echo $nilai->NILAI_MATRIKS?></td>
                <?php }
              }
            }
          }
          echo '</tr>';
        }
      }
        ?>
        </tbody>
      </table>
    </div>
    <div class="panel-heading"><b>Nilai Normalisasi</b></div>
    <div class="panel-body">
      <table class="table table-striped">
        <thead>
         <tr>
         <th>Alternatif/Poli</th>
         <?php
         foreach ($qsub as $row) {?>
           <th><?php echo $row->ID_SUB ?></th>
         <?php }?>
         </tr>
        </thead>
        <tbody>
        <?php
          foreach ($qpoli as $poli) {?>
          <tr>
          <?php $a=0;
          foreach ($qranking as $key) {
            if ($poli->ID_POLI == $key->ID_POLI) {
              $a++;
            }
          }
          if ($a>0) {?>
            <td><?php echo $poli->NAMA_POLI;?></td>
            <?php foreach ($qsurvei as $nilai) {
            if ($poli->ID_POLI == $nilai->ID_POLI) {?>
            <?php foreach ($qsub as $sub) {
                if ($sub->ID_SUB == $nilai->ID_SUB) {?>
                  <td><?php echo $nilai->NILAI_NORMALISASI?></td>
                <?php }
              }
            }
          }
          echo '</tr>';
        }
      }
        ?>
        </tbody>
      </table>
    </div>
    <div class="panel-heading"><b>Nilai Terbobot</b></div>
    <div class="panel-body">
      <table class="table table-striped">
        <thead>
         <tr>
         <th>Alternatif/Poli</th>
         <th>Nilai Akhir</th>
         </tr>
        </thead>
        <tbody>
        <?php
          foreach ($qpoli as $poli) {?>
          <tr>
          <?php $a=0;
          foreach ($qranking as $key) {
            if ($poli->ID_POLI == $key->ID_POLI) {
              $a++;
            }
          }
          if ($a>0) {?>
            <td><?php echo $poli->NAMA_POLI;?></td>
            <?php foreach ($qnilai_akhir as $nilai) {
            if ($poli->ID_POLI == $nilai->ID_POLI) {?>
              <td><?php echo $nilai->NILAI_AKHIR?></td>
                <?php
            }
          }
          echo '</tr>';
        }
      }
        ?>
        </tbody>
      </table>
    </div>
    <div class="panel-heading"><b>Nilai Ranking</b></div>
    <div class="panel-body">
      <table class="table table-striped">
        <thead>
         <tr>
         <th>Alternatif/Poli</th>
         <th>Nilai Akhir</th>
         </tr>
        </thead>
        <tbody>
        <?php
          foreach ($qpoli as $poli) {?>
          <tr>
          <?php $a=0;
          foreach ($qranking as $key) {
            if ($poli->ID_POLI == $key->ID_POLI) {
              $a++;
            }
          }
          if ($a>0) {?>
            <td><?php echo $poli->NAMA_POLI;?></td>
            <?php foreach ($qranking as $nilai) {
            if ($poli->ID_POLI == $nilai->ID_POLI) {?>
              <td><?php echo $nilai->NILAI_AKHIR?></td>
                <?php
            }
          }
          echo '</tr>';
        }
        }
        ?>
        </tbody>
      </table>
    </div>
    <?php } ?>
  </div>    <!-- /panel -->
</div> <!-- /container -->
<?php $this->load->view('footer');?>