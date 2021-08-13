<?= $this->extend('template/welcome'); ?>
<?= $this->section('content'); ?>

<div id="load-matkul"></div>

<?= csrf_field('csrf_token') ?>

<script>
    var id_kls = '<?= $id_kls ?>';
    var smt = '<?= $smt ?>';
</script>

<?= $this->endSection(); ?>