<?= $this->extend('welcome/template'); ?>
<?= $this->section('content'); ?>

<div id="load-matkul"></div>

<script>
    let id_kls = '<?= $id_kls ?>';
    let smt = '<?= $smt ?>';
    let csrf_token = '<?= csrf_hash() ?>';
    let is_login = '<?= session()->get('logged_in') ?>';
</script>

<?= $this->endSection(); ?>