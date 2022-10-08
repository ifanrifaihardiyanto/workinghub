<div class="grid-margin">
</div>

<div class="first-headline-page">
    <div class="container">
        <div class="headline-page">
            <div class="title-page">
                <h4>Daftar Pemesanan</h4>
            </div>
        </div>
        <div class="data-pemesanan">
            <div class="bd-example">
                <div class="row">
                    <?php
                      foreach ($result->tagihan as $item => $list) : 

                        $tgl_penyewaan  = date('d M Y', strtotime($list->mulai_penyewaan));
                        $tgl_selesai    = date('d M Y', strtotime($list->selesai_penyewaan));
                        
                        if ($list->status_bukti == '1' && $list->aktivasi == '1') {
                          if ($tgl_selesai < date('d M Y')) {
                            $bukti_status = "Penyewaan Selesai";
                            $st_bukti = "secondary";
                          } else {
                            $bukti_status = "Penyewaan Aktif";
                            $st_bukti = "success";
                          }
                        } elseif ($list->status_bukti == '1' && $list->aktivasi == '0') {
                          if ($tgl_selesai < date('d M Y')) {
                            $bukti_status = "Penyewaan Selesai";
                            $st_bukti = "secondary";
                          } else {
                            $bukti_status = "Menunggu validasi dari admin";
                            $st_bukti = "warning";
                          }
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
                    <div class="col-md-12 pd-btm-10">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between pd-list-order">
                                    <h6>Kode Pemesanan : <?= $list->kode_pemesanan ?></h6>
                                    <h6><?= 'Rp ' . number_format($list->total_pembayaran, 0, ',', '.') ?></h6>
                                </div>
                                <div class="pd-list-order"><?= $list->nama_gedung.' - '.$list->nama_ruangan ?></div>
                                <div class="pd-list-order">Durasi
                                    <?= $list->jml_durasi.' '.$list->tipe_durasi.' | '.$tgl_penyewaan.' - '.$tgl_selesai ?>
                                </div>
                                <div class="d-flex justify-content-between pd-list-order">
                                    <div><span class="badge badge-<?= $st_bukti ?>"><?= $bukti_status ?></span></div>
                                    <?php if ($bukti_status == 'Penyewaan Selesai') {} else { ?>
                                    <div><a
                                            href="<?php echo base_url(); ?>order/detail_tagihan/<?= $list->kode_pemesanan ?>">Lihat
                                            detail</a></div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>