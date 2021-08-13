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
			'title' => 'Kelas',
			'kode_prodi' => $kode_prodi
		];
		return view('welcome/kelas_prodi', $data);
	}

	public function matkul($id_kls = null, $smt = null)
	{
		$data = [
			'title' => 'Mata Kuliah',
			'id_kls' => $id_kls,
			'smt' => $smt,
		];
		return view('welcome/matkul_prodi', $data);
	}

	public function modul($id_kls = null, $id_mk = null)
	{
		$data = [
			'title' => 'Materi',
			'id_kls' => $id_kls,
			'id_mk' => $id_mk,
		];
		return view('welcome/modul_matkul', $data);
	}

	public function get_prodi()
	{
		// cek post data
		if ($this->request->getVar()) {
			// ambil data prodi
			$prodi = $this->prodi->findAll();
			// pengecekan prodi
			if ($prodi) :
				$response = response(true, 'Data ditemukan!');
				$response['field'] = $prodi; // data prodi
			else :
				$response = response(false, 'Tidak ada Program Studi!');
			endif;
		} else {
			$response = response(false, 'Tidak ada data yang diterima!');
		}

		// kirim nilai csrf yang terbaru
		$response['csrf_token'] = csrf_hash();
		// return $response dalam bentuk json
		return $this->response->setJSON($response);
	}

	public function get_kelas()
	{
		// cek post data
		if ($this->request->getVar()) {
			// kode_prodi
			$kode_prodi = $this->request->getVar('kode_prodi');
			// ambil kelas berdasarkan prodi yg dipilih
			$kelas = $this->kelas->dataKelasProdi($kode_prodi, $this->semester_aktif->id_smt);
			// pengecekan ketersediaan kelas
			if ($kelas) :
				// response yang dikirim
				$response = response(true, 'Data ditemukan!');
				$response['overview_prodi'] = $this->prodi->overviewProdi($kode_prodi, $this->semester_aktif->id_smt); // data overview
				$response['field'] = $kelas; // data kelas
			else :
				$response = response(false, 'Program studi yang dipilih tidak memiliki kelas.');
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
		// cek post data
		if ($this->request->getVar()) {
			// kode_prodi
			$id_kls = $this->request->getVar('id_kls');
			// semester
			$smt = $this->request->getVar('smt');
			// ambil matkul berdasarkan kelas yang dipilih
			$matkul = $this->matkul->dataMatkulKelas($id_kls, $smt, $this->semester_aktif->id_smt);
			// pengecekan ketersediaan matkul
			if ($matkul) :
				// respons yang dikirim
				$response = response(true, 'Data ditemukan!');
				$response['overview_kelas'] = $this->kelas->overviewKelas($id_kls);
				$response['mahasiswa'] = $this->mahasiswa->dataMahasiswaKelas($id_kls);
				$response['field'] = $matkul; // data matkul
			else :
				$response = response(false, 'Tidak ada mata kuliah pada kelas ini!');
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
		// cek post data
		if ($this->request->getVar()) {
			// id_kls kelas
			$id_kls = $this->request->getVar('id_kls');
			// id_mk matakuliah
			$id_mk = $this->request->getVar('id_mk');
			// ambil materi berdasarkan kelas dan matkul
			$list_materi = $this->matkul->listMateriMatkul($id_kls, $id_mk);
			// pengecekan ketersediaan materi
			if ($list_materi) :
				$response = response(true, 'Data ditemukan!');
				$response['overview_matkul'] = $this->matkul->overviewMatkul($id_mk);
				$response['field'] = $list_materi; // data materi
			else :
				$response = response(false, 'Mata kuliah ini belum memiliki materi apapun.');
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
