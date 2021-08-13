// show loading saat load
// window.addEventListener("beforeunload", function (e) {
    // document.getElementById('loading').style.display = "block";
    // document.getElementById('isi_konten').style.display = "none";
    // document.getElementById('load-prodi').innerHTML = loading_spinner;
// }, false);

// offline
window.addEventListener("offline", () => {
    document.getElementById('offline').style.display = "block";
});

// online
window.addEventListener("online", () => {
    document.getElementById('offline').style.display = "none";
    document.getElementById('online').style.display = "block";
    setTimeout(function () {
        document.getElementById('online').style.display = "none";
    }, 1500);
});

// loading spinner
let loading_spinner = `<div class="col-12 text-center">
        <div class="d-flex justify-content-center mt-5 mb-3">
            <div class="spinner-border text-primary mt-5" style="width: 3rem;height:3rem;" role="status"><span class="sr-only">Loading...</span></div>
        </div>
        Mohon tunggu . . .
        </div>`;

// link href
function link_to(url){
    location.href = site_url+url;
}

// cek extensi file
function checkFileExtension(file_name) {
    return file_name.split('.').pop();
};

// ikon file ekstensi
function iconFileType(ekstensi)
{
    let ekstension = ekstensi.toLowerCase();
    if (ekstension == 'docx' || ekstension == 'doc') {
        return '<i class="align-middle fas fa-fw fa-file-word text-primary"></i>';
    }
    else if (ekstension == 'xls' || ekstension == 'xlsx' || ekstension == 'csv') {
        return '<i class="align-middle fas fa-fw fa-file-excel text-success"></i>';
    }
    else if (ekstension == 'pdf') {
        return '<i class="align-middle fas fa-fw fa-file-pdf text-danger"></i>';
    }
    else if (ekstension == 'ppt' || ekstension == 'pptx') {
        return '<i class="align-middle fas fa-fw fa-file-powerpoint text-warning"></i>';
    }
    else if (ekstension == 'jpg' || ekstension == 'jpeg' || ekstension == 'png') {
        return '<i class="align-middle fas fa-fw fa-file-image text-primary"></i>';
    }
    else {
        return '<i class="align-middle fas fa-fw fa-file"></i>';
    }
}
    
// menampilkan password
function show_hide_pass() {
    const field = document.getElementById("my_password");
    if (field.type === "password") {
        field.type = "text";
    } else {
        field.type = "password";
    }
}

// format ke tanggal indo
function tanggal_indo(tanggal_sql) {
    // explode dengan -
    let explode = tanggal_sql.split("-");
    // balikkan array dari akhir ke awal
    let data_array = explode.reverse();
    // joinkan array dengan -
    let tanggal_indo = data_array.join('-');
    // kembalikan nilai ke bentuk dd-mm-yyyy
    return tanggal_indo;
}

// notif
function notif(pesan, tipe, timer = 5000) {
    const message = pesan;
    const type = tipe;
    const duration = timer;
    const ripple = true;
    const dismissible = true;
    const positionX = 'center';
    const positionY = 'top';
    window.notyf.open({
        type,
        message,
        duration,
        ripple,
        dismissible,
        position: {
            x: positionX,
            y: positionY
        }
    });
}
