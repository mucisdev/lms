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
                    <li class="breadcrumb-item"><a role="button" class="text-decoration-none" onclick="history.go(-1)">Mata Kuliah</a></li>
                    <li class="breadcrumb-item active"><?= $title ?></li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-lg-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Materi</h5>
                <h6 class="card-subtitle text-muted">Materi yang tersedia</h6>
            </div>
            <div class="card-body">
                <ol class="list-group list-group-flush" id="load-materi">

                </ol>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Tugas</h5>
                <h6 class="card-subtitle text-muted">Tugas yang tersedia</h6>
            </div>
            <div class="card-body">

                <div id="tasks-progress">
                    <ol class="list-group list-group-flush" id="load-tugas">

                    </ol>
                </div>

            </div>
        </div>
    </div>
</div>
<?= csrf_field('csrf_token') ?>

<script>
    <?php $uri = service('uri'); ?>
    var id_kls = '<?= $uri->getSegment(3) ?>';
    var id_mk = '<?= $uri->getSegment(4) ?>';
</script>
<?= $this->endSection(); ?>