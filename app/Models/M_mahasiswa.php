<?php

namespace App\Models;

use CodeIgniter\Model;

class M_mahasiswa extends Model
{
    public function dataMahasiswa($username)
    {
        return $this->db->table('siakad_reg_pd')
            ->select('id_reg_pd, nm_pd nipd, kode_prodi, id_prodi')
            ->join('siakad_pd', 'siakad_pd.id_pd = siakad_reg_pd.id_pd', 'LEFT JOIN')
            ->where('siakad_reg_pd.nipd', $username)
            ->get()->getRowArray();
    }
}
