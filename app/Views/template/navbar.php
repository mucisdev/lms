<nav id="sidebar" class="sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand text-start" href="<?= current_url() ?>">
            <i class="align-middle me-2 text-primary fas fa-fw fa-grip-horizontal"></i>

            <span class="align-middle me-3">AppStack</span>
        </a>

        <ul class="sidebar-nav">

            <li class="sidebar-header">
                MAIN MENU
            </li>
            <li class="sidebar-item <?= isset($m_home) ? $m_home : '' ?>">
                <a class="sidebar-link" href="<?= site_url('home') ?>">
                    <i class="align-middle me-2 far fa-fw fa-bookmark"></i> <span class="align-middle">Dashboard</span>
                </a>
            </li>
            <li class="sidebar-item <?= isset($m_ujian) ? $m_ujian : '' ?>">
                <a class="sidebar-link" href="<?= site_url('home') ?>">
                    <i class="align-middle me-2 far fa-fw fa-lightbulb"></i> <span class="align-middle">Data Ujian</span>
                </a>
            </li>
            <li class="sidebar-item <?= isset($m_soal) ? $m_soal : '' ?>">
                <a class="sidebar-link" href="<?= site_url('soal') ?>">
                    <i class="align-middle me-2 far fa-fw fa-paper-plane"></i> <span class="align-middle">Soal</span>
                </a>
            </li>
            <li class="sidebar-item <?= isset($m_kategori) ? $m_kategori : '' ?>">
                <a class="sidebar-link" href="<?= site_url('kategori_soal') ?>">
                    <i class="align-middle me-2 far fa-fw fa-star"></i> <span class="align-middle">Kategori Soal</span>
                </a>
            </li>
            <li class="sidebar-item <?= isset($m_jenis_soal) ? $m_jenis_soal : '' ?>">
                <a class="sidebar-link" href="<?= site_url('ref_jenis_soal') ?>">
                    <i class="align-middle me-2 far fa-fw fa-bookmark"></i> <span class="align-middle">Jenis Soal</span>
                </a>
            </li>

            <?php
            // menu berikut hanya untuk super admin
            $level = session()->get('level');
            if ($level == 'super') : ?>
                <!-- <li class="sidebar-item <?= isset($m_pendaftar) ? $m_pendaftar : '' ?>">
                <a class="sidebar-link" href="<?= site_url('pendaftar') ?>">
                    <i class="align-middle me-2 far fa-fw fa-user"></i> <span class="align-middle">Pendaftar</span>
                </a>
                </li>
                <li class="sidebar-item <?= isset($m_pendaftar_baru) ? $m_pendaftar_baru : '' ?>">
                    <a class="sidebar-link" href="<?= site_url('pendaftar_baru') ?>">
                        <i class="align-middle me-2 far fa-fw fa-user"></i> <span class="align-middle">Pendaftar Baru</span>
                    </a>
                </li> -->

                <li class="sidebar-header">
                    MANAJEMEN
                </li>
                <li class="sidebar-item <?= isset($m_jurusan) ? $m_jurusan : '' ?>">
                    <a class="sidebar-link" href="<?= site_url('ref_jurusan') ?>">
                        <i class="align-middle me-2 far fa-fw fa-lemon"></i> <span class="align-middle">Jurusan</span>
                    </a>
                </li>
                <li class="sidebar-item <?= isset($m_peserta) ? $m_peserta : '' ?>">
                    <a class="sidebar-link" href="<?= site_url('peserta') ?>">
                        <i class="align-middle me-2 far fa-fw fa-user"></i> <span class="align-middle">Peserta</span>
                    </a>
                </li>
                <li class="sidebar-item <?= isset($m_admin) ? $m_admin : '' ?>">
                    <a class="sidebar-link" href="<?= site_url('admin') ?>">
                        <i class="align-middle me-2 far fa-fw fa-user-circle"></i> <span class="align-middle">Admin</span>
                    </a>
                </li>

            <?php endif ?>

            <li class="sidebar-header">
                PENGATURAN
            </li>
            <li class="sidebar-item <?= isset($m_akun) ? $m_akun : '' ?>">
                <a class="sidebar-link" href="<?= site_url('akun') ?>">
                    <i class="align-middle me-2 far fa-fw fa-check-circle"></i> <span class="align-middle">Ubah Password</span>
                </a>
            </li>
            <li class="sidebar-item <?= isset($m_konfigurasi) ? $m_konfigurasi : '' ?>">
                <a class="sidebar-link" href="<?= site_url('ref_konfigurasi') ?>">
                    <i class="align-middle me-2 far fa-fw fa-sun"></i> <span class="align-middle">Konfigurasi</span>
                </a>
            </li>
            <!-- <li class="sidebar-item <?= isset($m_ref) ? $m_ref : '' ?>">
                <a data-bs-target="#ref" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle me-2 far fa-fw fa-lemon"></i> <span class="align-middle">Referensi</span>
                </a>
                <ul id="ref" class="sidebar-dropdown list-unstyled collapse <?= isset($m_ref) ? 'show' : '' ?>" data-bs-parent="#sidebar">
                    <li class="sidebar-item <?= isset($ref_jurusan) ? $ref_jurusan : '' ?>"><a class="sidebar-link" href="<?= site_url('ref_jurusan') ?>">Jurusan</a></li>
                    <li class="sidebar-item <?= isset($kategori_soal) ? $kategori_soal : '' ?>"><a class="sidebar-link" href="<?= site_url('kategori_soal') ?>">Kategori</a></li>
                </ul>
            </li> -->
            <!-- <li class="sidebar-item <?= isset($m_user) ? $m_user : '' ?>">
                <a class="sidebar-link" href="<?= site_url('user') ?>">
                    <i class="align-middle me-2 far fa-fw fa-user"></i> <span class="align-middle">User</span>
                </a>
            </li> -->

        </ul>
    </div>
</nav>