async function kelas() {
    const myData = {kode_prodi:kode_prodi, csrf_token_name: csrf_token };
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
        const response = await fetch(site_url+'getdata/get_kelas/', options);
        const json = await response.json();
        let html = '';
        if(json.status){
            // tampilkan overview prodi berdasarkan kode_prodi
            const overview = json.overview_prodi;
            // pengecekan kelas pada prodi
            if(overview){
                html += `<div class="row mb-3 mb-xl-3">
                    <div class="col-md-auto">
                        <h3>${title}</h3>
                    </div>
                
                    <div class="col-md-auto col-sm-12 ms-auto text-md-end mt-n1">
                
                        <div class="dropdown d-md-inline-block d-inline">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0 my-2">
                                    <li class="breadcrumb-item"><a role="button" class="text-decoration-none" onclick="link_to('welcome')">Home</a></li>
                                    <li class="breadcrumb-item active">Kelas</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-12">
                        <div class="card bg-primary-dark" >
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
                    const result_kelas = json.kelas;
                    if(result_kelas.length) {
                        result_kelas.forEach((data) =>  {
                            html += `<div class="col-md-6 col-xxl-3 d-flex">
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
                    } else {
                        html += `<h1 class="text-center my-5">Tidak ada kelas pada prodi ini.</h1>`;
                    }
                html += `</div>`;
            } else {
                html += `<div class="col-12 mx-auto pt-5 text-center">
                        <h1 class="text-center mb-5">Tidak ada kelas pada prodi ini.</h1>
                        <a class="btn btn-primary" role="button" onclick="link_to('welcome')"><i class="align-middle me-2 fas fa-fw fa-arrow-left"></i> Kembali</a>
                    </div>`;
            }
        }else{
            html += `<div class="col-12 mx-auto pt-5 text-center">
                <h1 class="text-center mb-5">${json.message}</h1>
                <a class="btn btn-primary" role="button" onclick="link_to('welcome')"><i class="align-middle me-2 fas fa-fw fa-arrow-left"></i> Kembali</a>
            </div>`;
        }
        document.getElementById('load-kelas').innerHTML = html;
    } catch (error) {
        // proses login gagal
        console.log(error);
        notif(error, 'danger');
    }
}

export{kelas};