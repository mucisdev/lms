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
            // pengecekan mata kuliah
            if (overview) {
                html += `<div class="row mb-3 mb-xl-3">
                    <div class="col-md-auto">
                        <h3>${title}</h3>
                    </div>
                
                    <div class="col-md-auto col-sm-12 ms-auto text-md-end mt-n1">
                        <div class="dropdown d-md-inline-block d-inline">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0 my-2">
                                    <li class="breadcrumb-item"><a role="button" class="text-decoration-none" onclick="link_to('welcome')">Home</a></li>
                                    <li class="breadcrumb-item"><a role="button" class="text-decoration-none" onclick="link_to('welcome/kelas/${overview.kode_prodi}')">Kelas</a></li>
                                    <li class="breadcrumb-item"><a role="button" class="text-decoration-none" onclick="link_to('welcome/matkul/${id_kls}/${smt}')">Mata Kuliah</a></li>
                                    <li class="breadcrumb-item active">Materi</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col">
                        <div class="card bg-primary-dark">
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
                                <a class="btn btn-light me-2" onclick="link_to('welcome/matkul/${id_kls}/${smt}')"><i class="align-middle fas fa-fw fa-arrow-left"></i> KEMBALI</a>`;
                // cek login
                // jika login, tampilkan tugas
                if (is_login) {
                    html += `<a class="btn btn-primary me-2" onclick="showForum()"><i class="align-middle fas fa-fw fa-comments"></i> FORUM</a>`;
                }
                html += `</div>
                        </div>
                        
                        <div class="row">
                            <div class="col">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">Daftar Materi</h5>
                                        <h6 class="card-subtitle text-muted">Klik pada nama materi untuk mendownload.</h6>
                                    </div>
                                    <div class="card-body">
                                        <ol class="list-group list-group-flush">`;
                const result_materi = json.materi;
                if (result_materi.length) {
                    result_materi.forEach((data) => {
                        let file_type = (data.file) ? checkFileExtension(data.file) : '';
                        if (data.link) {
                            html += `<li class="list-group-item d-flex justify-content-between align-items-start">
                                                        <div class="stat d-inline-block text-center me-3" style="min-width:48px"><i class="align-middle fas fa-fw fa-link"></i></div>
                                                        <div class="me-auto">
                                                            <div class="fw-bold">${data.judul.toUpperCase()}</div>
                                                            <small class="text-muted">${format_tanggal(data.create_at)} oleh ${data.nm_dosen.toUpperCase()}</small>
                                                        </div>
                                                    </li>`;
                        } else {
                            html += `<li class="list-group-item d-flex justify-content-between align-items-start px-0">
                                                        <div class="stat d-inline-block text-center me-3" style="min-width:48px">${iconFileType(file_type)}</div>
                                                        <div class="me-auto">
                                                            <div class="fw-bold">`;
                            if (data.file) {
                                // jika login, beri akses download
                                if (is_login) {
                                    html += `<a target="materi_" rel="noreferrer" href="${link_cdn}materi/${data.file}">${data.judul.toUpperCase()}</a>`;
                                } else {
                                    html += `<span>${data.judul.toUpperCase()}</span>`;
                                }
                            } else {
                                html += `${data.judul.toUpperCase()}`;
                            }
                            html += `</div>
                                                            <small class="text-muted">${format_tanggal(data.create_at)} oleh ${data.nm_dosen.toUpperCase()}</small>
                                                        </div>
                                                    </li>`;
                        }
                    });
                } else {
                    html += `<li class="list-group-item d-flex align-items-center px-0">Tidak ada materi</li>`;
                }
                html += `</ol>
                                    </div>
                                </div>
                            </div>`;
                // cek login
                // jika login, tampilkan tugas
                if (is_login) {
                    html += `<div class="col col-xl-6 col-lg-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="card-title">Daftar Tugas</h5>
                                            <h6 class="card-subtitle text-muted">Klik pada judul tugas untuk mendownload</h6>
                                        </div>
                                        <div class="card-body">
                                            <ol class="list-group list-group-flush">`;
                    const result_tugas = json.tugas;
                    if (result_tugas.length) {
                        result_tugas.forEach((data) => {
                            let file_type = (data.file) ? checkFileExtension(data.file) : '';
                            if (data.link) {
                                html += `<li class="list-group-item px-0">
                                                            <div class="me-auto">
                                                                <div class="fw-bold"><i class="align-middle fas fa-fw fa-link"></i> ${data.judul.toUpperCase()}</div>
                                                                <small class="text-muted">${format_tanggal(data.create_at)} oleh ${data.nm_dosen.toUpperCase()}</small>
                                                                <div class="mt-2">${removeTags(data.deskripsi)}</div>
                                                            </div>
                                                        </li>`;
                            } else {
                                html += `<li class="list-group-item px-0">
                                                            <div class="me-auto">
                                                                <div class="fw-bold">${iconFileType(file_type)} `;
                                if (data.file) {
                                    html += `<a target="materi_" rel="noreferrer" href="${link_cdn}tugas/${data.file}">${data.judul.toUpperCase()}</a>`;
                                } else {
                                    html += `${data.judul.toUpperCase()}`;
                                }
                                html += `</div>
                                                                <small class="text-muted">${format_tanggal(data.create_at)} oleh ${data.nm_dosen.toUpperCase()}</small>
                                                                <div class="mt-2">${data.deskripsi}</div>
                                                            </div>
                                                        </li>`;
                            }
                        });
                    } else {
                        html += `<li class="list-group-item d-flex align-items-center px-0">Tidak ada tugas</li>`;
                    }
                    html += `</ol>
                                        </div>
                                    </div>
                                </div>`;
                }
                html += `</div>
                    </div>
                    <div class="col col-lg-3 col-sm-12" style="display:none" id="forum">
                        <div class="card">
                            <div class="card-header px-4 pt-4">
                                <h5 class="card-title mb-0">Forum Diskusi</h5>
                            </div>
                            <div class="card-body">
                                <div class="overflow-auto" style="max-height:600px;">
                                    <div id="load-diskusi"></div>
                                </div>
                                <div class="text-center" id="btnLoad"></div>
                            </div>
                        </div>
                    </div>
                </div>`;
            } else {
                html += `<div class="col-12 mx-auto pt-5 text-center">
                <h1 class="text-center mb-5">Tidak ada materi ataupun tugas.</h1>
                <a class="btn btn-primary" role="button" onclick="history.go(-1)"><i class="align-middle me-2 fas fa-fw fa-arrow-left"></i> Kembali</a>
            </div>`;
            }
        } else {
            html += `<div class="col-12 mx-auto pt-5 text-center">
                <h1 class="text-center mb-5">${json.message}</h1>
                <a class="btn btn-primary" role="button" onclick="link_to('welcome')"><i class="align-middle me-2 fas fa-fw fa-arrow-left"></i> Kembali</a>
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
                result.forEach((data, no) => {
                    no++;
                    $('#btnLoad').show();
                    let regex = /(?![^<]*>|[^<>]*<\/)((https?:)\/\/[a-z0-9&#=.\/\-?_]+)/gi;
                    let str = data.informasi;
                    let val = regex.exec(str);
                    let subst = '<a href="$1">$1</a>';
                    let informasi = str.replace(regex, subst);
                    html += '<div class="forum-header d-flex justify-content-between">';
                    html += '<p class="name font-weight-bold mb-0">' + data.nm_dosen + '</p>';
                    html += '<small class="time text-muted"> ' + data.time_stamp + '</small></div>';
                    html += '<div class="forum-content">';
                    html += '<div class="text-truncate" id="longText_' + no + '">';
                    html += '<p>' + informasi;
                    if (data.file) {
                        html += '<br><a href="' + link_cdn + 'files/' + data.file + '" target="_blank" rel="noreferrer">' + data.file + '  </a>';
                    }
                    html += '</p>';
                    get_komentar(data.id_informasi, json.csrf_token);
                    html += '<div class="listKomen_' + no + '" style="display:none" id="kom_' + data.id_informasi + '" ></div>';
                    html += '</div>';
                    html += '<a class="small text-primary" role="button" id="btnMore_' + no + '" onclick="toggleText(`' + no + '`)">Show More</a>';
                    html += '</div><hr>';
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

async function get_komentar(id_informasi, csrf) {
    const myData = { id_informasi: id_informasi, id_classwork: null, csrf_token_name: csrf };
    const options = {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(myData)
    };
    try {
        // kirim data (method POST)
        const response = await fetch(site_url + 'GetData/get_komentar/', options);
        const json = await response.json();
        let komentar = '';
        if (json.status) {
            const result = json.field;
            if (result.length) {
                result.forEach((data) => {
                    let regex = /(?![^<]*>|[^<>]*<\/)((https?:)\/\/[a-z0-9&#=.\/\-?_]+)/gi;
                    let str = data.komentar;
                    let val = regex.exec(str);
                    let subst = '<a href="$1">$1</a>';
                    let deskripsi = str.replace(regex, subst);
                    komentar += '<hr class="my-1"><div class="rounded-lg ml-4 mb-2 ps-4 py-0">';
                    komentar += '<div class="forum-header">';
                    komentar += '<span class="name fw-bold">' + data.nm_akun + '</span>';
                    komentar += '<small class="time text-muted float-end"> ' + data.time_stamp + '</small></div>';
                    komentar += '<div class="forum-content">';
                    komentar += '<p class="mb-0">' + deskripsi + '</p></div></div>';
                });
                $("#kom_" + id_informasi).html(komentar);
            } else {
                komentar = '<div class="text-center">Tidak ada komentar</div>';
            }
        } else {
            komentar = '<div class="text-center">' + json.message + '</div>';
        }
    } catch (error) {
        console.log(error);
        notif(error, 'danger');
    }
}



export { materi, informasi };