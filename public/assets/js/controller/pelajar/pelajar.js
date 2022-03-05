// // ambil data matkul
// import { matkul } from './matkul.js';
// if(document.getElementById('load-matkul')){
//     window.addEventListener("DOMContentLoadedload", matkul())
// }

// // ambil data materi
// import { materi } from './materi.js';
// if(document.getElementById('load-overview')){
//     materi();
// }
let csrf_new = 0;
if (document.getElementById('load-matkul')) {
    matkul();
}

if (document.getElementById('load-materi')) {
    materi();
    informasi(csrf_token, halaman);
}

async function matkul() {
    const myData = { id_kls: id_kls, smt: smt, csrf_token_name: csrf_token };
    const options = {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(myData)
    };
    try {
        // tampilkan loader
        document.getElementById('load-matkul').innerHTML = loading_spinner;
        // kirim data (method POST)
        const response = await fetch(site_url + 'GetData/get_matkul/', options);
        const json = await response.json();
        let html = '';
        if (json.status) {
            // tampilkan overview kelas berdasarkan kelas
            const overview = json.overview_kelas;
            html += `            
            <div class="row mt-3">
                <div class="col-12">
                    <div class="card" style="background-color: #3367d5;">
                        <div class="card-body py-4">
                        <div class="d-md-flex align-items-center justify-content-between">
                            <div>
                                <h2 class="text-white font-weight-bold d-flex align-items-center">
                                KELAS ${overview.nm_kls.toUpperCase()}
                                </h2>
                                <p class="card-text text-light  mb-5 mb-md-0">PROGRAM STUDI ${overview.jenjang.toUpperCase()} ${overview.nm_prodi.toUpperCase()}</p>
                            </div>
                            <div class="d-flex justify-content-start overflow-auto">
                                <div class="me-5">
                                    <p class="card-text text-light mb-0">Total matakuliah</p>
                                    <h3 class="text-light">${overview.jml_mk}</h3>
                                </div>
                                <div>
                                    <p class="card-text text-light mb-0">Total mahasiswa</p>
                                    <h3 class="text-light">${overview.jml_mhs}</h3>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-12 col-lg-8 col-xl-9">
                    <div class="card">
                        <div class="card-header px-4 pt-4">
                            <h5 class="card-title mb-0">Daftar Mata Kuliah</h5>
                        </div>
                        <div class="card-body">
                            <div class="list-group list-group-flush">`;
            // tampilkan daftar matkul yang ada pada kelas yang dipilih
            const result = json.field;
            result.forEach((data) => {
                html += `<li role="button" onclick="link_to('pelajar/modul/${data.id_kls}/${data.id_mk}')" class="list-group-item list-group-item-action d-flex align-items-center px-0">
                        <div class="fw-bold text-primary">${data.nm_mk.toUpperCase()}</div>
                    </li>`;
            });
            html += `</div>
                        </div>
                    </div>
                </div>`;

            // tampilkan data mahasiswa
            // tampilkan overview kelas berdasarkan kelas
            html += `<div class="col-12 col-lg-4 col-xl-3">
                        <div class="card">
                            <div class="card-header px-4 pt-4">
                                <h5 class="card-title mb-0">Daftar Mahasiswa</h5>
                            </div>
                            <div class="card-body px-0">
                                <div class="overflow-auto" style="max-height:500px;">
                                <div class="list-group list-group-flush">`;
            const mhsw = json.mahasiswa;
            mhsw.forEach((mhs) => {
                html += `<div class="list-group-item border-0">
                                            <div class="d-flex align-items-center">
                                                <div class="d-inline-block text-truncate">
                                                    <div class="stat d-inline-block text-center me-2">
                                                        <i class="align-middle far fa-fw fa-user"></i>
                                                    </div> ${mhs.nm_pd}
                                                </div>
                                            </div>
                                        </div>`;
            });
            html += `</div>
                            </div>
                        </div>
                
                    </div>
            </div>`;
        } else {
            html += `<div class="col-12 mx-auto pt-5 text-center">
                <h1 class="text-center mb-5">${json.message}</h1>
                <a class="btn btn-primary" role="button" onclick="history.go(-1)"><i class="align-middle me-2 fas fa-fw fa-arrow-left"></i> Kembali</a>
            </div>`;
        }
        document.getElementById('load-matkul').innerHTML = html;
    } catch (error) {
        // proses login gagal
        console.log(error);
        notif(error, 'danger');
    }
}

async function materi() {
    const myData = { id_kls: id_kls, id_mk: id_mk, csrf_token_name: csrf_token };
    const options = {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(myData)
    };
    try {
        // tampilkan loader
        document.getElementById('load-materi').innerHTML = loading_spinner;
        // kirim data (method POST)
        const response = await fetch(site_url + 'GetData/get_materi/', options);
        const json = await response.json();
        let html = '';
        if (json.status) {
            // tampilkan overview matkul berdasarkan matkul
            const overview = json.overview_matkul;
            html += `<div class="row">
                <div class="col-12">
                    <div class="card" style="background-color: #3367d5;">
                        <div class="card-body py-4">
                        <div class="d-md-flex align-items-center justify-content-between">
                            <div>
                                <h2 class="text-white font-weight-bold d-flex align-items-center">
                                ${overview.nm_mk.toUpperCase()}
                                </h2>
                                <p class="card-text text-light  mb-5 mb-md-0">PROGRAM STUDI ${overview.jenjang.toUpperCase()} ${overview.nm_prodi.toUpperCase()}</p>
                            </div>
                            <div class="d-flex justify-content-start overflow-auto">
                                <div class="me-5">
                                    <p class="card-text text-light mb-0">Total materi</p>
                                    <h3 class="text-light">${overview.jml_materi}</h3>
                                </div>
                                <div>
                                    <p class="card-text text-light mb-0">Total tugas</p>
                                    <h3 class="text-light">${overview.jml_tugas}</h3>
                                </div>
                            </div>
                        </div>
                            <hr>
                            <a class="btn btn-light" onclick="history.go(-1)"><i class="align-middle fas fa-fw fa-arrow-left"></i> KEMBALI</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-12 col-lg-4">
                    <div class="tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item col-6"><a class="nav-link active text-center" href="#tab-1" data-bs-toggle="tab" role="tab" aria-selected="true">Materi</a></li>
                            <li class="nav-item col-6"><a class="nav-link text-center" href="#tab-2" data-bs-toggle="tab" role="tab" aria-selected="false">Tugas</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab-1" role="tabpanel">
                                <h4 class="tab-title">Daftar Materi</h4>
                                <h6 class="card-subtitle text-muted mb-4">Klik pada nama materi untuk mendownload.</h6>
                                <ol class="list-group list-group-flush">`;
            const result_materi = json.materi;
            if (result_materi.length) {
                result_materi.forEach((data) => {
                    let file_type = (data.file) ? checkFileExtension(data.file) : '';
                    if (data.link) {
                        html += `<li class="list-group-item list-group-item-action d-flex align-items-center">
                                                <div class="stat d-inline-block text-center me-3"><i class="align-middle fas fa-fw fa-link"></i></div>
                                                ${data.judul.toUpperCase()}
                                            </li>`;
                    } else {
                        html += `<a target="materi_" rel="noreferrer" href="${link_cdn}materi/${data.file}" class="list-group-item list-group-item-action fw-bold text-primary d-flex justify-content-between align-items-center px-0">
                                                <div class="me-auto">
                                                ${data.judul.toUpperCase()}
                                                </div>
                                                ${iconFileType(file_type)}
                                            </a>`;
                    }
                });
            } else {
                html += `<li class="list-group-item d-flex align-items-center px-0">Tidak ada materi</li>`;
            }
            html += `</ol>
                            </div>
                            <div class="tab-pane" id="tab-2" role="tabpanel">
                                <h4 class="tab-title">Daftar Tugas</h4>
                                <h6 class="card-subtitle text-muted mb-4">Klik pada nama tugas untuk membuka.</h6>
                                <ol class="list-group list-group-flush">`;
            const result_tugas = json.tugas;
            if (result_tugas.length) {
                result_tugas.forEach((data) => {
                    html += `<a class="list-group-item list-group-item-action fw-bold text-primary px-0" onclick="link_to('pelajar/tugas/${data.id_classwork}')">${data.judul.toUpperCase()}</a>`;
                });
            } else {
                html += `<li class="list-group-item px-0">Tidak ada tugas</li>`;
            }
            html += `</ol>
                            </div>
                        </div>
                    </div>
				</div>

                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Forum Diskusi</h5>
                        </div>
                        <div class="card-body">
                            <div id="load-diskusi"></div>
                            
                            <div class="text-center" id="btnLoad">
                            </div>
                        </div>
                    </div>
                </div>
            </div>`;
        } else {
            html += `<div class="col-12 mx-auto pt-5 text-center">
                <h1 class="text-center mb-5">${json.message}</h1>
                <a class="btn btn-primary" role="button" onclick="history.go(-1)"><i class="align-middle me-2 fas fa-fw fa-arrow-left"></i> Kembali</a>
            </div>`;
        }
        document.getElementById('load-materi').innerHTML = html;
    } catch (error) {
        // proses login gagal
        console.log(error);
        notif(error, 'danger');
    }
}

async function informasi(csrf, hal) {
    const myData = { id_kls: id_kls, id_mk: id_mk, halaman: hal, csrf_token_name: csrf };
    const options = {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(myData)
    };
    try {
        // kirim data (method POST)
        const response = await fetch(site_url + 'GetData/get_info/', options);
        const json = await response.json();
        let html = '';
        if (json.status) {
            $('#btnLoad').hide();
            halaman = halaman + 2;
            const result = json.field;
            if (result.length) {
                result.forEach((data) => {
                    $('#btnLoad').show();
                    let regex = /(?![^<]*>|[^<>]*<\/)((https?:)\/\/[a-z0-9&#=.\/\-?_]+)/gi;
                    let str = data.informasi;
                    let val = regex.exec(str);
                    let subst = '<a href="$1">$1</a>';
                    let informasi = str.replace(regex, subst);
                    html += '<div class="card shadow-none border">';
                    html += '<div class="card-body container-fluid p-20">';
                    html += '<div class="slidePanel-inner">';
                    html += '<section class="slidePanel-inner-section">';
                    html += '<div class="forum-header d-flex justify-content-between">';
                    html += '<p class="name font-weight-bold mb-0">' + data.nm_dosen + '</p>';
                    html += '<small class="time text-muted"> ' + data.time_stamp + '</small></div>';
                    html += '<div class="forum-content">';
                    html += '<p>' + informasi + '</p></div></section>';
                    if (data.file) {
                        html += '<a href="' + link_cdn + 'files/' + data.file + '" target="_blank" rel="noreferrer">' + data.file + '  </a>';
                    }
                    get_komentar(data.id_informasi, json.csrf_token);
                    html += '<div class="mt-4" id="kom_' + data.id_informasi + '" ></div>';
                    html += '<form class="ml-4" autocomplete="off" id="form-komen_' + data.id_informasi + '">';
                    html += '<input type="hidden" id="id_informasi" name="id_informasi" value="' + data.id_informasi + '" >';
                    html += '<input type="hidden" id="id_akun" name="id_akun" value="' + id_akunmhs + '" >';
                    html += '<input type="hidden" class="csrf_token" name="csrf_token_name" value="' + json.csrf_token + '" >';
                    html += '<input type="hidden" id="id_pengajar" name="id_pengajar" value="' + data.id_pengajar + '" >';
                    html += '<div class="input-group">';
                    html += '<input type="text" id="komentar" required placeholder="Tambahkan komentar..." class="form-control mb-2 flex-grow-1" name="komentar">';
                    html += '<button class="btn btn-primary mb-2" id="btnKomen_' + data.id_informasi + '" type="submit" onClick="post_komen(`' + data.id_informasi + '`)">Kirim</button></div></form>';
                    html += '</div></div></div>';
                });
            } else {
                html += '<div class="text-center">Tidak ada diskusi</div>';
            }
            $("#load-diskusi").append(html);
        } else {
            html += 'Tidak ada diskusi';
            $('#btnLoad').hide();
        }
    } catch (error) {
        $('#btnLoad').hide();
        // proses login gagal
        console.log(error);
        notif(error, 'danger');
    }
}

function get_komentar(id_informasi, csrf) {
    $.ajax({
        url: site_url + 'GetData/get_komentar',
        type: "post",
        data: {
            id_informasi: id_informasi,
            id_classwork: null,
            csrf_token_name: csrf
        },
        dataType: 'json',
        success: function (results) {
            let komentar = '';
            const result = results.field;
            $.each(result, function (n, komen) {
                let regex = /(?![^<]*>|[^<>]*<\/)((https?:)\/\/[a-z0-9&#=.\/\-?_]+)/gi;
                let str = komen.komentar;
                let val = regex.exec(str);
                let subst = '<a href="$1">$1</a>';
                let result = str.replace(regex, subst);
                komentar += '<hr class="my-1"><div class="rounded-lg ml-4 mb-2 ps-4 py-0">';
                komentar += '<div class="forum-header">';
                komentar += '<span class="name fw-bold">' + komen.nm_akun + '</span>';
                komentar += '<small class="time text-muted float-end"> ' + komen.time_stamp + '</small></div>';
                if (komen.id_akun == id_akunmhs) {
                    komentar += '<form id="form-del-komen_' + komen.id_komentar + '">';
                    komentar += '<input type="hidden" class="csrf_del_komen" name="csrf_token_name" value="' + results.csrf_token + '">';
                    komentar += '<input type="hidden" name="id_komentar" value="' + komen.id_komentar + '">';
                    komentar += '<button type="submit" data-toggle="tooltip" data-placement="top" title="Hapus Komentar" onclick="hapus_komentar(`' + komen.id_komentar + '`, `' + id_informasi + '`)" class="btn btn-sm ms-3 link-hapus float-end"><i class="fas fa-times text-danger"></i></button>';
                    komentar += '</form>';
                }
                komentar += '<div class="forum-content">';
                komentar += '<p class="mb-0">' + result + '</p></div></div>';
            });
            $("#kom_" + id_informasi).html(komentar);

            html = `
            <button type="button" class="btn btn-primary btn-sm" onclick="informasi('${results.csrf_token}','${halaman}')">Muat Informasi Lainnya</button>
            </div>`;
            $("#btnLoad").html(html);
            $(".csrf_token").val(results.csrf_token);
            $(".csrf_del_komen").val(results.csrf_token);
        }
    });
}

function post_komen(id_informasi) {
    $("#form-komen_" + id_informasi).submit(function (e) {
        e.preventDefault();
        e.stopImmediatePropagation();
        let komen = new FormData(this);
        let btnKomen = document.getElementById('btnKomen_' + id_informasi);
        $.ajax({
            url: site_url + 'GetData/post_komentar',
            type: "post",
            data: komen,
            contentType: false,
            cache: false,
            processData: false,
            dataType: 'json',
            beforeSend: function () {
                btnKomen.disabled = true;
                btnKomen.textContent = "mengirim";
            },
            success: function (data) {
                $("#form-komen_" + id_informasi).trigger('reset');
                get_komentar(id_informasi, data.csrf_token);
                btnKomen.disabled = false;
                btnKomen.textContent = "Kirim";
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.responseJSON);
            }
        });
    });
}

function hapus_komentar(id_komentar, id_informasi) {
    document.getElementById('form-del-komen_' + id_komentar).addEventListener('submit', function (event) {
        event.preventDefault();
        const myData = new FormData(this);
        const options = {
            method: 'POST',
            body: myData
        };
        try {
            const URL = site_url + "GetData/delete_komentar";
            fetch(URL, options)
                .then((response) => response.json())
                .then((result) => {
                    if (!result.status) {
                        notif(result.message, result.type);
                    }
                    get_komentar(id_informasi, result.csrf_token);
                })
        } catch (error) {
            // proses login gagal
            console.log(error);
            notif(error, 'danger');
            //reload table
            $('#dt-peserta').DataTable().ajax.reload();
        }
    });
}

function detail_tugas() {
    const myData = { id_kls: id_kls, smt: smt, csrf_token_name: csrf_token };
    const options = {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(myData)
    };
    try {
        // tampilkan loader
        document.getElementById('load-kelas').innerHTML = loading_spinner;
        // kirim data (method POST)
        const response = await fetch(site_url + 'GetData/get_kelas/', options);
        const json = await response.json();
        let html = '';
        if (json.status) {
            // tampilkan overview prodi berdasarkan kode_prodi
            const tugas = json.tugas_detail;
            overview += `<div class="row mb-3 mb-xl-3">
            <div class="col-12">
            <div class="card" style="background-color: #3367d5;">
                <div class="card-body py-4">
                <div class="d-md-flex align-items-center justify-content-between">
                    <div>
                    <p class="card-text text-light mb-1">${tugas.nm_dosen.toUpperCase()}</p>
                        <h2 class="text-white font-weight-bold d-flex align-items-center">
                        KELAS ${overview.judul.toUpperCase()}
                        </h2>
                        <p class="card-text text-light  mb-5 mb-md-0">PROGRAM STUDI ${overview.jenjang.toUpperCase()} ${overview.nm_prodi.toUpperCase()}</p>
                    </div>
                    <div class="d-flex justify-content-start overflow-auto">
                        <div class="me-5">
                            <p class="card-text text-light mb-0">Total matakuliah</p>
                            <h3 class="text-light">${overview.jml_mk}</h3>
                        </div>
                        <div>
                            <p class="card-text text-light mb-0">Total mahasiswa</p>
                            <h3 class="text-light">${overview.jml_mhs}</h3>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
            </div>
            
            <div class="row">
                <div class="col-12">
                    <div class="card" style="background-color: #3367d5;">
                        <div class="card-body py-4">
                        <div class="d-md-flex align-items-center justify-content-between">
                            <div>
                                <h2 class="text-white font-weight-bold d-flex align-items-center">
                                    PROGRAM STUDI ${overview.jenjang.toUpperCase()} ${overview.nm_prodi.toUpperCase()}
                                </h2>
                                <p class="card-text text-light mb-5 mb-md-0"><em>${overview.nm_prodi_e.toUpperCase()}</em></p>
                            </div>
                            <div class="d-flex justify-content-start overflow-auto">
                                <div class="me-5">
                                    <p class="card-text text-light mb-0">Total Kelas</p>
                                    <h3 class="text-light">${overview.jml_kls}</h3>
                                </div>
                                <div class="me-5">
                                    <p class="card-text text-light mb-0">Total matakuliah</p>
                                    <h3 class="text-light">${overview.jml_mk}</h3>
                                </div>
                                <div>
                                    <p class="card-text text-light mb-0">Total mahasiswa</p>
                                    <h3 class="text-light">${overview.jml_mhs}</h3>
                                </div>
                            </div>
                        </div>
                            <hr>
                            <a class="btn btn-light" onclick="link_to('welcome')"><i class="align-middle fas fa-fw fa-arrow-left"></i> KEMBALI</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">`;

            // tampilkan daftar kelas yang ada pada prodi yang dipilih
            const result = json.field;
            result.forEach((data) => {
                html += `
                <div class="col-md-6 col-xxl-3 d-flex">
                <div class="card flex-fill">
                    <div class="card-header">
                        <div class="d-md-flex align-items-center justify-content-between">
                            <h3 class="mb-0">${data.nm_kls}</h3>
                            <p class="text-dark mb-0">${data.nm_smt}</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mb-0">
                            <p class="mb-2"><i class="align-middle me-2 far fa-fw fa-calendar-check"></i> Semester ${data.smt}</p>
                            <p class="mb-2"><i class="align-middle me-2 far fa-fw fa-clone"></i> ${data.jml_mk} mata kuliah</p>
                            <p class="mb-0"><i class="align-middle me-2 far fa-fw fa-user"></i> ${data.jml_mhs} mahasiswa</p>
                        </div>
                        <hr>
                        <a class="btn btn-primary" onclick="link_to('welcome/matkul/${data.id_kls}/${data.smt}')">Lihat Kelas <i class="align-middle ms-2 fas fa-fw fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>`;
            });
            html += `</div>`;
        } else {
            html += `<div class="col-12 mx-auto pt-5 text-center">
                <h1 class="text-center mb-5">${json.message}</h1>
                <a class="btn btn-primary" role="button" onclick="history.go(-1)"><i class="align-middle me-2 fas fa-fw fa-arrow-left"></i> Kembali</a>
            </div>`;
        }
        document.getElementById('load-kelas').innerHTML = html;
    } catch (error) {
        // proses login gagal
        console.log(error);
        notif(error, 'danger');
    }
}