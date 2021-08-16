async function matkul() {
    const myData = {id_kls:id_kls, smt:smt, csrf_token_name: csrf_token };
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
        const response = await fetch(site_url+'getdata/get_matkul/', options);
        const json = await response.json();
        let html = '';
        if(json.status){
            // tampilkan overview kelas berdasarkan kelas
            const overview = json.overview_kelas;
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
                                <li class="breadcrumb-item active">Mata Kuliah</li>
                            </ol>
                        </nav>
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
                            <hr>
                            <a class="btn btn-light" onclick="link_to('welcome/kelas/${overview.kode_prodi}')"><i class="align-middle fas fa-fw fa-arrow-left"></i> KEMBALI</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-12 col-lg-9">
                    <div class="card">
                        <div class="card-header px-4 pt-4">
                            <h5 class="card-title mb-0">Daftar Mata Kuliah</h5>
                        </div>
                        <div class="card-body">
                            <div class="list-group list-group-flush list-group-numbered">`;
            // tampilkan daftar matkul yang ada pada kelas yang dipilih
            const result = json.field;
            result.forEach((data) =>  {
                html += `<li role="button" onclick="link_to('welcome/modul/${data.id_kls}/${data.id_mk}')" class="list-group-item list-group-item-action d-flex align-items-center">
                        <div class="ms-md-2 me-auto">
                            <div class="fw-bold text-primary">${data.nm_mk.toUpperCase()}</div>
                        </div>
                    </li>`;
            });
                html += `</div>
                        </div>
                    </div>
                </div>`;

            // tampilkan data mahasiswa
            // tampilkan overview kelas berdasarkan kelas
            html+=`<div class="col-12 col-lg-3">
                        <div class="card">
                            <div class="card-header px-4 pt-4">
                                <h5 class="card-title mb-0">Daftar Mahasiswa</h5>
                            </div>
                            <div class="card-body px-0">
                                <div class="overflow-auto" style="max-height:500px;">
                                <div class="list-group list-group-flush">`;
                                const mhsw = json.mahasiswa;
                                mhsw.forEach((mhs) =>  {
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
        }else{
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
export{matkul};