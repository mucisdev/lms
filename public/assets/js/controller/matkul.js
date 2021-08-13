async function matkul() {
    const id_kls = document.getElementById('id_kls').value;
    const smt = document.getElementById('smt').value;
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
        const response = await fetch(site_url+'welcome/get_matkul/', options);
        const json = await response.json();
        let html = '';
        if(json.status){
            const result = json.field;
            result.forEach((data) =>  {
                html += `<li role="button" onclick="link_to('welcome/modul/${data.id_kls}/${data.id_mk}')" class="list-group-item list-group-item-action d-flex align-items-center">
                <div class="ms-md-2 me-auto">
                    <div class="fw-bold text-primary">${data.nm_mk.toUpperCase()}</div>
                </div>
            </li>`;
            });
        }else{
            html += '<div class="col-12">Tidak ada mata kuliah</div>';
        }
        document.getElementById('load-matkul').innerHTML = html;
    } catch (error) {
        // proses login gagal
        console.log(error);
        notif(error, 'danger');
    }
}
export{matkul};