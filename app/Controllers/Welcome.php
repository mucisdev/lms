<?php

namespace App\Controllers;

class Welcome extends BaseController
{

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

	public function modul($id_kls = null, $id_mk = null, $smt = null)
	{
		$data = [
			'title' => 'Materi',
			'id_kls' => $id_kls,
			'id_mk' => $id_mk,
			'smt' => $smt,
		];
		return view('welcome/modul_matkul', $data);
	}

	public function semester()
	{
		$smt = $this->semester->getWhere(['a_periode_aktif' => 1])->getResultArray();
		$data = [
			'title' => 'Semester',
			'semester' => $smt,
		];
		return view('welcome/semester', $data);
	}
}
