<?php

namespace App\Models;

use CodeIgniter\Model;

class M_auth extends Model
{
    // ambil data user berdasarkan username dan belum dihapus
    public function getUser($username)
    {
        return $this->db->table('v_akun')->getWhere(['username' => $username])->getRowArray();
    }

    public function getUserDumy($username)
    {
        return $this->db->table('learning_akun_dumy')->getWhere(['username' => $username])->getRowArray();
    }
}
