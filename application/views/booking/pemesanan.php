<div class="grid-margin">
</div>

<div class="first-headline-page">
    <div class="container">
        <div class="headline-page">
            <?php
            // print_r($result);
            $tgl_sekarang   = date('d M Y');
            $tgl_now        = date('Y-m-d');
            $tgl_penyewaan  = date('d M Y', strtotime($result->tglPenyewaan));
            $tgl_sewa       = date('Y-m-d', strtotime($result->tglPenyewaan));
            $tgl_selesai    = date('d M Y', strtotime($result->tglEndPenyewaan));
            $tgl_end        = date('Y-m-d', strtotime($result->tglEndPenyewaan));
            $jmlDurasi      = $result->hidejmlDurasi;
            $startHour      = $result->startHour . ".00";
            $endHour        = $result->endHour . ".00";
            ?>
            <div class="title-page">
                <h4>Pemesanan Ruangan</h4>
            </div>
            <div class="desc-title pd-btm-10">Isi data pemesanan dibawah</div>
        </div>
        <div class="data-pemesanan">
            <div class="bd-example">
                <div class="detail-pemesan">
                    <form action="<?php echo base_url(); ?>search/konfirmasi_pemesanan" method="post">
                        <div class="card pd-btm-20">
                            <div class="card-body">
                                <h5 class="pd-btm-10">Data Pemesan</h5>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input id="nama" class="form-control" name="nama" type="text"
                                                placeholder="Nama" value="<?= $data->profile[0]->name ?>" disabled>
                                            <input id="nama" class="form-control" name="nama" type="text"
                                                placeholder="Nama" value="<?= $data->profile[0]->name ?>" hidden>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input id="nmrTlp" class="form-control" name="nmrTlp" type="number"
                                                placeholder="Nomor Telepon" value="<?= $data->profile[0]->no_tlp ?>"
                                                disabled>
                                            <input id="nmrTlp" class="form-control" name="nmrTlp" type="number"
                                                placeholder="Nomor Telepon" value="<?= $data->profile[0]->no_tlp ?>"
                                                hidden>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input id="email" class="form-control" name="email" type="email"
                                                placeholder="Email" value="<?= $data->profile[0]->email ?>" disabled>
                                            <input id="email" class="form-control" name="email" type="email"
                                                placeholder="Email" value="<?= $data->profile[0]->email ?>" hidden>
                                        </div>
                                    </div>
                                    <input id="tglSekarang" class="form-control" name="tglSekarang" type="date"
                                        value="<?= $tgl_now ?>" hidden>
                                    <input id="tglPenyewaan" class="form-control" name="tglPenyewaan" type="date"
                                        value="<?= $tgl_sewa ?>" hidden>
                                    <input id="tglSelesai" class="form-control" name="tglSelesai" type="date"
                                        value="<?= $tgl_end ?>" hidden>
                                    <input id="tipeDurasi" class="form-control" name="tipeDurasi" type="text"
                                        value="<?= $result->durasi ?>" hidden>
                                    <input id="jmlDurasi" class="form-control" name="jmlDurasi" type="text"
                                        value="<?= $result->hidejmlDurasi ?>" hidden>
                                    <input id="id_ruangan" class="form-control" name="id_ruangan" type="text"
                                        value="<?= $result->ruangan[0]->id_ruangan ?>" hidden>
                                    <input id="durasi" class="form-control" name="durasi" type="text"
                                        value="<?= $result->durasi ?>" hidden>
                                    <input id="harga" class="form-control" name="harga" type="text"
                                        value="<?= $result->hidejmlHarga ?>" hidden>
                                    <input id="startHour" class="form-control" name="startHour" type="text"
                                        value="<?= $result->startHour ?>" hidden>
                                    <input id="endHour" class="form-control" name="endHour" type="text"
                                        value="<?= $result->endHour ?>" hidden>
                                </div>
                            </div>
                        </div>
                        <div class="headline-page">
                            <div class="card">
                                <div class="card-body">
                                    <h5><?= $result->ruangan[0]->name_gedung . ' - ' . $result->ruangan[0]->name_ruangan  ?>
                                    </h5>
                                    <div class="content-detail">
                                        <div class="d-flex justify-content-between">
                                            <p>Tipe Durasi</p>
                                            <p><?= $result->durasi ?></p>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <p>Tanggal Pemesanan</p>
                                            <p><?= $tgl_sekarang ?></p>
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
                                            <p><?= $result->hidejmlDurasi . ' ' . $result->durasi ?></p>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <p>Jam Mulai</p>
                                            <p><?= $startHour ?></p>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <p>Jam Selesai</p>
                                            <p><?= $endHour ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="headline-page">
                            <div class="title-page">
                                <h4>Kebijakan Pembatalan</h4>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p class="p-2">Pembatalan tidak dapat dilakukan jika sudah melakukan
                                                pembayaran.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="headline-page pd-btm-20">
                            <div class="title-page">
                                <h4>Total Pembayaran</h4>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <p>Total</p>
                                        <p><?= 'Rp ' . number_format($result->hidejmlHarga, 0, ',', '.') ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end width-30">
                            <input type="submit" value="Lanjutkan Pemesanan" class="btn btn-block btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>