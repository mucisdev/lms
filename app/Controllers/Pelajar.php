<?php

namespace App\Controllers;

use App\Models\M_mahasiswa;
use App\Models\M_matkul;

class Pelajar extends BaseController
{
    protected $mahasiswa;
    protected $matkul;

    public function __construct()
    {
        $this->mahasiswa = new M_mahasiswa();
        $this->matkul = new M_matkul();
    }

    public function index()
    {
        $mahasiswa = $this->mahasiswa->dataMahasiswa(session()->get('username'), session()->get('id_smt'));
        $data = [
            'title' => 'Selamat Datang',
            'mahasiswa' => $mahasiswa
        ];
        return view('pelajar/index', $data);
    }

    public function modul($id_kls = null, $id_mk = null)
    {
        $data = [
            'title' => 'Materi dan Tugas',
            'id_kls' => $id_kls,
            'id_mk' => $id_mk,
        ];
        return view('pelajar/materi_tugas', $data);
    }

    public function tugas($id_classwork = null)
    {
        $detail_tugas = $this->matkul->tugasMatkul($id_classwork);
        dd($detail_tugas);
        $data = array(
            'title'   => "Tugas",
            'm_learning' => "active border-left",
            'id_classwork' => $id_classwork,
            'id_reg_pd' => session()->id_reg,
        );
        return view('pelajar/tugas_saya', $data);
    }
}
