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

            <div class="row d-flex justify-content-center">

                <?php if ($prodi) :
                    foreach ($prodi as $p) : ?>
                        <div class="col-sm-6 col-xl-4 col-xxl-3 d-flex">
                            <div class="card flex-fill">
                                <div class="card-body py-4">
                                    <div class="d-flex align-items-start mb-5">
                                        <div class="flex-grow-1">
                                            <h3 class="mb-2"><?= $p['jenjang'] . ' ' . $p['nm_prodi'] ?></h3>
                                            <div class="mb-0">
                                                <span class="text-muted"><em><?= $p['nm_prodi_e'] ?></em></span>
                                            </div>
                                        </div>
                                    </div>
                                    <a class="btn btn-primary" onclick="link_to(`<?= 'welcome/kelas/' . $p['kode_prodi'] ?>`)">Lihat Prodi <i class="align-middle ms-2 fas fa-fw fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                <?php endforeach;
                endif ?>
            </div>

        </div>
    </div>
</div>

<?= $this->endSection(); ?>