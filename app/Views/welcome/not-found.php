<?= $this->extend('template/welcome'); ?>
<?= $this->section('content'); ?>

<div class="row">
    <div class="col-12 mx-auto pt-5 text-center">
        <h1 class="text-center mb-5"><?= $message; ?></h1>
        <a class="btn btn-primary" role="button" onclick="history.go(-1)"><i class="align-middle me-2 fas fa-fw fa-arrow-left"></i> Kembali</a>
    </div>
</div>

<?= $this->endSection(); ?>