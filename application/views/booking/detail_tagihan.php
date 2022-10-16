<div class="grid-margin">
</div>

<div class="first-headline-page">
    <div class="container">
        <div class="headline-page">
            <div class="title-page">
                <div class="d-flex flex-row">
                    <div class="p-2"><a href="<?php echo base_url(); ?>order/list/">
                            <iconify-icon icon="ic:round-keyboard-backspace" width="28" height="28"></iconify-icon>
                        </a></div>
                    <div class="p-2">
                        <h4>Tagihan</h4>
                    </div>
                </div>
            </div>
            <div class="desc-title pd-btm-10">
                <?php
                // print_r($result->tagihan[0]->kode_status);
                $tgl_pemesanan  = date('d M Y', strtotime($result->tagihan[0]->tgl_pemesanan));
                $tgl_penyewaan  = date('d M Y', strtotime($result->tagihan[0]->mulai_penyewaan));
                $tgl_selesai    = date('d M Y', strtotime($result->tagihan[0]->selesai_penyewaan));

                if ($result->tagihan[0]->kode_status == '200' && $result->tagihan[0]->aktivasi == '1') {
                    if ($tgl_selesai < date('d M Y')) {
                        $bukti_status = "Penyewaan Selesai";
                        $st_bukti = "secondary";
                    } else {
                        $bukti_status = "Penyewaan Aktif";
                        $st_bukti = "success";
                    }
                } elseif ($result->tagihan[0]->kode_status == '200' && $result->tagihan[0]->aktivasi == '0') {
                    if ($tgl_selesai < date('d M Y')) {
                        $bukti_status = "Penyewaan Selesai";
                        $st_bukti = "secondary";
                    } else {
                        $bukti_status = "Menunggu validasi dari admin";
                        $st_bukti = "warning";
                    }
                } elseif ($result->tagihan[0]->kode_status == '202' && $result->tagihan[0]->aktivasi == '0') {
                    $bukti_status = "Pembayaran Kadaluarsa";
                    $st_bukti = "secondary";
                } else {
                    if ($tgl_selesai < date('d M Y')) {
                        $bukti_status = "Penyewaan Selesai";
                        $st_bukti = "secondary";
                    } else {
                        $bukti_status = "Menunggu Pembayaran";
                        $st_bukti = "warning";
                    }
                }
                ?>
                <div class="alert alert-fill-<?= $st_bukti ?>" role="alert"><?= $bukti_status ?></div>
            </div>
        </div>
        <?php
        // print_r($result);
        if (!empty($result->tagihan[0]->gambar)) {
            $data_gambar = explode(', ', $result->tagihan[0]->gambar);
        }
        $data_gambar = explode('workinghub', $data_gambar[0]);
        $gambar = $data_gambar[1];

        if ($result->tagihan[0]->metode_pembayaran == 'Transfer Bank BNI') {
            $img = "logo_bank_bni.png";
        } elseif ($result->tagihan[0]->metode_pembayaran == 'Transfer Bank BRI') {
            $img = "logo_bank_bri.png";
        } elseif ($result->tagihan[0]->metode_pembayaran == 'Transfer Bank Mandiri') {
            $img = "logo_bank_mandiri.png";
        } else {
            $img = "logo_bank_bca.png";
        }
        ?>
        <div class="data-pemesanan">
            <div class="bd-example">
                <div class="d-flex justify-content-between">
                    <div class="detail-pemesan">
                        <div class="card">
                            <div class="d-flex justify-content-between">
                                <img src="<?php echo base_url(); ?><?= $gambar ?>" alt="" style="width: 40%;">
                                <div class="card-body">
                                    <div class="detail-ruangan">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <strong><?= $result->tagihan[0]->nama_gedung . ' - ' . $result->tagihan[0]->nama_ruangan ?></strong>
                                            </div>
                                            <?php if ($result->tagihan[0]->kode_status == '201') { ?>
                                            <span class="badge badge-warning">Menunggu Pembayaran</span>
                                            <?php } else { ?>
                                            <span class="badge badge-success">Sudah Membayar</span>
                                            <?php } ?>
                                        </div>
                                        <hr>
                                        <div class="d-flex justify-content-between">
                                            <p>Kode Pemesanan</p>
                                            <p><?= $result->tagihan[0]->kode_pemesanan ?></p>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <p>Lokasi</p>
                                            <p><?= $result->tagihan[0]->lokasi ?></p>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <p>Tanggal Pemesanan</p>
                                            <p><?= $tgl_pemesanan ?></p>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <p>Mulai Penyewaan</p>
                                            <p><?= $tgl_penyewaan ?></p>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <p>Selesai Penyewaan</p>
                                            <p><?= $tgl_selesai ?></p>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <p>Durasi Penyewaan</p>
                                            <p><?= $result->tagihan[0]->jml_durasi . ' ' . $result->tagihan[0]->tipe_durasi ?>
                                            </p>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <p>Kapasitas</p>
                                            <p><?= $result->tagihan[0]->kapasitas ?> Orang</p>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <p>Jumlah Penyewa</p>
                                            <p>2 Orang</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="headline-page">
                            <div class="title-page">
                                <h4>Total Pembayaran</h4>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <p>Total</p>
                                        <p><?= 'Rp ' . number_format($result->tagihan[0]->total_pembayaran, 0, ',', '.') ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="detail-penyewaan">
                        <div class="card mg-btm-10">
                            <div class="card-body">
                                <h5>Data Pemesan</h5>
                                <div class="content-detail">
                                    <p><?= $result->tagihan[0]->nama ?></p>
                                    <p><?= $result->tagihan[0]->no_tlp ?></p>
                                    <p><?= $result->tagihan[0]->email ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>