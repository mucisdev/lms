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
        const response = await fetch(site_url+'getdata/get_prodi/', options);
        const json = await response.json();
        let html = '';
        if(json.status){
            const result = json.prodi;
            if(result.length){
                result.forEach((data) =>  {
                    html += `<div class="col-sm-6 col-xl-4 col-xxl-3 d-flex">
                    <div class="card flex-fill bg-primary-dark" role="button" onclick="link_to('welcome/kelas/${data.kode_prodi}')" style="background-image: url('${site_url}assets/img/bg-prodi.jpg');background-size:cover;min-height:100px;">
                        <div class="card-body py-4">
                            <div class="d-flex align-items-start">
                                <div class="flex-grow-1">
                                    <h3 class="mb-2 text-white">${data.jenjang} ${data.nm_prodi}</h3>
                                    <div class="mb-0">
                                        <span class="text-light"><em>${data.nm_prodi_e}</em></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>`;
                });
            } else {
                html += `<div class="col-12 mx-auto pt-5 text-center">
                <h1 class="text-center mb-5">Tidak ada Program Studi!</h1>
            </div>`;
            }
        }else{
            html += `<div class="col-12 mx-auto pt-5 text-center">
                <h1 class="text-center mb-5">${json.message}</h1>
            </div>`;
        }
        document.getElementById('load-prodi').innerHTML = html;
    } catch (error) {
        // proses login gagal
        console.log(error);
        notif(error, 'danger');
    }
}

export{prodi};