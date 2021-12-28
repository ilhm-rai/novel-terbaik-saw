<?php

/**
 * Created by PhpStorm.
 * User: dimas
 * Date: 23/06/2018
 * Time: 10:50
 */
class saw
{

    private $konek;
    public $simpanNormalisasi = array();

    public function __construct($konek)
    {
        $this->konek = $konek;
    }
    //mendapatkan kriteria
    public function getKriteria()
    {
        $querykriteria = "SELECT nama FROM kriteria";
        $execute = $this->konek->query($querykriteria);
        return $execute->fetch_all(MYSQLI_ASSOC);
    }
    //mendapatkan alternative
    public function getAlternative()
    {
        $data = array();
        $queryAlternative = "SELECT buku.judul, nilai_buku.buku_id FROM nilai_buku INNER JOIN buku ON buku.id = nilai_buku.buku_id GROUP BY buku_id ";
        $execute = $this->konek->query($queryAlternative);
        return $execute->fetch_all(MYSQLI_ASSOC);
    }
    public function getNilaiMatriks($id_buku)
    {
        $queryGetNilai = "SELECT nilai_kriteria.nilai, kriteria.atribut, nilai_buku.kriteria_id FROM nilai_buku JOIN kriteria ON kriteria.id=nilai_buku.kriteria_id JOIN nilai_kriteria ON nilai_kriteria.id=nilai_buku.nilai_kriteria_id WHERE buku_id='$id_buku'";
        $execute = $this->konek->query($queryGetNilai);
        return $execute->fetch_all(MYSQLI_ASSOC);
    }
    public function getArrayNilai($id_kriteria)
    {
        $data = array();
        $queryGetArrayNilai = "SELECT nilai_kriteria.nilai FROM nilai_buku INNER JOIN nilai_kriteria ON nilai_buku.nilai_kriteria_id=nilai_kriteria.id WHERE nilai_buku.kriteria_id='$id_kriteria'";
        $execute = $this->konek->query($queryGetArrayNilai);
        while ($row = $execute->fetch_array(MYSQLI_ASSOC)) {
            array_push($data, $row['nilai']);
        }
        return $data;
    }
    //rumus normalisasai
    public function normalisasi($array, $sifat, $nilai)
    {
        if ($sifat == 'Benefit') {
            $result = $nilai / max($array);
        } elseif ($sifat == 'Cost') {
            $result = min($array) / $nilai;
        }
        return round($result, 3);
    }
    //mendapatkan bobot kriteria
    public function getBobot($id_kriteria)
    {
        $queryBobot = "SELECT bobot FROM bobot_kriteria WHERE kriteria_id='$id_kriteria' ";
        $row = $this->konek->query($queryBobot)->fetch_array(MYSQLI_ASSOC);
        return $row['bobot'];
    }
    //meyimpan hasil perhitungan
    public function simpanHasil($buku_id, $hasil)
    {
        $queryCek = "SELECT hasil FROM hasil WHERE buku_id='$buku_id'";
        $execute = $this->konek->query($queryCek);
        if ($execute->num_rows > 0) {
            $querySimpan = "UPDATE hasil SET hasil='$hasil' WHERE buku_id='$buku_id'";
        } else {
            $querySimpan = "INSERT INTO hasil(buku_id,hasil) VALUES ('$buku_id', '$hasil')";
        }
        $execute = $this->konek->query($querySimpan);
    }
    //Kmencari kesimpulan
    public function getHasil()
    {
        $queryHasil     =   "SELECT hasil.hasil, buku.judul FROM hasil INNER JOIN buku ON buku.id=hasil.buku_id WHERE hasil.hasil=(SELECT MAX(hasil) FROM hasil)";
        $execute        =   $this->konek->query($queryHasil)->fetch_array(MYSQLI_ASSOC);
        echo "<p class='mt-3'>Jadi rekomendasi pemilihan buku novel terbaik jatuh pada <i>$execute[judul]</i> dengan Nilai <b>" . round($execute['hasil'], 3) . "</b></p>";
    }
}
