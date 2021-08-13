<?= $this->extend('template/welcome'); ?>
<?= $this->section('content'); ?>


<div class="row p-md-5 py-sm-5">
    <div class="col-12 mb-5">
        <div class="mb-0 rounded-3 text-center">
            <p class="fs-4"><?= APP_INSTITUSI ?></p>
            <h1 class="fw-bold display-6"><?= strtoupper(APP_TITLE) ?></h1>
            <p class="fs-4">Using a series of utilities, you can create this jumbotron, just like the one in previous versions of Bootstrap.</p>
        </div>
    </div>
    <div class="col-12">
        <div class="w-100">

            <div class="row d-flex justify-content-center" id="load-prodi">

            </div>

        </div>
    </div>
</div>

<?= csrf_field('csrf_token') ?>

<?= $this->endSection(); ?>