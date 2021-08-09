<?= $this->extend('template/welcome'); ?>
<?= $this->section('content'); ?>


<div class="row pt-5">
    <div class="col-lg-6 col-xl-5">
        <div class="mb-2 mb-xl-3">
            <div class="mb-4 rounded-3">
                <p class="col-md-8 fs-4"><?= APP_INSTITUSI ?></p>
                <h1 class="display-6 fw-bold"><?= strtoupper(APP_TITLE) ?></h1>
                <p class="col-md-8 fs-4">Using a series of utilities, you can create this jumbotron, just like the one in previous versions of Bootstrap.</p>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-xl-7 d-flex">
        <div class="w-100">

            <div class="row">

                <?php if ($prodi) :
                    foreach ($prodi as $p) : ?>
                        <div class="col-sm-6 col-xxl-6 d-flex">
                            <div class="card flex-fill">
                                <div class="card-body py-4">
                                    <div class="d-flex align-items-start">
                                        <div class="flex-grow-1">
                                            <h3 class="mb-2"><?= $p['jenjang'] . ' ' . $p['nm_prodi'] ?></h3>
                                            <div class="mb-0">
                                                <span class="text-muted"><em><?= $p['nm_prodi_e'] ?></em></span>
                                            </div>
                                        </div>
                                        <div class="d-inline-block ms-3">
                                            <form action="<?= site_url('matkul') ?>" method="POST">
                                                <input type="hidden" name="kode_prodi" value="<?= $p['kode_prodi'] ?>">
                                                <button class="btn m-0 p-0" type="submit">
                                                    <div class="stat text-center">
                                                        <!-- <i class="align-middle text-primary fas fa-fw fa-arrow-right"></i> -->
                                                        <i class="align-middle text-primary fas fa-fw fa-arrow-right"></i>
                                                    </div>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php endforeach;
                endif ?>
            </div>

        </div>
    </div>
</div>

<script>
    var flash_data = {
        pesan: '<?= session()->getFlashdata('error'); ?>'
    };
</script>

<?= $this->endSection(); ?>