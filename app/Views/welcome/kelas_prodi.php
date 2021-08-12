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
            </div>
        </div>
    </div>
</div>

<div class="row mb-3 mb-xl-3">
    <div class="col-md-auto">
        <h3><?= $title ?></h3>
    </div>

    <div class="col-md-auto col-sm-12 ms-auto text-md-end mt-n1">

        <div class="dropdown d-md-inline-block d-inline">
            <div class="mb-0 row">
                <label class="col-form-label col-sm-2 col-12 pt-2 text-sm-left" for="id_smt">Filter</label>
                <div class="col-sm-10 col-12">
                    <select name="id_smt" id="id_smt" class="form-select" onchange="link_to(`<?= 'welcome/kelas/' . enkrip_str($overview['kode_prodi']) . '/' ?>`+this.options[this.selectedIndex].value)" style="min-width: 200px;">
                        <option selected disabled>Pilih semester</option>
                        <?php if ($semester) :
                            foreach ($semester as $smt) :
                                $selected = ($smt['id_smt'] == $semester_aktif) ? 'selected' : '';
                        ?>
                                <option value="<?= enkrip_str($smt['id_smt']) ?>" <?= $selected ?>><?= $smt['nm_smt'] ?></option>
                        <?php endforeach;
                        endif ?>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <?php foreach ($kelas as $kls) : ?>
        <div class="col-md-6 col-xxl-3 d-flex">
            <div class="card flex-fill">
                <div class="card-header">
                    <div class="d-md-flex align-items-center justify-content-between">
                        <h3 class="mb-0"><?= $kls['nm_kls'] ?></h3>
                        <p class="text-dark mb-0"><?= $kls['nm_smt'] ?></p>
                    </div>
                </div>
                <div class="card-body">
                    <div class="mb-0">
                        <p class="mb-2"><i class="align-middle me-2 far fa-fw fa-calendar-check"></i> Semester <?= $kls['smt'] ?></p>
                        <p class="mb-2"><i class="align-middle me-2 far fa-fw fa-clone"></i> <?= $kls['jml_mk'] ?> mata kuliah</p>
                        <p class="mb-0"><i class="align-middle me-2 far fa-fw fa-user"></i> <?= $kls['jml_mhs'] ?> mahasiswa</p>
                    </div>
                    <hr>
                    <a class="btn btn-primary" onclick="link_to(`<?= 'welcome/matkul/' . $kls['id_kls'] . '/' . enkrip_str($kls['smt']) ?>`)">Lihat Kelas <i class="align-middle ms-2 fas fa-fw fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?= $this->endSection(); ?>