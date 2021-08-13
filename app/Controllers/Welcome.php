<?php

namespace App\Controllers;

use App\Models\M_kelas;
use App\Models\M_mahasiswa;
use App\Models\M_matkul;
use App\Models\M_prodi;

class Welcome extends BaseController
{
	protected $prodi;
	protected $kelas;
	protected $mahasiswa;
	protected $matkul;

	public function __construct()
	{
		$this->prodi = new M_prodi();
		$this->kelas = new M_kelas();
		$this->mahasiswa = new M_mahasiswa();
		$this->matkul = new M_matkul();
	}

	public function index()
	{
		$data = [
			'title' => 'Selamat Datang',
		];
		return view('welcome/index', $data);
	}

	public function kelas($kode_prodi = null)
	{
		$data = [
			'title' => 'Daftar Kelas',
			'semester_aktif' => $this->semester_aktif->id_smt,
			'overview' => $this->prodi->overviewProdi($kode_prodi, $this->semester_aktif->id_smt), // info detail dari prodi yang dipilih
		];
		return view('welcome/kelas_prodi', $data);
	}

	public function matkul($id_kls = null, $smt = null)
	{
		// ambil data mata kuliah berdasarkan kelas, semester, dan id_smt
		$data_matkul = $this->matkul->dataMatkulKelas($id_kls, $smt, $this->semester_aktif->id_smt);
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
		$data_matkul = $this->matkul->overviewMatkul($id_mk, $id_kls);
		// pengecekan
		if ($data_matkul) :
			// jika data ada, ambil data berdasarkan id_mk dan id_kls
			$overview = $data_matkul;
		else :
			// jika data ada, ambil data HANYA berdasarkan id_mk
			$overview = $this->matkul->overviewMatkul($id_mk);
		endif;
		$data = [
			'title' => 'Daftar Modul Mata Kuliah',
			'overview' => $overview, // info detail dari matkul yang dipilih
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

	public function get_kelas()
	{
		if ($this->request->getVar()) {
			$kode_prodi = $this->request->getVar('kode_prodi');
			$kelas = $this->kelas->dataKelasProdi($kode_prodi, $this->semester_aktif->id_smt);
			if ($kelas) :
				$response = response(true, 'Data ditemukan!');
				$response['field'] = $kelas;
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

	public function get_matkul()
	{
		if ($this->request->getVar()) {
			$id_kls = $this->request->getVar('id_kls');
			$smt = $this->request->getVar('smt');
			$matkul = $this->matkul->dataMatkulKelas($id_kls, $smt, $this->semester_aktif->id_smt);
			if ($matkul) :
				$response = response(true, 'Data ditemukan!');
				$response['field'] = $matkul;
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

	public function get_prodi()
	{
		if ($this->request->getVar()) {
			$prodi = $this->prodi->findAll();
			if ($prodi) :
				$response = response(true, 'Data ditemukan!');
				$response['field'] = $prodi;
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
