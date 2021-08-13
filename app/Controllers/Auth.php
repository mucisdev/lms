<?php

namespace App\Controllers;

use App\Models\M_auth;
use App\Models\M_mahasiswa;

class Auth extends BaseController
{
    protected $auth;
    protected $mahasiswa;
    public function __construct()
    {
        $this->auth = new M_auth();
        $this->mahasiswa = new M_mahasiswa();
    }

    public function index()
    {
        $data = [
            'title' => 'Halaman Login'
        ];
        return view('auth/index', $data);
    }

    public function login()
    {
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('auth'));
    }
}
