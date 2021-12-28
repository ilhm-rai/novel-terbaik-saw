<?php
require 'class/saw.php';
$saw = new saw($konek);
?>
<div class="section-header">
  <h1>Hasil Penilaian</h1>
</div>
<div class="section-body">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4>Hasil Penilaian</h4>
        </div>
        <div class="card-body">
          <h3>Matriks Keputusan</h3>
          <div class="table-responsive">
            <table class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th scope="col" rowspan="2">Alternatif</th>
                  <th scope="col" class="text-center" colspan="<?= count($saw->getKriteria()); ?>">Kriteria</th>
                </tr>
                <tr>
                  <?php
                  foreach ($saw->getKriteria() as $key => $value) :
                  ?>
                    <th scope="col"><?= $value['nama']; ?></th>
                  <?php
                  endforeach;
                  ?>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                foreach ($saw->getAlternative() as $key => $value) :
                ?>
                  <tr>
                    <td>
                      <p title="<?= $value['judul']; ?>">A<?= $no++; ?></p>
                      <?php
                      foreach ($saw->getNilaiMatriks($value['buku_id']) as $key => $value) :
                      ?>
                    <td><?= $value['nilai']; ?></td>
                  <?php
                      endforeach;
                  ?>
                  </td>
                  </tr>
                <?php
                endforeach;
                ?>
              </tbody>
            </table>
          </div>
          <h3 class="mt-5">Normalisasi Matriks Keputusan</h3>
          <div class="table-responsive">
            <table class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th scope="col" rowspan="2">Alternatif</th>
                  <th scope="col" class="text-center" colspan="<?= count($saw->getKriteria()); ?>">Kriteria</th>
                </tr>
                <tr>
                  <?php
                  foreach ($saw->getKriteria() as $key => $value) :
                  ?>
                    <th scope="col"><?= $value['nama']; ?></th>
                  <?php
                  endforeach;
                  ?>
                </tr>
              </thead>
              <tbody>
                <?php
                $index = 1;
                foreach ($saw->getAlternative() as $key => $alternative_value) :
                ?>
                  <tr>
                    <td>
                      <p title="<?= $alternative_value['judul']; ?>">A<?= $index++; ?></p>
                      <?php
                      $no = 0;
                      foreach ($saw->getNilaiMatriks($alternative_value['buku_id']) as $key => $value) :
                        $hasil = $saw->normalisasi($saw->getArrayNilai($value['kriteria_id']), $value['atribut'], $value['nilai']);
                        echo "<td>$hasil</td>";
                        $hitungBobot[$alternative_value['buku_id']][$no] = $hasil * $saw->getBobot($value['kriteria_id']);
                        $no++;
                      endforeach;
                      ?>
                    </td>
                  </tr>
                <?php
                endforeach;
                ?>
              </tbody>
            </table>
          </div>
          <h3 class="mt-5">Perangkingan</h3>
          <div class="table-responsive">
            <table class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th scope="col" rowspan="2">Alternatif</th>
                  <th scope="col" class="text-center" colspan="<?= count($saw->getKriteria()); ?>">Kriteria</th>
                  <th scope="col" rowspan="2">Hasil</th>
                </tr>
                <tr>
                  <?php
                  foreach ($saw->getKriteria() as $key => $value) :
                  ?>
                    <th scope="col"><?= $value['nama']; ?></th>
                  <?php
                  endforeach;
                  ?>
                </tr>
              </thead>
              <tbody>
                <?php
                $index = 1;
                foreach ($saw->getAlternative() as $key => $value) {
                  echo "<tr>";
                  echo "<td><p title='$value[judul]'>A" . $index++ . "</td>";
                  $no = 0;
                  $hasil = 0;
                  foreach ($hitungBobot[$value['buku_id']] as $data) {
                    echo "<td> $data</td>";
                    $hasil += $data;
                  }
                  $saw->simpanHasil($value['buku_id'], $hasil);
                  echo "<td>" . $hasil . "</td>";
                  echo "</tr>";
                }
                ?>
              </tbody>
            </table>
          </div>
          <?php
          $saw->getHasil();
          ?>
        </div>
      </div>
    </div>
  </div>