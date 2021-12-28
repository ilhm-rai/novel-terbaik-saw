<div class="section-header">
  <h1>Penilaian</h1>
</div>
<div class="section-body">
  <div class="row">
    <div class="col-lg-4 col-md-12 col-12 col-sm-12">
      <form method="post" action="./proses/tambah.php" class="needs-validation" id="form" novalidate="" enctype="multipart/form-data">
        <input type="hidden" name="table" id="table" value="nilai_buku">
        <div class="card">
          <div class="card-header">
            <h4>Tambah Data</h4>
          </div>
          <div class="card-body pb-0">
            <div class="form-group">
              <label>Pilih Novel</label>
              <select class="custom-select my-1" name="buku_id" id="buku_id">
                <option selected disabled>-- Pilih Novel --</option>
                <?php
                $query = "SELECT * FROM buku";
                $execute = $konek->query($query);
                while ($row = $execute->fetch_array(MYSQLI_ASSOC)) :
                ?>
                  <option value="<?= $row['id']; ?>"><?= $row['judul']; ?></option>
                <?php
                endwhile;
                ?>
              </select>
            </div>
            <?php
            $query = "SELECT * FROM kriteria";
            $execute = $konek->query($query);
            if ($execute->num_rows > 0) :
              while ($data = $execute->fetch_array(MYSQLI_ASSOC)) :
            ?>
                <input type="hidden" name="kriteria_id[]" value="<?= $data['id']; ?>">
                <div class="form-group">
                  <label><?= $data['nama']; ?></label>
                  <select class="custom-select my-1" name="nilai[]" id="KID<?= $data['id'] ?>">
                    <option selected disabled>-- Pilih <?= $data['nama'] ?> --</option>
                    <?php
                    $query_sub = "SELECT id, keterangan FROM nilai_kriteria WHERE kriteria_id='$data[id]'";
                    $execute_sub = $konek->query($query_sub);
                    if ($execute_sub->num_rows > 0) :
                      while ($data_sub = $execute_sub->fetch_array(MYSQLI_ASSOC)) :
                    ?>
                        <option value="<?= $data_sub['id']; ?>"><?= $data_sub['keterangan']; ?></option>
                    <?php
                      endwhile;
                    else :
                      echo "<option disabled value=\"\">Belum ada nilai kriteria</option>";
                    endif;
                    ?>
                  </select>
                </div>
            <?php
              endwhile;
            endif;
            ?>
          </div>
          <div class="card-footer pt-0">
            <button class="btn btn-primary" id="buttonsimpan" type="submit">Simpan</button>
            <button class="btn btn-secondary" id="buttonsimpan" type="reset">Reset</button>
          </div>
        </div>
      </form>
    </div>
    <div class="col-lg-8 col-md-12 col-12 col-sm-12">
      <div class="card">
        <div class="card-header">
          <h4>Daftar Penilaian</h4>
        </div>
        <div class="card-body">
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Judul</th>
                <th scope="col" width="25%">Sampul</th>
                <th scope="col" width="25%">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $query = "SELECT nilai_buku.*, buku.judul, buku.sampul FROM nilai_buku INNER JOIN buku ON buku.id = nilai_buku.buku_id GROUP BY nilai_buku.buku_id";
              $execute = $konek->query($query);
              if ($execute->num_rows > 0) :
                $no = 1;
                while ($data = $execute->fetch_array(MYSQLI_ASSOC)) :
              ?>
                  <tr>
                    <th scope="row"><?= $no; ?></th>
                    <td><?= $data['judul']; ?></td>
                    <td><img src="../asset/img/<?= $data['sampul']; ?>" alt="<?= $data['judul']; ?>" class="img-thumbnail"></td>
                    <td>
                      <a href="./proses/tampil.php?table=nilai_buku&id=<?= $data['buku_id']; ?>" class="btn btn-icon btn-sm btn-secondary btn-edit mb-1"><i class="fas fa-pencil-alt"></i></a>
                      <a href="./proses/hapus.php?table=nilai_buku&id=<?= $data['buku_id']; ?>" class="btn btn-icon btn-sm btn-danger btn-hapus mb-1" data-name="<?= $data['judul'] ?>"><i class="fas fa-trash"></i></a>
                    </td>
                  </tr>
              <?php
                  $no++;
                endwhile;
              else :
                echo '<tr><td colspan="5">Daftar penilaian buku belum tersedia</td></tr>';
              endif;
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>