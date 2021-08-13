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
        const response = await fetch(site_url+'welcome/get_materi/', options);
        const json = await response.json();
        let html = '';
        if(json.status){
            // tampilkan overview matkul berdasarkan matkul
            const overview = json.overview_matkul;
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
                                <li class="breadcrumb-item"><a role="button" class="text-decoration-none" onclick="history.go(-1)">Mata Kuliah</a></li>
                                <li class="breadcrumb-item active">Materi</li>
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
                <div class="col-12 ">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Daftar Materi</h5>
                            <h6 class="card-subtitle text-muted">Klik pada nama materi untuk mendownload.</h6>
                        </div>
                        <div class="card-body">
                            <ol class="list-group list-group-flush">`;
            const result = json.field;
            result.forEach((data) =>  {
                let file_type = (data.file) ? checkFileExtension(data.file) : '';
                if (data.link) {
                    html += `<li class="list-group-item list-group-item-action d-flex align-items-center"><div class="stat d-inline-block text-center me-3"><i class="align-middle fas fa-fw fa-link"></i></div>${data.judul.toUpperCase()}</li>`;
                } else {
                    html += `<a target="materi_" rel="noreferrer" href="${link_cdn}materi/${data.file}" class="list-group-item list-group-item-action fw-bold text-primary d-flex align-items-center"><div class="stat d-inline-block text-center me-3">${iconFileType(file_type)}</div>${data.judul.toUpperCase()}</a>`;
                }
            });
                    html+= `</ol>
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
        document.getElementById('load-materi').innerHTML = html;
    } catch (error) {
        // proses login gagal
        console.log(error);
        notif(error, 'danger');
    }
}

export{materi};