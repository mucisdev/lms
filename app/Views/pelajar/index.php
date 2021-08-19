<?= $this->extend('pelajar/template'); ?>
<?= $this->section('content'); ?>

<div id="load-matkul"></div>

<script>
    let id_kls = '<?= $mahasiswa['id_kls'] ?>';
    let smt = '<?= $mahasiswa['smt'] ?>';
    let csrf_token = '<?= csrf_hash() ?>';
</script>

<?= $this->endSection(); ?>