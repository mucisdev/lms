<?php

namespace App\Models;

use CodeIgniter\Model;

class M_matkul extends Model
{
    public function dataMatkulProdi($kode_prodi, $start, $limit)
    {
        return $this->db->table('v_mk_kurikulum')
            ->limit(10)
            ->where('kode_prodi', $kode_prodi)
            // ->getWhere(['kode_prodi' => $kode_prodi], 0, 10)
            ->get()->getResult();
    }
}
