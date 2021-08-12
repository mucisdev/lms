window.addEventListener("load", materi());
window.addEventListener("load", tugas());
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
        let loading = '<div class="spinner-border text-primary mr-2" role="status"><span class="sr-only">Loading...</span></div>';
        document.getElementById('load-materi').innerHTML = loading;
        // kirim data (method POST)
        const response = await fetch(site_url+'welcome/get_materi/', options);
        const json = await response.json();
        let html = '';
        if(json.status){
            const result = json.field;
            result.forEach((data, i) =>  {
                i++;
                if (data.link) {
                    html += '<li class="list-group-item list-group-item-action d-flex align-items-center"><div class="stat d-inline-block text-center me-3"><i class="align-middle fas fa-fw fa-link"></i></div> ' + data.judul + '</li>';
                } else {
                    html += '<li class="list-group-item list-group-item-action d-flex align-items-center"><div class="stat d-inline-block text-center me-3"><i class="align-middle far fa-fw fa-lightbulb"></i></div>' + data.judul + '</li>';
                }
            });
        }else{
            html += 'Tidak ada materi';
        }
        document.getElementById('load-materi').innerHTML = html;
    } catch (error) {
        // proses login gagal
        console.log(error);
        notif(error, 'danger');
    }
}

async function tugas() {
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
        let loading = '<div class="spinner-border text-primary mr-2" role="status"><span class="sr-only">Loading...</span></div>';
        document.getElementById('load-tugas').innerHTML = loading;
        // kirim data (method POST)
        const response = await fetch(site_url+'welcome/get_tugas/', options);
        const json = await response.json();
        let html = '';
        if(json.status){
            const result = json.field;
            result.forEach((data, i) =>  {
                i++;
                html += '<li class="list-group-item list-group-item-action d-flex align-items-center"><div class="stat d-inline-block text-center me-3"><i class="align-middle far fa-fw fa-lightbulb"></i></div>' + data.judul + '</li>';
            });
        }else{
            html += 'Tidak ada tugas';
        }
        document.getElementById('load-tugas').innerHTML = html;
    } catch (error) {
        // proses login gagal
        console.log(error);
        notif(error, 'danger');
    }
}