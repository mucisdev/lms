<?php

namespace App\Models;

use CodeIgniter\Model;

class M_auth extends Model
{
    protected $table = "siakad_akunmhs";

    // ambil data user berdasarkan username dan belum dihapus
    public function getUser($username)
    {
        return $this->select('user_mhs, pass_mhs')->where(['user_mhs' => $username, 'soft_del' => '0'])->first();
    }
}
