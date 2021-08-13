<!DOCTYPE html>
<html lang="en" translate="no">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="initial-scale=1, width=device-width, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="<?= DEV ?>">
    <meta name="google" value="notranslate">
    <meta name="theme-color" content="#3699ff">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="application-name" content="Aplikasi">
    <meta name="apple-mobile-web-app-title" content="Aplikasi">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="msapplication-navbutton-color" content="#3699ff">
    <meta name="msapplication-starturl" content="<?= site_url() ?>">

    <title><?= $title ?></title>

    <link rel="canonical" href="<?= current_url() ?>" />
    <link rel="shortcut icon" href="/assets/img/icon.png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,600,700" rel="stylesheet">

    <link rel="preconnect" href="https://cdn.jsdelivr.net">
    <link rel="preload" href="https://cdn.jsdelivr.net/gh/wahyuos/style@73a1c411859ef15d22588da44581af53aa5a94f4/css/light.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/wahyuos/style@73a1c411859ef15d22588da44581af53aa5a94f4/css/light.css">
    </noscript>

    <script>
        var site_url = '<?= site_url() ?>';
    </script>
</head>

<body data-theme="light" data-layout="fluid" data-sidebar-position="left" data-sidebar-behavior="sticky">

    <div class="wrapper">

        <div class="main">

            <nav class="navbar navbar-expand navbar-light sticky-top bg-white py-3 shadow">

                <div class="d-none d-md-inline-block ml-3">
                    <div class="input-group input-group-navbar">
                        <a onclick="link_to(`welcome`)" class="h3 m-0 text-decoration-none"><?= APP_TITLE ?></a>
                    </div>
                </div>

                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav navbar-align">
                        <li class="nav-item dropdown">
                            <a class="nav-link d-inline-block px-5 py-1 text-white btn btn-primary" href="<?= site_url('auth') ?>">Masuk</a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="content pt-4">
                <div class="container-fluid p-0">
                    <!-- Halaman loading -->
                    <div class="row" id="loading" style="display: none;">
                        <div class="d-flex flex-column justify-content-center align-items-center">
                            <div class="spinner-border text-primary my-3" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                            <p id="ket_loading">Memuat halaman...</p>
                        </div>
                    </div>

                    <div id="isi_konten">
                        <?=
                        //konten
                        $this->renderSection('content'); ?>
                    </div>

                </div>
            </main>

            <footer class="footer border-0">
                <div class="container-fluid">
                    <div class="row text-muted">
                        <div class="col-12 text-center">
                            <p class="mb-0">
                                &copy; 2021 by <?= DEV ?>
                            </p>
                        </div>
                    </div>
                </div>
            </footer>
            <div class="fixed-bottom p-3 bg-danger text-white text-center" style="display: none;" id="offline">Tidak ada koneksi internet.</div>
            <div class="fixed-bottom p-3 bg-success text-white text-center" style="display: none;" id="online">Terhubung ke internet.</div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/gh/wahyuos/style@73a1c411859ef15d22588da44581af53aa5a94f4/js/app.js" defer></script>
    <script src="/assets/js/global.js?v=<?= UPDATED_AT ?>" defer></script>
    <script src="/assets/js/controller/welcome.js?v=<?= UPDATED_AT ?>" type="module" defer></script>
</body>

</html>