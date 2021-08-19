<?= $this->extend('pelajar/template'); ?>
<?= $this->section('content'); ?>


<div id="load-materi"></div>

<script>
    let id_kls = '<?= $id_kls ?>';
    let id_mk = '<?= $id_mk ?>';
    let link_cdn = '<?= URL_CDN . '/sidos/' ?>';
    let csrf_token = '<?= csrf_hash() ?>';
    var id_akunmhs = '<?= session()->get('id_akun') ?>';
    let halaman = 0;
</script>

<?= $this->endSection(); ?>