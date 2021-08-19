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
        let site_url = '<?= site_url() ?>';
        let title = '<?= $title ?>';
    </script>
</head>

<body data-theme="light" data-layout="fluid" data-sidebar-position="left" data-sidebar-behavior="sticky">

    <div class="wrapper">

        <div class="main">

            <nav class="navbar navbar-expand navbar-light sticky-top bg-white py-3 shadow">
                <div class="d-none d-md-inline-block ml-3">
                    <div class="input-group input-group-navbar">
                        <a onclick="link_to(`pelajar`)" class="h3 m-0 text-decoration-none"><?= APP_TITLE ?></a>
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
                                <span class="me-2 fw-bold text-dark"><?= ucwords(strtolower(session()->get('nama_user'))) ?></span>
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
    <script src="https://cdn.jsdelivr.net/gh/wahyuos/style@73a1c411859ef15d22588da44581af53aa5a94f4/js/sweetalert2.min.js" defer></script>
    <script src="/assets/js/global.js?v=<?= UPDATED_AT ?>" defer></script>

    <?php
    // load js by class name
    $file = './assets/js/controller/pelajar/' . controller_name() . '.js';
    if (file_exists($file)) {
        echo '<script src="/assets/js/controller/pelajar/' . controller_name() . '.js?v=' . UPDATED_AT . '" defer></script>';
    };
    ?>

</body>

</html>