<?= $this->extend('template/welcome'); ?>
<?= $this->section('content'); ?>

<div id="load-kelas"></div>

<script>
    let kode_prodi = '<?= $kode_prodi ?>';
    let csrf_token = '<?= csrf_hash() ?>';
</script>

<?= $this->endSection(); ?>