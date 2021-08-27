<?php

namespace App\Controllers;

use App\Models\M_kelas;
use App\Models\M_mahasiswa;
use App\Models\M_matkul;
use App\Models\M_prodi;
use App\Models\M_diskusi;

class GetData extends BaseController
{
	protected $prodi;
	protected $kelas;
	protected $mahasiswa;
	protected $matkul;
	protected $diskusi;

	public function __construct()
	{
		$this->prodi = new M_prodi();
		$this->kelas = new M_kelas();
		$this->mahasiswa = new M_mahasiswa();
		$this->matkul = new M_matkul();
		$this->diskusi = new M_diskusi();
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
			$response = response(true, 'Data ditemukan!');
			$response['prodi'] = $prodi; // data prodi
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
			$kelas = $this->kelas->dataKelasProdi($kode_prodi, $this->smt_aktif);
			// response yang dikirim
			$response = response(true, 'Data ditemukan!');
			$response['overview_prodi'] = $this->prodi->overviewProdi($kode_prodi, $this->smt_aktif); // data overview
			$response['kelas'] = $kelas; // data kelas
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
			$matkul = $this->matkul->dataMatkulKelas($id_kls, $smt, $this->smt_aktif);
			// respons yang dikirim
			$response = response(true, 'Data ditemukan!');
			$response['overview_kelas'] = $this->kelas->overviewKelas($id_kls);
			$response['mahasiswa'] = $this->mahasiswa->dataMahasiswaKelas($id_kls);
			$response['matkul'] = $matkul; // data matkul
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
			// ambil tugas berdasarkan kelas dan matkul
			$list_tugas = $this->matkul->listTugasMatkul($id_kls, $id_mk);
			$response = response(true, 'Data ditemukan!');
			$response['overview_matkul'] = $this->matkul->overviewMatkul($id_mk, $id_kls);
			$response['materi'] = $list_materi; // data materi
			$response['tugas'] = $list_tugas; // data tugas
		} else {
			$response = response(false, 'Tidak ada data yang diterima!');
		}

		// kirim nilai csrf yang terbaru
		$response['csrf_token'] = csrf_hash();
		// return $response dalam bentuk json
		return $this->response->setJSON($response);
	}

	public function get_tugas_detail()
	{
		// cek post data
		if ($this->request->getVar()) {
			// id_classword
			$id_classwork = $this->request->getVar('id_classwork');
			// ambil tugas berdasarkan kelas dan id_classwork
			$tugas_detail = $this->matkul->tugasMatkul($id_classwork);
			if ($tugas_detail) :
				foreach ($tugas_detail as $row) {
					$ret = [
						'id_classwork' => $row['id_classwork'],
						'id_kls' => $row['id_kls'],
						'kode_prodi' => $row['kode_prodi'],
						'jenjang' => $row['jenjang'],
						'nm_prodi' => $row['nm_prodi'],
						'nm_prodi_e' => $row['nm_prodi_e'],
						'id_mk' => $row['id_mk'],
						'nm_mk' => $row['nm_mk'],
						'nm_mk_e' => $row['nm_mk_e'],
						'id_pengajar' => $row['id_pengajar'],
						'jenis' => $row['jenis'],
						'judul' => $row['judul'],
						'deskripsi' => $row['deskripsi'],
						'link' => $row['link'],
						'file' => $row['file'],
						'tgl_akhir' => $row['tgl_akhir'],
						'create_at' => $row['create_at'],
						'nm_dosen' => $row['nm_dosen'],
					];

					$data[] = $ret;
				}
				$response = response(true, 'Data ditemukan!');
				$response['tugas_detail'] = $tugas_detail; // data tugas
			else :
				$response = response(false, 'Tidak ada tugas!');
			endif;
		} else {
			$response = response(false, 'Tidak ada data yang diterima!');
		}

		// kirim nilai csrf yang terbaru
		$response['csrf_token'] = csrf_hash();
		// return $response dalam bentuk json
		return $this->response->setJSON($response);
	}

	public function get_tugas_saya()
	{
		if ($this->request->getVar()) {
			$params = [
				'id_classwork' => $this->request->getVar('id_classwork'),
				'id_reg_pd' => $this->request->getVar('id_reg_pd'),
			];
			$tugas_saya = $this->matkul->tugasMahasiswa($params);
			if ($tugas_saya) {
				$response = response(true, 'Data ditemukan!');
				$response['tugas_saya'] = $tugas_saya; // data tugas
			} else {
				$response = response(false, 'Tidak ada tugas!');
			}
		} else {
			$response = response(false, 'Tidak ada data yang diterima!');
		}
	}

	public function get_info()
	{
		if ($this->request->getVar()) {
			$params = [
				'id_kls' => $this->request->getVar('id_kls'),
				'id_mk' => $this->request->getVar('id_mk'),
			];
			$halaman = $this->request->getVar('halaman');
			$data = array();
			$result  = $this->diskusi->getInformasi($params, (int)$halaman);
			foreach ($result as $row) {
				$ret = [
					'id_informasi' => $row['id_informasi'],
					'id_pengajar' => $row['id_pengajar'],
					'informasi' => $row['informasi'],
					'file' => $row['file'],
					'time_stamp' => time_stamp($row['create_at']),
					'nm_dosen' => ucwords(strtolower($row['nm_dosen'])),
				];

				$data[] = $ret;
			}
			$response = response(true, 'Data ditemukan!');
			$response['field'] = $data;
		} else {
			$response = response(false, 'Tidak ada data yang diterima!');
		}
		// kirim nilai csrf yang terbaru
		$response['csrf_token'] = csrf_hash();
		// return $response dalam bentuk json
		return $this->response->setJSON($response);
	}

	public function get_komentar()
	{
		// cek post data
		if ($this->request->getVar()) {
			$params = [
				'a.id_informasi' => $this->request->getVar('id_informasi')
			];
			$result = $this->diskusi->getDiskusi($params);
			$data = array();
			if ($result) {
				foreach ($result as $row) {
					$ret = [
						'id_komentar' => $row['id_komentar'],
						'id_akun' => $row['id_akun'],
						'komentar' => $row['komentar'],
						'time_stamp' => time_stamp($row['create_at']),
						'nm_akun' => ucwords(strtolower($row['nm_akun'])),
					];

					$data[] = $ret;
				}
				$response = response(true, 'Data ditemukan!');
				$response['field'] = $data;
			} else {
				$response = response(false, 'Tidak ada diskusi!');
			}
		} else {
			$response = response(false, 'Tidak ada data yang diterima!');
		}

		// kirim nilai csrf yang terbaru
		$response['csrf_token'] = csrf_hash();
		// return $response dalam bentuk json
		return $this->response->setJSON($response);
	}

	public function post_komentar()
	{
		// cek post data
		if ($this->request->getVar()) {
			$post = $this->request->getVar();
			$data = [
				'id_informasi' => (isset($post['id_informasi']) ? $post['id_informasi'] : null),
				'id_classwork' => (isset($post['id_classwork']) ? $post['id_classwork'] : null),
				'id_akun' => $post['id_akun'],
				'komentar' => $post['komentar'],
				'create_at' => date('Y-m-d H:i:s')
			];
			$simpan = $this->diskusi->save($data);
			if ($simpan) {
				$response = response(true, 'Komentar berhasil dikirim.');
			} else {
				$response = response(false, 'Komentar gagal dikirim!');
			}
		} else {
			$response = response(false, 'Tidak ada data yang diterima!');
		}

		// kirim nilai csrf yang terbaru
		$response['csrf_token'] = csrf_hash();
		// return $response dalam bentuk json
		return $this->response->setJSON($response);
	}

	public function delete_komentar()
	{
		// cek post data
		if ($this->request->getVar()) {
			$id_komentar = $this->request->getVar('id_komentar');
			$hapus_komen = $this->diskusi->delete($id_komentar);
			if ($hapus_komen) {
				$response = response(true, 'Komentar berhasil dihapus.');
			} else {
				$response = response(false, 'Komentar gagal dihapus!');
			}
		} else {
			$response = response(false, 'Tidak ada data yang diterima!');
		}

		// kirim nilai csrf yang terbaru
		$response['csrf_token'] = csrf_hash();
		// return $response dalam bentuk json
		return $this->response->setJSON($response);
	}

	public function ganti_semester()
	{
		if ($this->request->getVar()) {
			$id_smt = $this->request->getVar('id_smt');
			// hapus session smt yang sebelumnya
			session()->remove(['id_smt', 'nm_smt']);
			// ambil data smt berdasarkan id_smt baru
			$smt = $this->semester->find($id_smt);
			session()->set([
				'id_smt' => $smt['id_smt'],
				'nm_smt' => $smt['nm_smt'],
			]);
			// respon berhasil
			$response = response(true, 'Semester berhasil diubah!');
		} else {
			$response = response(false, 'Tidak ada data yang diterima!');
		}

		// kirim nilai csrf yang terbaru
		$response['csrf_token'] = csrf_hash();
		// return $response dalam bentuk json
		return $this->response->setJSON($response);
	}
}
