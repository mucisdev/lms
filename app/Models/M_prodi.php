<?php

namespace App\Models;

use CodeIgniter\Model;

class M_prodi extends Model
{
    protected $table = "ref_prodi";
    protected $primaryKey = 'kode_prodi';

    public function overviewProdi($kode_prodi, $id_smt)
    {
        return $this->db->table('v_overview_prodi')
            ->where(['kode_prodi' => $kode_prodi, 'id_smt' => $id_smt])
            ->get()->getRowArray();
    }
}
