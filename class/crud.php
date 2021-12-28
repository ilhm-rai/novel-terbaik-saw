<?php

/**
 * Created by PhpStorm.
 * User: dimas
 * Date: 10/06/2018
 * Time: 17:41
 */

class crud
{
    public function delete($query, $konek)
    {
        if ($konek->query($query) === TRUE) {
            $result = ['type' => "success", 'message' => 'Data berhasil dihapus!'];
        } else {
            $result = ['type' => 'failed', 'message' => $konek->error];
        }
        echo json_encode($result);
        $konek->close();
    }
    public function addData($query, $konek)
    {
        if ($konek->query($query) === TRUE) {
            $result = ['type' => "success", 'message' => 'Data berhasil ditambahkan!'];
        } else {
            $result = ['type' => 'failed', 'message' => $konek->error];
        }
        echo json_encode($result);
        $konek->close();
    }
    public function multiAddData($queryCek, $multiQuery, $konek)
    {
        if ($konek->query($queryCek)->num_rows > 0) {
            $result = ['type' => "unique", 'message' => 'Data tidak boleh sama!'];
        } else {
            if ($konek->multi_query($multiQuery) == TRUE) {
                $result = ['type' => "success", 'message' => 'Data berhasil ditambahkan!'];
            } else {
                $result = ['type' => 'failed', 'message' => $konek->error];
            }
        }
        echo json_encode($result);
        $konek->close();
    }
    public function update($query, $konek, $url)
    {
        if ($konek->multi_query($query) === TRUE) {
            $result = ['type' => "update", 'message' => 'Data berhasil diubah!', 'url' => $url];
        } else {
            $result = ['type' => 'failed', 'message' => $konek->error];
        }
        echo json_encode($result);
        $konek->close();
    }
    public function multiUpdate($queryCek, $multiQuery, $konek, $url)
    {
        if ($konek->query($queryCek)->num_rows > 0) {
            $result = ['type' => "unique", 'message' => 'Data tidak boleh sama!'];
        } else {
            if ($konek->multi_query($multiQuery) == TRUE) {
                $result = ['type' => "update", 'message' => 'Data berhasil diubah!', 'url' => $url];
            } else {
                $result = ['type' => 'failed', 'message' => $konek->error];
            }
        }
        echo json_encode($result);
        $konek->close();
    }

    public function getData($query, $table, $konek)
    {
        if ($konek->query($query)->num_rows > 0) {
            $execute = $konek->query($query);
            $result = ['type' => 'success', 'table' => $table];
            if ($table == 'nilai_buku')
                $result['data'] = $execute->fetch_all(MYSQLI_ASSOC);
            else
                $result['data'] = $execute->fetch_array(MYSQLI_ASSOC);
        } else {
            $result = ['type' => 'failed', 'message' => 'Data tidak ditemukan'];
        }
        echo json_encode($result);
        $konek->close();
    }
}
