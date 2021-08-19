<?php

namespace App\Models;

use Michalsn\Uuid\UuidModel;

class M_diskusi extends UuidModel
{

    protected $table = 'learning_komentar';
    protected $primaryKey = 'id_komentar';
    protected $uuidFields = ['id_komentar'];
    protected $allowedFields = ['id_informasi', 'id_classwork', 'id_akun', 'komentar', 'create_at'];
    protected $uuidUseBytes = false;

    public function getDiskusi($data)
    {
        return $this->db->table('learning_komentar a')->distinct()
            ->select('a.id_komentar, b.id_informasi, IF(ISNULL(nm_dosen),nama_mhs,nm_dosen) AS nm_akun, a.komentar, a.create_at, a.id_akun')
            ->join('learning_informasi b', 'a.id_informasi = b.id_informasi', 'left')
            ->join('sidos_akun c', 'a.id_akun = c.id_akun_sidos', 'left')
            ->join('siakad_akunmhs d', 'a.id_akun = d.id_akunmhs', 'left')
            ->join('learning_classwork e', 'a.id_classwork = e.id_classwork', 'left')
            ->where($data)
            ->groupBy('komentar')
            ->orderBy('a.create_at', 'asc')
            ->get()->getResultArray();
    }

    public function getInformasi($data, $offset)
    {
        return $this->db->table('learning_informasi a')
            ->select('a.*, nm_dosen')
            ->join('siakad_ajar_dosen b', 'a.id_pengajar = b.id_pengajar', 'left')
            ->join('siakad_reg_dosen c', 'b.id_reg_dosen = c.id_reg_dosen', 'left')
            ->join('siakad_dosen d', 'c.id_dosen = d.id_dosen', 'left')
            ->where($data)
            ->limit(2, $offset)
            ->orderBy('a.create_at', 'desc')
            ->get()->getResultArray();
    }
}
