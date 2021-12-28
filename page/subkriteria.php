<div class="section-header">
  <h1>Sub Kriteria</h1>
</div>
<div class="section-body">
  <div class="row">
    <div class="col-lg-4 col-md-12 col-12 col-sm-12">
      <form method="post" action="./proses/tambah.php" class="needs-validation" id="form" novalidate="" enctype="multipart/form-data">
        <input type="hidden" name="table" id="table" value="nilai_kriteria">
        <div class="card">
          <div class="card-header">
            <h4>Tambah Sub Kriteria</h4>
          </div>
          <div class="card-body pb-0">
            <div class="form-group">
              <label>Kriteria</label>
              <select class="custom-select my-1" name="kriteria_id" id="kriteria_id">
                <option selected disabled>-- Pilih Kriteria --</option>
                <?php
                $query = "SELECT * FROM kriteria";
                $execute = $konek->query($query);
                while ($row = $execute->fetch_array(MYSQLI_ASSOC)) :
                ?>
                  <option value="<?= $row['id']; ?>"><?= $row['nama']; ?></option>
                <?php
                endwhile;
                ?>
              </select>
            </div>
            <div class="form-group">
              <label>Nilai</label>
              <input type="text" name="nilai" id="nilai" class="form-control" required>
              <div class="invalid-feedback">
                Nilai tidak boleh kosong
              </div>
            </div>
            <div class="form-group">
              <label>Keterangan</label>
              <input type="text" name="keterangan" id="keterangan" class="form-control" required>
              <div class="invalid-feedback">
                Keterangan tidak boleh kosong
              </div>
            </div>
          </div>
          <div class="card-footer pt-0">
            <button class="btn btn-primary" id="buttonsimpan" type="submit">Simpan</button>
            <button class="btn btn-secondary" id="buttonreset" type="reset">Reset</button>
          </div>
        </div>
      </form>
    </div>
    <div class="col-lg-8 col-md-12 col-12 col-sm-12">
      <div class="card">
        <div class="card-header">
          <h4>Daftar Sub Kriteria</h4>
        </div>
        <div class="card-body">
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Kriteria</th>
                <th scope="col">Bobot</th>
                <th scope="col">Keterangan</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $query = "SELECT nilai_kriteria.*, kriteria.nama AS kriteria FROM nilai_kriteria INNER JOIN kriteria ON kriteria.id = nilai_kriteria.kriteria_id";
              $execute = $konek->query($query);
              if ($execute->num_rows > 0) :
                $no = 1;
                while ($data = $execute->fetch_array(MYSQLI_ASSOC)) :
              ?>
                  <tr>
                    <th scope="row"><?= $no; ?></th>
                    <td><?= $data['kriteria']; ?></td>
                    <td><?= $data['nilai']; ?></td>
                    <td><?= $data['keterangan']; ?></td>
                    <td>
                      <a href="./proses/tampil.php?table=nilai_kriteria&id=<?= $data['id']; ?>" class="btn btn-icon btn-sm btn-secondary btn-edit"><i class="fas fa-pencil-alt"></i></a>
                      <a href="./proses/hapus.php?table=nilai_kriteria&id=<?= $data['id']; ?>" class="btn btn-icon btn-sm btn-danger btn-hapus" data-name="sub kriteria <?= $data['kriteria'] ?> dengan nilai <?= $data['nilai']; ?>"><i class="fas fa-trash"></i></a>
                    </td>
                  </tr>
              <?php
                  $no++;
                endwhile;
              else :
                echo '<tr><td colspan="5">Daftar sub kriteria belum tersedia</td></tr>';
              endif;
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>