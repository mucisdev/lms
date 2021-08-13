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
            const result = json.field;
            result.forEach((data) =>  {
                let file_type = (data.file) ? checkFileExtension(data.file) : '';
                if (data.link) {
                    html += `<li class="list-group-item list-group-item-action d-flex align-items-center"><div class="stat d-inline-block text-center me-3"><i class="align-middle fas fa-fw fa-link"></i></div>${data.judul.toUpperCase()}</li>`;
                } else {
                    html += `<a target="materi_" rel="noreferrer" href="${link_cdn}materi/${data.file}" class="list-group-item list-group-item-action fw-bold text-primary d-flex align-items-center"><div class="stat d-inline-block text-center me-3">${iconFileType(file_type)}</div>${data.judul.toUpperCase()}</a>`;
                }
            });
        }else{
            html += '<div class="col-12">Tidak ada materi</div>';
        }
        document.getElementById('load-materi').innerHTML = html;
    } catch (error) {
        // proses login gagal
        console.log(error);
        notif(error, 'danger');
    }
}

export{materi};