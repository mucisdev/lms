<?php

namespace App\Models;

use CodeIgniter\Model;

class M_mahasiswa extends Model
{
    public function dataMahasiswa($username, $id_smt)
    {
        return $this->db->table('v_mahasiswa_aktif')
            ->where(['nipd' => $username, 'id_smt' => $id_smt])
            ->get()->getRowArray();
    }

    public function dataMahasiswaKelas($id_kls)
    {
        return $this->db->table('v_mahasiswa_kelas')
            ->select('nm_pd')
            ->orderBy('nm_pd', 'ASC')
            ->where('id_kls', $id_kls)
            ->get()->getResultArray();
    }
}
