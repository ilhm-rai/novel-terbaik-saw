<div class="section-header">
  <h1>Kriteria</h1>
</div>
<div class="section-body">
  <div class="row">
    <div class="col-lg-4 col-md-12 col-12 col-sm-12">
      <form method="post" action="./proses/tambah.php" class="needs-validation" id="form" novalidate="" enctype="multipart/form-data">
        <input type="hidden" name="table" id="table" value="kriteria">
        <div class="card">
          <div class="card-header">
            <h4>Tambah Kriteria</h4>
          </div>
          <div class="card-body pb-0">
            <div class="form-group">
              <label>Kriteria</label>
              <input type="text" name="kriteria" id="kriteria" class="form-control" required>
              <div class="invalid-feedback">
                Kriteria tidak boleh kosong
              </div>
            </div>
            <div class="form-group">
              <label>Atribut</label>
              <select class="custom-select my-1" name="atribut" id="atribut">
                <option value="Benefit">Benefit</option>
                <option value="Cost">Cost</option>
              </select>
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
          <h4>Daftar Kriteria</h4>
        </div>
        <div class="card-body">
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">Kode</th>
                <th scope="col">Kriteria</th>
                <th scope="col">Atribut</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $query = "SELECT * FROM kriteria";
              $execute = $konek->query($query);
              if ($execute->num_rows > 0) :
                $no = 1;
                while ($data = $execute->fetch_array(MYSQLI_ASSOC)) :
              ?>
                  <tr>
                    <th scope="row">C<?= $no; ?></th>
                    <td><?= $data['nama']; ?></td>
                    <td><?= $data['atribut']; ?></td>
                    <td>
                      <a href="./proses/tampil.php?table=kriteria&id=<?= $data['id']; ?>" class="btn btn-icon btn-sm btn-secondary btn-edit"><i class="fas fa-pencil-alt"></i></a>
                      <a href="./proses/hapus.php?table=kriteria&id=<?= $data['id']; ?>" class="btn btn-icon btn-sm btn-danger btn-hapus" data-name="<?= $data['nama'] ?>"><i class="fas fa-trash"></i></a>
                    </td>
                  </tr>
              <?php
                  $no++;
                endwhile;
              else :
                echo '<tr><td colspan="4">Daftar kriteria belum tersedia</td></tr>';
              endif;
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>