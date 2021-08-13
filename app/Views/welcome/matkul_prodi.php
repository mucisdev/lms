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
                    <li class="breadcrumb-item"><a role="button" class="text-decoration-none" onclick="link_to(`welcome/kelas/<?= enkrip_str($overview['kode_prodi']) ?>`)">Kelas</a></li>
                    <li class="breadcrumb-item active"><?= $title ?></li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card" style="background-image: url('<?= base_url('assets/img/bg-profil.jpg') ?>');background-size:cover;min-height:100px;">
            <div class="card-body py-4">
                <p class="card-text text-light"><?= $overview['nm_smt']; ?></p>
                <h2 class="text-white font-weight-bold d-flex align-items-center">
                    KELAS <?= strtoupper($overview['nm_kls']); ?>
                </h2>
                <p class="card-text text-light mb-5">PROGRAM STUDI <?= strtoupper($overview['jenjang'] . ' ' . $overview['nm_prodi']); ?></p>
                <div class="d-flex justify-content-start overflow-auto">
                    <div class="me-5">
                        <p class="card-text text-light mb-0">Total mata kuliah</p>
                        <h4 class="text-light"><?= $overview['jml_mk'] ?></h4>
                    </div>
                    <div>
                        <p class="card-text text-light mb-0">Total mahasiswa</p>
                        <h4 class="text-light"><?= $overview['jml_mhs'] ?></h4>
                    </div>
                </div>
                <hr>
                <a class="btn btn-light" onclick="link_to(`welcome/kelas/<?= $overview['kode_prodi'] ?>`)"><i class="align-middle fas fa-fw fa-arrow-left"></i> KEMBALI</a>
                <?= csrf_field('csrf_token') ?>
                <input type="hidden" name="id_kls" id="id_kls" value="<?= service('uri')->getSegment(3) ?>">
                <input type="hidden" name="smt" id="smt" value="<?= service('uri')->getSegment(4) ?>">
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-lg-9">
        <div class="card">
            <div class="card-header px-4 pt-4">
                <h5 class="card-title mb-0">Daftar Mata Kuliah</h5>
            </div>
            <div class="card-body">

                <ol class="list-group list-group-flush list-group-numbered" id="load-matkul">
                </ol>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-3">
        <div class="card">
            <div class="card-header px-4 pt-4">
                <h5 class="card-title mb-0">Daftar Mahasiswa</h5>
            </div>
            <div class="card-body px-0">
                <div class="overflow-auto" style="max-height:500px;">
                    <div class="list-group list-group-flush">
                        <?php foreach ($mahasiswa as $mhs) : ?>
                            <div class="list-group-item border-0">
                                <div class="d-flex align-items-center">
                                    <div class="d-inline-block text-truncate">
                                        <div class="stat d-inline-block text-center me-2">
                                            <i class="align-middle far fa-fw fa-user"></i>
                                        </div> <?= strtoupper($mhs['nm_pd']) ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?= $this->endSection(); ?>