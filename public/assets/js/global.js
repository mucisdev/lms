// show loading saat load
window.addEventListener("beforeunload", function (e) {
    document.getElementById('loading').style.display = "block";
    document.getElementById('isi_konten').style.display = "none";
}, false);

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

// link href
function link_to(url){
    location.href = site_url+url;
}

// select2
$(".select2").each(function () {
    $(this)
        .wrap("<div class=\"position-relative\"></div>")
        .select2({
            // placeholder: "Pilih...",
            dropdownParent: $(this).parent()
        });
    // atur agar ukuran width menyesuaikan
    document.querySelector('.select2-container').style.width = 'auto';
})

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

var formInput = document.querySelector('.formInput');
if (formInput) {
    var btnSubmit = document.querySelector('.btnSubmit');
    var btnReset = document.querySelector('.btnReset');
    var divKonten = document.querySelector('.divKonten');

    // disable submit saat input masih kosong
    function submitDisabled() {
        let inputs = [...formInput.querySelectorAll('.required')];
        let isIncomplete = inputs.some(input => !input.value);
        btnSubmit.disabled = isIncomplete;
        btnReset.disabled = isIncomplete;
        btnSubmit.style.cursor = isIncomplete ? 'not-allowed' : 'pointer';
        btnReset.style.cursor = isIncomplete ? 'not-allowed' : 'pointer';
        btnSubmit.classList.remove("progress-bar-striped");
        btnSubmit.classList.remove("progress-bar-animated");

    }
    formInput.addEventListener('input', submitDisabled);
    submitDisabled();

    // menampilkan loader saat memuat data pada form
    function formLoader(show = false) {
        if (show) {
            // sembunyikan form
            formInput.style.opacity = 0;
            // tampilkan loader
            document.getElementById('form_loader').innerHTML = '<div id="loader"><div class="d-flex flex-column justify-content-center align-items-center"><div class="spinner-border text-primary my-3" role="status"><span class="sr-only">Loading...</span></div><p id="ket_loading">Sedang memuat data...</p></div></div>';
        } else {
            // tampilkan form
            formInput.style.opacity = 1;
            // sembunyikan loader
            document.getElementById('form_loader').innerHTML = '';
        }
    }

    // menampilkan loader saat memuat data konten
    function kontenLoader(show = false) {
        if (show) {
            // sembunyikan konten
            divKonten.style.opacity = 0;
            // tampilkan loader
            document.getElementById('konten_loader').innerHTML = '<div id="loader"><div class="d-flex flex-column justify-content-center align-items-center"><div class="spinner-border text-primary my-3" role="status"><span class="sr-only">Loading...</span></div><p id="ket_loading">Sedang memuat data...</p></div></div>';
        } else {
            // tampilkan konten
            divKonten.style.opacity = 1;
            // sembunyikan loader
            document.getElementById('konten_loader').innerHTML = '';
        }
    }

    // merubah status tombol submit ketika di klik
    function btnSubmitClick(status = false, addClass = false, text = 'SIMPAN') {
        btnSubmit.disabled = status;
        btnSubmit.textContent = text;
        // jika true, maka tambahkan class pada tombol submit
        if (addClass) {
            btnSubmit.classList.add("progress-bar-striped");
            btnSubmit.classList.add("progress-bar-animated");
        } else {
            btnSubmit.classList.remove("progress-bar-striped");
            btnSubmit.classList.remove("progress-bar-animated");
        }
    }
}

// readOnly textfield form
function disableForm(status = false) {
    let inputs = document.getElementsByTagName("input");
    for (let i = 0; i < inputs.length; i++) {
        inputs[i].disabled = status;
    }
    let selects = document.getElementsByTagName("select");
    for (let i = 0; i < selects.length; i++) {
        selects[i].disabled = status;
    }
    let textareas = document.getElementsByTagName("textarea");
    for (let i = 0; i < textareas.length; i++) {
        textareas[i].disabled = status;
    }
    let buttons = document.getElementsByTagName("button");
    for (let i = 0; i < buttons.length; i++) {
        buttons[i].disabled = status;
    }
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

// load texeditor
function loadTextEditor() {
    tinymce.init({
        selector: 'textarea.editor',
        setup: function (editor) {
            editor.on('change', function () {
                tinymce.triggerSave();
            });
        },
        plugins: [
            "filemanager lists codesample code responsivefilemanager"
        ],
        toolbar: "responsivefilemanager | undo redo | bold italic underline | removeformat | numlist bullist | alignleft aligncenter alignright alignjustify | outdent indent |  codesample code",
        mobile: {
            theme: 'mobile'
        },
        height: 150,
        // inline: true,
        menubar: false,
        elementpath: false,
        resize: true,
        branding: false,
        relative_urls: false,
        remove_script_host: false,
        image_advtab: true,
        external_filemanager_path: site_url + 'assets/plugins/filemanager/',
        filemanagaer_title: 'File Manager',
        external_plugins: { 'filemanager': site_url + 'assets/plugins/tinymce/plugins/responsivefilemanager/plugin.min.js' },
        content_css: [
            '//fonts.googleapis.com/css?family=Roboto:300,300i,400,400i'
        ],
    });

    tinymce.init({
        selector: 'input.editor',
        setup: function (editor) {
            editor.on('change', function () {
                tinymce.triggerSave();
            });
        },
        plugins: [
            "filemanager codesample code responsivefilemanager"
        ],
        toolbar: "responsivefilemanager | undo redo | bold italic underline | removeformat | codesample code",
        mobile: {
            theme: 'mobile'
        },
        height: 120,
        // inline: true,
        menubar: false,
        elementpath: false,
        resize: true,
        branding: false,
        relative_urls: false,
        remove_script_host: false,
        image_advtab: true,
        external_filemanager_path: site_url + 'assets/plugins/filemanager/',
        filemanagaer_title: 'File Manager',
        external_plugins: { 'filemanager': site_url + 'assets/plugins/tinymce/plugins/responsivefilemanager/plugin.min.js' },
        content_css: [
            '//fonts.googleapis.com/css?family=Roboto:300,300i,400,400i'
        ],
    });
}
// loadTextEditor();