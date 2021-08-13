<?= $this->extend('template/welcome'); ?>
<?= $this->section('content'); ?>


<div id="load-materi"></div>

<?= csrf_field('csrf_token') ?>

<script>
    var id_kls = '<?= $id_kls ?>';
    var id_mk = '<?= $id_mk ?>';
    var link_cdn = '<?= URL_CDN . '/sidos/' ?>';
</script>

<?= $this->endSection(); ?>