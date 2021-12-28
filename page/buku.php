<div class="section-header">
  <h1>Buku</h1>
</div>
<div class="section-body">
  <div class="row">
    <div class="col-lg-4 col-md-12 col-12 col-sm-12">
      <form method="post" action="./proses/tambah.php" class="needs-validation" id="form" novalidate="" enctype="multipart/form-data">
        <input type="hidden" name="table" id="table" value="buku">
        <div class="card">
          <div class="card-header">
            <h4>Tambah Buku</h4>
          </div>
          <div class="card-body pb-0">
            <div class="form-group">
              <label>Judul</label>
              <input type="text" name="judul" id="judul" class="form-control" required>
              <div class="invalid-feedback">
                Judul tidak boleh kosong
              </div>
            </div>
            <div class="form-group">
              <label>Pengarang</label>
              <input type="text" name="pengarang" id="pengarang" class="form-control" required>
              <div class="invalid-feedback">
                Pengarang tidak boleh kosong
              </div>
            </div>
            <div class="form-group">
              <label>Sampul</label>
              <div class="custom-file mb-3">
                <input type="file" class="custom-file-input" name="sampul" id="sampul" required>
                <div class="invalid-feedback mt-2">
                  Silahkan pilih file terlebih dahulu
                </div>
                <label class="custom-file-label" for="sampul" style="overflow: hidden;">Choose file...</label>
              </div>
            </div>
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
          <h4>Daftar Buku</h4>
        </div>
        <div class="card-body">
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Judul</th>
                <th scope="col">Pengarang</th>
                <th scope="col" width="25%">Sampul</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $query = "SELECT * FROM buku";
              $execute = $konek->query($query);
              if ($execute->num_rows > 0) :
                $no = 1;
                while ($data = $execute->fetch_array(MYSQLI_ASSOC)) :
              ?>
                  <tr>
                    <th scope="row"><?= $no; ?></th>
                    <td><?= $data['judul']; ?></td>
                    <td><?= $data['pengarang']; ?></td>
                    <td><img src="../asset/img/<?= $data['sampul']; ?>" alt="<?= $data['judul']; ?>" class="img-thumbnail"></td>
                    <td>
                      <a href="./proses/tampil.php?table=buku&id=<?= $data['id']; ?>" class="btn btn-icon btn-sm btn-secondary btn-edit"><i class="fas fa-pencil-alt"></i></a>
                      <a href="./proses/hapus.php?table=buku&id=<?= $data['id']; ?>" class="btn btn-icon btn-sm btn-danger btn-hapus" data-name="<?= $data['judul'] ?>"><i class="fas fa-trash"></i></a>
                    </td>
                  </tr>
              <?php
                  $no++;
                endwhile;
              else :
                echo '<tr><td colspan="5">Daftar buku belum tersedia</td></tr>';
              endif;
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>