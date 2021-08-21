<?php

namespace App\Models;

use CodeIgniter\Model;

class M_matkul extends Model
{
    public function overviewMatkul($id_mk, $id_kls = null)
    {
        $builder = $this->db->table('v_overview_matkul');
        if (!empty($id_kls)) {
            $builder->where('id_kls', $id_kls);
        }
        $builder->where('id_mk', $id_mk);
        return $builder->get()->getRowArray();
    }

    public function dataMatkulKelas($id_kls, $smt, $id_smt)
    {
        return $this->db->table('v_matkul_kelas')
            ->where(['id_kls' => $id_kls, 'smt' => $smt, 'id_smt' => $id_smt])
            ->get()->getResultArray();
    }

    public function listModulMatkul($id_kls, $id_mk)
    {
        return $this->db->table('v_modul_matkul')
            ->orderBy('create_at', 'DESC')
            ->where(['id_kls' => $id_kls, 'id_mk' => $id_mk])
            ->get()->getResultArray();
    }

    public function listMateriMatkul($id_kls, $id_mk)
    {
        return $this->db->table('v_modul_matkul')
            ->orderBy('create_at', 'DESC')
            ->where(['id_kls' => $id_kls, 'id_mk' => $id_mk, 'jenis' => 'Materi'])
            ->get()->getResultArray();
    }

    public function listTugasMatkul($id_kls, $id_mk)
    {
        $today = ('Y-m-d');
        return $this->db->table('v_modul_matkul')
            ->orderBy('create_at', 'DESC')
            // ->where(['id_kls' => $id_kls, 'id_mk' => $id_mk, 'jenis' => 'Tugas', 'tgl_akhir <= ' => $today])
            ->where(['id_kls' => $id_kls, 'id_mk' => $id_mk, 'jenis' => 'Tugas'])
            ->get()->getResultArray();
    }

    public function tugasMatkul($id_classwork)
    {
        $today = ('Y-m-d');
        return $this->db->table('v_modul_matkul')
            ->orderBy('create_at', 'DESC')
            // ->where(['id_classwork' => $id_classwork, 'tgl_akhir <= ' => $today])
            ->where(['id_classwork' => $id_classwork])
            ->get()->getRowArray();
    }

    public function tugasMahasiswa($params)
    {
        return $this->db->table('learning_task')
            ->orderBy('create_at', 'DESC')
            ->where($params)
            ->get()->getResultArray();
    }
}
