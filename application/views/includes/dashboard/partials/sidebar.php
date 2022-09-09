<?php
    $user = $this->session->userdata('user');
?>
    <nav class="sidebar">
        <div class="sidebar-header">
            <a href="<?php echo base_url(); ?>index.php/home" class="sidebar-brand">
                <div class="logo"><span class="text1">Working</span><span class="text2">Hub.</span></div>
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
                    <a href="<?php echo base_url(); ?>index.php/home" class="nav-link">
                        <i class="link-icon" data-feather="box"></i>
                        <span class="link-title">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item nav-category">Pengelolaan</li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#pengelolaans" role="button" aria-expanded="false" aria-controls="pengelolaans">
                        <i class="link-icon" data-feather="mail"></i>
                        <span class="link-title">Operational</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <?php if (in_array($user[0]->role, ['Partner'])) : ?>
                    <div class="collapse" id="pengelolaans">
                        <ul class="nav sub-menu">
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="collapse" href="#Ruangans" role="button" aria-expanded="false" aria-controls="Ruangans">
                                    <span>Ruangan</span>
                                    <i class="link-arrow" data-feather="chevron-down"></i>
                                </a>
                                <div class="collapse" id="Ruangans">
                                    <ul class="nav sub-menu">
                                        <li class="nav-item">
                                            <a href="<?php echo base_url(); ?>index.php/partner/manageruangan" class="nav-link">Data Ruangan</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="<?php echo base_url(); ?>index.php/partner/manageruangan/addGedung" class="nav-link">Tambah Data Ruangan</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo base_url(); ?>index.php/partner/manageruangan/penyewaan" class="nav-link">Riwayat Penyewaan</a>
                            </li>
                        </ul>
                    </div>
                    <?php endif; ?>
                    <?php if (in_array($user[0]->role, ['Admin'])) : ?>
                    <div class="collapse" id="pengelolaans">
                        <ul class="nav sub-menu">
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="collapse" href="#Users" role="button" aria-expanded="false" aria-controls="Users">
                                    <span>User</span>
                                    <i class="link-arrow" data-feather="chevron-down"></i>
                                </a>
                                <div class="collapse" id="Users">
                                    <ul class="nav sub-menu">
                                        <li class="nav-item">
                                            <a href="<?php echo base_url(); ?>index.php/admin/manageuser" class="nav-link">Data User</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="collapse" href="#Ruangans" role="button" aria-expanded="false" aria-controls="Ruangans">
                                    <span>Ruangan</span>
                                    <i class="link-arrow" data-feather="chevron-down"></i>
                                </a>
                                <div class="collapse" id="Ruangans">
                                    <ul class="nav sub-menu">
                                        <li class="nav-item">
                                            <a href="<?php echo base_url(); ?>index.php/admin/manageruangan" class="nav-link">Data Ruangan</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item nav-category">Transaksi</li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#transaksi" role="button" aria-expanded="false" aria-controls="transaksi">
                        <i class="link-icon" data-feather="mail"></i>
                        <span class="link-title">Transaksi</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse" id="transaksi">
                        <ul class="nav sub-menu">
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="collapse" href="#pembayaran" role="button" aria-expanded="false" aria-controls="pembayaran">
                                    <span>Pembayaran</span>
                                    <i class="link-arrow" data-feather="chevron-down"></i>
                                </a>
                                <div class="collapse" id="pembayaran">
                                    <ul class="nav sub-menu">
                                        <li class="nav-item">
                                            <a href="<?php echo base_url(); ?>index.php/admin/managepembayaran" class="nav-link">Data Pembayaran</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="<?php echo base_url(); ?>index.php/admin/managepembayaran/validasi" class="nav-link">Validasi Pembayaran</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>