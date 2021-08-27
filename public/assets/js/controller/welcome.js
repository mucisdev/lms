// ambil data kelas
import { kelas } from './kelas.js';
if(document.getElementById('load-kelas')){
    window.addEventListener("DOMContentLoadedload", kelas());
}

// ambil data prodi
import { prodi } from './prodi.js';
if(document.getElementById('load-prodi')){
    window.addEventListener("DOMContentLoadedload", prodi());
}

// ambil data materi
import { materi, informasi } from './materi.js';
if(document.getElementById('load-materi')){
    window.addEventListener("DOMContentLoadedload", materi());
    // cek login
    // jika login, tampilkan tugas
    if(is_login) {
        informasi(csrf_token, halaman);
    }
}

// ambil data matkul
import { matkul } from './matkul.js';
if(document.getElementById('load-matkul')){
    window.addEventListener("DOMContentLoadedload", matkul())
}