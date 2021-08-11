<?php

namespace App\Controllers;

use App\Models\M_kelas;
use App\Models\M_mahasiswa;
use App\Models\M_matkul;
use App\Models\M_prodi;
use App\Models\M_semester;

class Welcome extends BaseController
{
	protected $prodi;
	protected $kelas;
	protected $semester;
	protected $mahasiswa;
	protected $matkul;

	public function __construct()
	{
		$this->prodi = new M_prodi();
		$this->kelas = new M_kelas();
		$this->semester = new M_semester();
		$this->mahasiswa = new M_mahasiswa();
		$this->matkul = new M_matkul();
	}

	public function index()
	{
		$data = [
			'title' => 'Selamat Datang',
			'prodi' => $this->prodi->findAll(),
		];
		return view('welcome/index', $data);
	}

	public function kelas($kode_prodi = null, $id_smt = null)
	{
		$_id_smt = ($id_smt) ? $id_smt : smt_aktif()['id_smt'];
		$data_kelas = $this->kelas->dataKelasProdi($kode_prodi, $_id_smt);
		if ($data_kelas) :
			$data = [
				'title' => 'Daftar Kelas',
				'semester' => $this->semester->where('a_periode_aktif', 1)->findAll(),
				'semester_aktif' => $_id_smt,
				'overview' => $this->prodi->overviewProdi($kode_prodi, $_id_smt),
				'kelas' => $data_kelas,
			];
			return view('welcome/kelas_prodi', $data);
		else :
			return $this->not_found('Data kelas tidak ditemukan.');
		endif;
	}

	public function matkul($id_kls = null, $smt = null, $id_smt = null)
	{
		$_id_smt = ($id_smt) ? $id_smt : smt_aktif()['id_smt'];
		$_smt = dekrip_str($smt);
		$data_matkul = $this->matkul->dataMatkulKelas($id_kls, $_smt, $_id_smt);
		if ($data_matkul) :
			$data = [
				'title' => 'Daftar Mata Kuliah',
			];
			return view('welcome/matkul_prodi', $data);
		else :
			return $this->not_found('Mata kuliah tidak ditemukan.');
		endif;
	}

	private function not_found($message)
	{
		$data = [
			'title' => 'Halaman Tidak Ditemukan',
			'message' => $message
		];
		return view('welcome/not-found', $data);
	}
}
