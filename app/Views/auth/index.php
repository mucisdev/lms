<?= $this->extend('template/template_auth'); ?>
<?= $this->section('content'); ?>

<div class="row m-0 p-0">
    <div class="col-sm-8 col-md-6 col-lg-4 mx-auto p-0 pt-md-4">
        <div class="card shadow-none">
            <div class="card-body">
                <div class="m-0 m-md-4">
                    <div class="text-center mb-4">
                        <div class="text-center mb-3">
                            <img src="/assets/img/icon.png" alt="Logo" width="100" height="auto" class="rounded">
                        </div>
                        <h1 class="h2">Halaman Login</h1>
                        <p class="lead">
                            Silahkan login untuk masuk sistem
                        </p>
                    </div>
                    <hr>
                    <form autocomplete="off" class="formInput">
                        <?= csrf_field('csrf_token'); ?>
                        <div class="mb-3">
                            <label class="form-label" for="username">Username</label>
                            <input class="form-control form-control-lg required" type="username" name="username" id="username" placeholder="Enter your username" autofocus required />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="my_password">Password</label>
                            <input class="form-control form-control-lg required" type="password" name="password" id="my_password" placeholder="Enter your password" required />
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
            </div>
        </div>

        <div class="col-12 text-center">
            <p class="text-muted">VERSI <?= UPDATED_AT ?><br>&copy; 2021 - <?= DEV ?></p>
        </div>
    </div>

</div>

<?= $this->endSection(); ?>