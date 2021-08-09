<?php

namespace App\Controllers;

use App\Models\M_matkul;

class Matkul extends BaseController
{
	protected $prodi;

	public function __construct()
	{
		$this->matkul = new M_matkul();
	}

	public function index()
	{
		if ($this->request->getPost()) {
			$kode_prodi = $this->request->getPost('kode_prodi');
			// dd($this->matkul->dataMatkulProdi($kode_prodi));
			$data = [
				'title' => 'Mata Kuliah',
				'matkul' => $this->matkul->dataMatkulProdi($kode_prodi)
			];
			return view('welcome/matkul_prodi', $data);
		} else {
			return redirect()->to('welcome')->with('error', 'Tidak dapat menemukan data program studi yang dipilih.');
		}
	}

	public function get_matkul($kode_prodi, $start = 0, $limit = 7)
	{
		// if ($this->request->getPost()) {
		// $kode_prodi = $this->request->getPost('kode_prodi');
		// $start = $this->request->getPost('start');
		// $limit = $this->request->getPost('limit');
		$response = $this->matkul->dataMatkulProdi($kode_prodi, $start, $limit);
		// } else {
		// 	$response = response(false, 'Tidak ada data yang diterima!');
		// }

		// kirim nilai csrf yang terbaru
		$response['csrf_token'] = csrf_hash();
		// return $response dalam bentuk json
		return $this->response->setJSON($response);
	}
}
