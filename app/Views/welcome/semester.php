<?= $this->extend('welcome/template'); ?>
<?= $this->section('content'); ?>

<div class="row">
    <div class="col-md-4 col-12 mx-auto pt-5 text-center">
        <?php if ($semester) : ?>
            <?= csrf_field('csrf_token') ?>
            <h4 class="text-center mb-4">Silahkan pilih tahun akademik</h4>
            <div class="form-floating mb-5">
                <select class="form-select" id="id_smt" name="id_smt" aria-label="Floating label select example" onchange="gantiSmt()">
                    <option selected disabled>Pilih Tahun Akademik</option>
                    <?php foreach ($semester as $smt) :
                        $selected = ($smt['id_smt'] == session()->get('id_smt')) ? 'selected' : '';
                    ?>
                        <option value="<?= $smt['id_smt'] ?>" <?= $selected ?>><?= $smt['nm_smt'] ?></option>
                    <?php endforeach ?>
                </select>
                <label for="id_smt">Pilih Tahun Akademik</label>
            </div>
            <a class="btn btn-primary" role="button" onclick="history.go(-1)"><i class="align-middle me-2 fas fa-fw fa-arrow-left"></i> Kembali ke Home</a>
        <?php else : ?>
            <h1 class="text-center mb-5">Tidak ada data semester</h1>
            <a class="btn btn-primary" role="button" onclick="link_to(`welcome`)"><i class="align-middle me-2 fas fa-fw fa-arrow-left"></i> Kembali ke Home</a>
        <?php endif ?>
    </div>
</div>

<?= $this->endSection(); ?>