<?= $this->extend('template/welcome'); ?>
<?= $this->section('content'); ?>

<div id="load-matkul"></div>

<script>
    let id_kls = '<?= $id_kls ?>';
    let smt = '<?= $smt ?>';
    let csrf_token = '<?= csrf_hash() ?>';
</script>

<?= $this->endSection(); ?>