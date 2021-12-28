<div class="section-header">
  <h1>Bobot Kriteria</h1>
</div>
<div class="section-body">
  <div class="row">
    <div class="col-lg-8 col-md-12 col-12 col-sm-12 offset-lg-2">
      <?php
      $query = "SELECT * FROM bobot_kriteria";
      $execute = $konek->query($query);
      if ($execute->num_rows > 0) :
      ?>
        <form method="post" action="./proses/ubah.php" class="needs-validation" id="form" novalidate="" enctype="multipart/form-data">
          <input type="hidden" name="table" id="table" value="bobot_kriteria">
          <div class="card">
            <div class="card-header">
              <h4>Bobot Kriteria</h4>
            </div>
            <div class="card-body pb-0">
              <?php
              $query = "SELECT bobot_kriteria.*, kriteria.nama as kriteria FROM bobot_kriteria INNER JOIN kriteria ON kriteria.id = bobot_kriteria.kriteria_id";
              $execute = $konek->query($query);
              if ($execute->num_rows > 0) :
                $no = 1;
                while ($data = $execute->fetch_array(MYSQLI_ASSOC)) :
              ?>
                  <div class="form-group">
                    <label><?= $data['kriteria']; ?></label>
                    <input type="hidden" name="bobot_id[]" value="<?= $data['id']; ?>">
                    <input type="text" name="bobot[]" id="nilai" class="form-control" required value="<?= $data['bobot']; ?>">
                    <div class="invalid-feedback">
                      Nilai bobot <?= $data['nama']; ?> tidak boleh kosong
                    </div>
                  </div>
              <?php
                endwhile;
              endif;
              ?>
              <?php
              $query = "SELECT SUM(bobot) as bobot FROM bobot_kriteria";
              $execute = $konek->query($query);
              if ($execute->num_rows > 0) :
                $sum = $execute->fetch_row();
              ?>
                <p>Jumlah: <?= $sum[0]; ?></p>
              <?php
              endif;
              ?>
            </div>
            <div class="card-footer pt-0">
              <button class="btn btn-primary" id="buttonsimpan" type="submit">Simpan</button>
              <button class="btn btn-secondary" id="buttonreset" type="reset">Reset</button>
            </div>
          </div>
        </form>
      <?php
      else :
      ?>
        <form method="post" action="./proses/tambah.php" class="needs-validation" id="form" novalidate="" enctype="multipart/form-data">
          <input type="hidden" name="table" id="table" value="bobot_kriteria">
          <div class="card">
            <div class="card-header">
              <h4>Bobot Kriteria</h4>
            </div>
            <div class="card-body pb-0">
              <?php
              $query = "SELECT * FROM kriteria";
              $execute = $konek->query($query);
              if ($execute->num_rows > 0) :
                $no = 1;
                while ($data = $execute->fetch_array(MYSQLI_ASSOC)) :
              ?>
                  <div class="form-group">
                    <label><?= $data['nama']; ?></label>
                    <input type="hidden" name="kriteria[]" value="<?= $data['id']; ?>">
                    <input type="text" name="bobot[]" id="nilai" class="form-control" required>
                    <div class="invalid-feedback">
                      Nilai bobot <?= $data['nama']; ?> tidak boleh kosong
                    </div>
                  </div>
              <?php
                endwhile;
              endif;
              ?>
              <?php
              $query = "SELECT SUM(bobot) as bobot FROM bobot_kriteria";
              $execute = $konek->query($query);
              if ($execute->num_rows > 0) :
                $sum = $execute->fetch_row();
              ?>
                <p>Jumlah: <?= $sum[0]; ?></p>
              <?php
              endif;
              ?>
            </div>
            <div class="card-footer pt-0">
              <button class="btn btn-primary" id="buttonsimpan" type="submit">Simpan</button>
              <button class="btn btn-secondary" id="buttonreset" type="reset">Reset</button>
            </div>
          </div>
        </form>
      <?php
      endif;
      ?>
    </div>
  </div>
</div>