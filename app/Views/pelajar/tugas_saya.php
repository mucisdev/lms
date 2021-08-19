<?= $this->extend('pelajar/template'); ?>
<?= $this->section('content'); ?>



<script>
    let id_classwork = '<?= $id_classwork ?>';
    let id_reg_pd = '<?= $id_reg_pd ?>';
    let link_cdn = '<?= URL_CDN . '/sidos/' ?>';
    let csrf_token = '<?= csrf_hash() ?>';
    var id_akunmhs = '<?= session()->get('id_akun') ?>';
</script>

<?= $this->endSection(); ?>