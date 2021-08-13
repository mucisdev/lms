<?= $this->extend('template/welcome'); ?>
<?= $this->section('content'); ?>

<div id="load-kelas"></div>

<?= csrf_field('csrf_token') ?>
<script>
    var kode_prodi = '<?= $kode_prodi ?>';
</script>

<?= $this->endSection(); ?>