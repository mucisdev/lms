<?= $this->extend('welcome/template'); ?>
<?= $this->section('content'); ?>


<div id="load-materi"></div>

<?= csrf_field('csrf_token') ?>

<script>
    let id_kls = '<?= $id_kls ?>';
    let id_mk = '<?= $id_mk ?>';
    let smt = '<?= $smt ?>';
    let link_cdn = '<?= URL_CDN . '/sidos/' ?>';
    let csrf_token = '<?= csrf_hash() ?>';
    let is_login = '<?= session()->get('logged_in') ?>';
    let halaman = 0;
</script>

<?= $this->endSection(); ?>