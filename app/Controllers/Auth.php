<?php

namespace App\Controllers;

use App\Models\M_auth;

class Auth extends BaseController
{
    protected $auth;
    public function __construct()
    {
        $this->auth = new M_auth();
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
        // data yang diterima
        $username = trim($this->request->getPost('username'));
        $password = trim($this->request->getPost('password'));

        // ambil data user berdasarkan username
        $dataUser = $this->auth->getUserDumy($username);
        // jika ada, lakukan verifikasi
        if ($dataUser) {
            // mencocokan password
            if (password_verify($password, $dataUser['password'])) {
                // jika password cocok, ambil data
                // periksa level akun
                if ($dataUser['role'] == 'Mahasiswa') {
                    $akun = [
                        'username' => $dataUser['username'],
                        'nama_user' => $dataUser['nama'],
                        // 'id_reg' => $dataUser['id_reg'],
                        'id_akun' => $dataUser['id_akun'],
                        'role' => $dataUser['role'],
                    ];
                } else {
                    $akun = [
                        'username' => $dataUser['username'],
                        'nama_user' => $dataUser['nama'],
                        // 'id_reg' => $dataUser['id_reg'],
                        'id_akun' => $dataUser['id_akun'],
                        'role' => $dataUser['role'],
                    ];
                }
                // buat session
                session()->set([
                    'nama_user' => $akun['nama_user'],
                    'username' => $akun['username'],
                    // 'id_reg' => $akun['id_reg'],
                    'id_akun' => $akun['id_akun'],
                    'level' => $akun['role'],
                    'id_smt' => $this->semester_aktif->id_smt,
                    'logged_in' => true
                ]);
                // respon berhasil login
                $response = response(true, 'Berhasil login!');
                // kirim level akun
                // untuk mengatur arah redirect
                $response['role'] = $dataUser['role'];
            } else {
                // respon password salah
                $response = response(false, 'Password salah!');
            }
        } else {
            // respon data tidak ditemukan
            $response = response(false, 'Akun tidak ditemukan!');
        }

        // kirim nilai csrf yang terbaru
        $response['csrf_token'] = csrf_hash();
        // return $response dalam bentuk json
        return $this->response->setJSON($response);
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(site_url('welcome'));
    }
}
