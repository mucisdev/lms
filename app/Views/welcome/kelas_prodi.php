<?= $this->extend('template/welcome'); ?>
<?= $this->section('content'); ?>

<div class="row mb-3 mb-xl-3">
    <div class="col-md-auto">
        <h3>Overview</h3>
    </div>

    <div class="col-md-auto col-sm-12 ms-auto text-md-end mt-n1">

        <div class="dropdown d-md-inline-block d-inline">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 my-2">
                    <li class="breadcrumb-item"><a role="button" class="text-decoration-none" onclick="link_to(`welcome`)">Home</a></li>
                    <li class="breadcrumb-item active"><?= $title ?></li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-12">
        <div class="card" style="background-image: url('<?= base_url('assets/img/bg-profil.jpg') ?>');background-size:cover;min-height:100px;">
            <div class="card-body py-4">
                <h2 class="text-white font-weight-bold d-flex align-items-center">
                    PROGRAM STUDI <?= strtoupper($overview['jenjang'] . ' ' . $overview['nm_prodi']); ?>
                </h2>
                <p class="card-text text-light mb-5"><em><?= strtoupper($overview['nm_prodi_e']); ?></em></p>
                <div class="d-flex justify-content-start overflow-auto">
                    <div class="me-5">
                        <p class="card-text text-light mb-0">Total Kelas</p>
                        <h4 class="text-light"><?= $overview['jml_kls'] ?></h4>
                    </div>
                    <div class="me-5">
                        <p class="card-text text-light mb-0">Total matakuliah</p>
                        <h4 class="text-light"><?= $overview['jml_mk'] ?></h4>
                    </div>
                    <div>
                        <p class="card-text text-light mb-0">Total mahasiswa</p>
                        <h4 class="text-light"><?= $overview['jml_mhs'] ?></h4>
                    </div>
                </div>
                <hr>
                <a class="btn btn-light" onclick="link_to(`welcome`)"><i class="align-middle fas fa-fw fa-arrow-left"></i> KEMBALI</a>
                <?= csrf_field('csrf_token') ?>
                <input type="hidden" name="kode_prodi" id="kode_prodi" value="<?= service('uri')->getSegment(3) ?>">
            </div>
        </div>
    </div>
</div>

<div class="row mb-3 mb-xl-3">
    <h3><?= $title ?></h3>
</div>

<div class="row" id="load-kelas">
</div>

<?= $this->endSection(); ?>