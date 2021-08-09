<?php

namespace App\Controllers;

use App\Models\M_prodi;

class Welcome extends BaseController
{
	protected $prodi;

	public function __construct()
	{
		$this->prodi = new M_prodi();
	}

	public function index()
	{
		$data = [
			'title' => 'Selamat Datang',
			'prodi' => $this->prodi->findAll()
		];
		return view('welcome/index', $data);
	}
}
