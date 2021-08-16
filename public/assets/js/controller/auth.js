formInput.addEventListener('submit', function (event) {
    btnSubmit.disabled = true;
    event.preventDefault();
    const value = new FormData(formInput);
    sendData(value);
});

// proses kirim data untuk login
async function sendData(value) {
    const options = {
        method: 'POST',
        body: value
    };
    try {
        btnSubmitClick(true, true, 'mengautentikasi...');
        disableForm(true);
        const response = await fetch(site_url + 'auth/login', options);
        const json = await response.json();
        console.log(json);
        if (json.status) {
            btnSubmit.disabled = true;
            // jika status true, alihkan ke home
            notif(json.message, json.type);
            // periksa level
            if (json.role == 'Mahasiswa') {
                location.href = site_url + 'pelajar';
            } else {
                location.href = site_url + 'pengajar';
            }
        } else {
            disableForm(false);
            // set csrf
            document.getElementById('csrf_token').value = json.csrf_token;
            // munculkan pesan gagal login
            notif(json.message, json.type);
            // aktifkan tombol submit
            btnSubmitClick(false, false, 'MASUK');
        }
    } catch (error) {
        // proses login gagal
        console.log(error);
        notif(error, 'danger');
        // aktifkan tombol submit
        btnSubmitClick(false, false, 'MASUK');
    }
}