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
		// dekrip kode prodi dari url
		$_kode_prodi = dekrip_str($kode_prodi);
		// pengecekan id_smt. jika kosong, default semester aktif.
		$id_smt_ = ($id_smt) ? $id_smt : enkrip_str(smt_aktif()['id_smt']);
		// dekrip id_smt dari id_smt_
		$_id_smt = dekrip_str($id_smt_);

		// ambil data kelas berdasarkan kode prodi dan id_smt
		$data_kelas = $this->kelas->dataKelasProdi($_kode_prodi, $_id_smt);
		// pengecekan data kelas
		if ($data_kelas) :
			$data = [
				'title' => 'Daftar Kelas',
				'semester' => $this->semester->where('a_periode_aktif', 1)->findAll(), // list semester yang bisa diakses
				'semester_aktif' => $_id_smt,
				'overview' => $this->prodi->overviewProdi($_kode_prodi, $_id_smt), // info detail dari prodi yang dipilih
				'kelas' => $data_kelas,
			];
			return view('welcome/kelas_prodi', $data);
		else :
			return $this->not_found('Data kelas tidak ditemukan.');
		endif;
	}

	public function matkul($id_kls = null, $smt = null, $id_smt = null)
	{
		// dekrip id_kls dari url
		$_id_kls = dekrip_str($id_kls);
		// dekrip smt dari url
		$_smt = dekrip_str($smt);
		// pengecekan id_smt. jika kosong, default semester aktif.
		$id_smt_ = ($id_smt) ? $id_smt : enkrip_str(smt_aktif()['id_smt']);
		// dekrip id_smt dari id_smt_
		$_id_smt = dekrip_str($id_smt_);

		// ambil data mata kuliah berdasarkan kelas, semester, dan id_smt
		$data_matkul = $this->matkul->dataMatkulKelas($id_kls, $_smt, $_id_smt);
		// pengecekan data maktul
		if ($data_matkul) :
			$data = [
				'title' => 'Daftar Mata Kuliah',
				'data_matkul' => $data_matkul,
				'overview' => $this->kelas->overviewKelas($id_kls), // info detail dari kelas yang dipilih
				'mahasiswa' => $this->mahasiswa->dataMahasiswaKelas($id_kls), // daftar mahasiswa pada kelas tersebut
			];
			return view('welcome/matkul_prodi', $data);
		else :
			return $this->not_found('Mata kuliah tidak ditemukan.');
		endif;
	}

	public function modul($id_kls = null, $id_mk = null)
	{
		$data = [
			'title' => 'Daftar Modul Mata Kuliah',
			'overview' => $this->matkul->overviewMatkul($id_kls, $id_mk), // info detail dari kelas yang dipilih
		];
		return view('welcome/modul_matkul', $data);
	}

	private function not_found($message)
	{
		$data = [
			'title' => 'Halaman Tidak Ditemukan',
			'message' => $message
		];
		return view('welcome/not-found', $data);
	}

	public function get_materi()
	{
		if ($this->request->getVar()) {
			$id_kls = $this->request->getVar('id_kls');
			$id_mk = $this->request->getVar('id_mk');
			$list_materi = $this->matkul->listMateriMatkul($id_kls, $id_mk);
			if ($list_materi) :
				$response = response(true, 'Data ditemukan!');
				$response['field'] = $list_materi;
			else :
				$response = response(false, 'Tidak ada data yang diterima!');
			endif;
		} else {
			$response = response(false, 'Tidak ada data yang diterima!');
		}

		// kirim nilai csrf yang terbaru
		$response['csrf_token'] = csrf_hash();
		// return $response dalam bentuk json
		return $this->response->setJSON($response);
	}

	public function get_tugas()
	{
		if ($this->request->getVar()) {
			$id_kls = $this->request->getVar('id_kls');
			$id_mk = $this->request->getVar('id_mk');
			$list_tugas = $this->matkul->listTugasMatkul($id_kls, $id_mk);
			if ($list_tugas) :
				$response = response(true, 'Data ditemukan!');
				$response['field'] = $list_tugas;
			else :
				$response = response(false, 'Tidak ada data yang diterima!');
			endif;
		} else {
			$response = response(false, 'Tidak ada data yang diterima!');
		}

		// kirim nilai csrf yang terbaru
		$response['csrf_token'] = csrf_hash();
		// return $response dalam bentuk json
		return $this->response->setJSON($response);
	}
}
