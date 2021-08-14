<?= $this->extend('template/welcome'); ?>
<?= $this->section('content'); ?>


<div id="load-materi"></div>

<?= csrf_field('csrf_token') ?>

<script>
    let id_kls = '<?= $id_kls ?>';
    let id_mk = '<?= $id_mk ?>';
    let link_cdn = '<?= URL_CDN . '/sidos/' ?>';
    let csrf_token = '<?= csrf_hash() ?>';
</script>

<?= $this->endSection(); ?>