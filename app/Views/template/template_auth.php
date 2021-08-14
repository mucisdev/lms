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

<body data-theme="default" class="bg-white" data-layout="fluid" data-sidebar-position="left" data-sidebar-behavior="sticky">

    <?=
    //konten
    $this->renderSection('content'); ?>

    <div class="fixed-bottom p-3 bg-danger text-white text-center" style="display: none;" id="offline">Tidak ada koneksi internet.</div>
    <div class="fixed-bottom p-3 bg-success text-white text-center" style="display: none;" id="online">Terhubung ke internet.</div>

    <script src="https://cdn.jsdelivr.net/gh/wahyuos/style@73a1c411859ef15d22588da44581af53aa5a94f4/js/app.js" defer></script>
    <script src="/assets/js/global.js?v=<?= UPDATED_AT ?>" defer></script>
    <script src="/assets/js/controller/auth.js?v=<?= UPDATED_AT ?>" defer></script>
</body>

</html>