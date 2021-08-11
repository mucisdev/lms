<?php

namespace App\Models;

use CodeIgniter\Model;

class M_matkul extends Model
{
    public function dataMatkulKelas($id_kls, $smt, $id_smt)
    {
        return $this->db->table('v_matkul_kelas')
            ->where(['id_kls' => $id_kls, 'smt' => $smt, 'id_smt' => $id_smt])
            ->get()->getResultArray();
    }
}
