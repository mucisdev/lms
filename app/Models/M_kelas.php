<?php

namespace App\Models;

use CodeIgniter\Model;

class M_kelas extends Model
{
    protected $table = "siakad_kelas";
    protected $primaryKey = 'id_kls';

    public function dataKelasProdi($kode_prodi, $id_smt)
    {
        return $this->db->table('v_total_mk_kelas')
            ->where(['kode_prodi' => $kode_prodi, 'id_smt' => $id_smt])
            ->get()->getResultArray();
    }
}
