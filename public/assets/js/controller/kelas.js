async function kelas() {
    const kode_prodi = document.getElementById('kode_prodi').value;
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
        const response = await fetch(site_url+'welcome/get_kelas/', options);
        const json = await response.json();
        let html = '';
        if(json.status){
            const result = json.field;
            result.forEach((data) =>  {
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
        }else{
            html += '<div class="col-12">Tidak ada kelas</div>';
        }
        document.getElementById('load-kelas').innerHTML = html;
    } catch (error) {
        // proses login gagal
        console.log(error);
        notif(error, 'danger');
    }
}

export{kelas};