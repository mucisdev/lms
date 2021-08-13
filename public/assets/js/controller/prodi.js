async function prodi() {
    const myData = { csrf_token_name: csrf_token };
    const options = {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(myData)
    };
    try {
        // tampilkan loader
        document.getElementById('load-prodi').innerHTML = loading_spinner;
        // kirim data (method POST)
        const response = await fetch(site_url+'welcome/get_prodi/', options);
        const json = await response.json();
        let html = '';
        if(json.status){
            const result = json.field;
            result.forEach((data) =>  {
                html += `<div class="col-sm-6 col-xl-4 col-xxl-3 d-flex">
                <div class="card flex-fill">
                    <img class="card-img-top" src="assets/img/bg-prodi.jpg" alt="Cover Matkul">
                    <div class="card-body py-4">
                        <div class="d-flex align-items-start">
                            <div class="flex-grow-1">
                                <h3 class="mb-2">${data.jenjang} ${data.nm_prodi}</h3>
                                <div class="mb-0">
                                    <span class="text-muted"><em>${data.nm_prodi_e}</em></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a class="btn btn-primary" onclick="link_to('welcome/kelas/${data.kode_prodi}')">Lihat Prodi <i class="align-middle ms-2 fas fa-fw fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>`;
            });
        }else{
            html += '<div class="col-12 text-center">Tidak ada program studi</div>';
        }
        document.getElementById('load-prodi').innerHTML = html;
    } catch (error) {
        // proses login gagal
        console.log(error);
        notif(error, 'danger');
    }
}

export{prodi};