<?= $this->extend('template/template_auth'); ?>
<?= $this->section('content'); ?>

<div class="row m-0 p-0">
    <div class="col-sm-8 col-md-6 col-lg-4 col-xl-3 mx-auto p-0 pt-md-4">
        <div class="m-0 m-md-4">
            <div class="text-center mb-4">
                <div class="text-center mb-4">
                    <img src="/assets/img/icon.png" alt="Logo" width="30%" height="auto" class="img-fluid rounded-circle">
                </div>
                <h1 class="h2">Halaman Login</h1>
                <p>
                    Silahkan login untuk masuk sistem
                </p>
            </div>
            <form autocomplete="off" class="formInput">
                <?= csrf_field('csrf_token'); ?>
                <div class="mb-3">
                    <input class="form-control required" type="username" name="username" id="username" placeholder="Username" autofocus required />
                </div>
                <div class="mb-3">
                    <input class="form-control required" type="password" name="password" id="my_password" placeholder="Password" required />
                    <input type="hidden" name="url_referrer" id="url_referrer" value="<?= @$_SERVER['HTTP_REFERER']; ?>" />
                </div>
                <div>
                    <div class="form-check align-items-center">
                        <input class="form-check-input" type="checkbox" value="" id="show-password" onclick="show_hide_pass()">
                        <label class="form-check-label" for="show-password">
                            Lihat password
                        </label>
                    </div>
                </div>
                <div class="text-center mt-4">
                    <div class="d-grid gap-2">
                        <button class="btn btn-lg btn-primary btn-block btnSubmit">MASUK</button>
                        <button class="btnReset d-none"></button>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-12 text-center">
            <p class="text-muted">VERSI <?= VERSION ?><br>&copy; <?= date('Y') ?> - <?= DEV ?></p>
        </div>
    </div>

</div>

<?= $this->endSection(); ?>