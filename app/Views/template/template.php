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
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/wahyuos/style@73a1c411859ef15d22588da44581af53aa5a94f4/css/light.css">
        <link href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css" rel="stylesheet">
    </noscript>

    <script>
        var site_url = '<?= site_url() ?>';
    </script>
</head>

<body data-theme="light" data-layout="fluid" data-sidebar-position="left" data-sidebar-behavior="sticky">

    <div class="wrapper">

        <?=
        // navbar
        $this->include('template/navbar'); ?>

        <div class="main">

            <nav class="navbar navbar-expand navbar-light">
                <a class="sidebar-toggle">
                    <i class="hamburger align-self-center"></i>
                </a>

                <div class="d-none d-sm-inline-block ml-3">
                    <div class="input-group input-group-navbar">
                        <label class="h4 m-0"><?= $title ?></label>
                    </div>
                </div>

                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav navbar-align">
                        <li class="nav-item dropdown">
                            <span class="nav-icon d-inline-block d-sm-none">
                                <i class="align-middle" data-feather="user"></i>
                            </span>

                            <a class="nav-icon d-inline-block d-sm-none" href="<?= site_url('auth/logout') ?>">
                                <i class="align-middle" data-feather="power"></i>
                            </a>

                            <span class="nav-link d-none d-sm-inline-block">
                                <span class="me-2 text-dark"><strong>Hai, </strong><?= session()->get('nama_user') ?></span>
                            </span>

                            <span class="nav-link d-none d-sm-inline-block">
                                <span class="me-2 text-dark">|</span>
                            </span>

                            <a class="nav-link d-none d-sm-inline-block text-danger" href="<?= site_url('auth/logout') ?>">Logout</a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="content">
                <div class="container-fluid p-0">
                    <!-- Halaman loading -->
                    <div class="row" id="loading" style="display: none;">
                        <div class="d-flex flex-column min-vh-50 justify-content-center align-items-center">
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
                        <div class="col-12 text-start">
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
    <input type="hidden" id="progress_width" value="0">

    <script src="https://cdn.jsdelivr.net/gh/wahyuos/style@73a1c411859ef15d22588da44581af53aa5a94f4/js/app.js" defer></script>
    <script src="https://cdn.jsdelivr.net/gh/wahyuos/style@73a1c411859ef15d22588da44581af53aa5a94f4/js/sweetalert2.min.js" defer></script>
    <script src="/assets/plugins/tinymce/tinymce.min.js" defer></script>
    <script src="/assets/js/global.js?v=<?= UPDATED_AT ?>" defer></script>

    <?php
    // load js by class name
    $file = './assets/js/controller/' . controller_name() . '.js';
    if (file_exists($file)) {
        echo '<script src="/assets/js/controller/' . controller_name() . '.js?v=' . UPDATED_AT . '" defer></script>';
    };
    ?>

</body>

</html>