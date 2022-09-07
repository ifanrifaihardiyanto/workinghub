    <nav class="sidebar">
        <div class="sidebar-header">
            <a href="#" class="sidebar-brand">
            Noble<span>UI</span>
            </a>
            <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
            </div>
        </div>
        <div class="sidebar-body">
            <ul class="nav">
            <li class="nav-item nav-category">Main</li>
            <li class="nav-item">
                <a href="<?php echo base_url(); ?>dashboard-one.html" class="nav-link">
                <i class="link-icon" data-feather="box"></i>
                <span class="link-title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item nav-category">Pengelolaan</li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#pengelolaans" role="button" aria-expanded="false"
                aria-controls="pengelolaans">
                <i class="link-icon" data-feather="mail"></i>
                <span class="link-title">Operational</span>
                <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="pengelolaans">
                <ul class="nav sub-menu">
                    <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#Ruangans" role="button" aria-expanded="false"
                        aria-controls="Ruangans">
                        <span>Ruangan</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse" id="Ruangans">
                        <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="<?php echo base_url(); ?>pages/penyedia/data_ruangan.html" class="nav-link">Data Ruangan</a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url(); ?>pages/penyedia/gedung.html" class="nav-link">Tambah Data Ruangan</a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url(); ?>pages/admin/data_user.html" class="nav-link">Data User</a>
                        </li>
                        </ul>
                    </div>
                    </li>
                    <li class="nav-item">
                    <a href="<?php echo base_url(); ?>pages/penyedia/riwayat_penyewaan.html" class="nav-link">Riwayat Penyewaan</a>
                    </li>
                </ul>
                </div>
            </li>
            <li class="nav-item nav-category">Transaksi</li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#transaksi" role="button" aria-expanded="false"
                aria-controls="transaksi">
                <i class="link-icon" data-feather="mail"></i>
                <span class="link-title">Transaksi</span>
                <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="transaksi">
                <ul class="nav sub-menu">
                    <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#pembayaran" role="button" aria-expanded="false"
                        aria-controls="pembayaran">
                        <span>Pembayaran</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse" id="pembayaran">
                        <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="<?php echo base_url(); ?>pages/admin/data_pembayaran.html" class="nav-link">Data Pembayaran</a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url(); ?>pages/admin/validasi_pembayaran.html" class="nav-link">Validasi Pembayaran</a>
                        </li>
                        </ul>
                    </div>
                    </li>
                </ul>
                </div>
            </li>
            </ul>
        </div>
    </nav>