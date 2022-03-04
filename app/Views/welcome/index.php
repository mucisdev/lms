<?= $this->extend('welcome/template'); ?>
<?= $this->section('content'); ?>


<div class="row p-md-5 py-sm-5">
    <div class="col-12 mb-3">
        <div class="mb-0 rounded-3 text-center">
            <p class="fs-4"><?= APP_INSTITUSI ?></p>
            <h1 class="fw-bold display-6"><?= strtoupper(APP_TITLE) ?></h1>
            <!-- <p class="fs-4">Using a series of utilities, you can create this jumbotron, just like the one in previous versions of Bootstrap.</p> -->
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 mb-5">
        <div class="w-100">

            <div class="row d-flex justify-content-center" id="load-prodi">

            </div>

        </div>
    </div>
</div>

<div class="row mb-2 mb-xl-3">
    <div class="col-12 text-center">
        <h3>Materi Terkini</h3>
    </div>
</div>

<script>
    let csrf_token = '<?= csrf_hash() ?>';
</script>

<?= $this->endSection(); ?>