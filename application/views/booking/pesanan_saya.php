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
          if (count($data->profile) === 0) { ?>
                    <div class="col-md-12 pd-btm-10">
                        <div class="alert alert-light text-center" role="alert">Silahkan login untuk melihat histori
                            pesanan anda!</div>
                    </div>
                    <?php
          } elseif (count($result->tagihan) === 0) { ?>
                    <div class="col-md-12 pd-btm-10">
                        <div class="alert alert-light text-center" role="alert">Data pemesanan kosong!</div>
                    </div>
                    <?php
          }
          // print_r($result);
          foreach ($result->tagihan as $item => $list) :
            // print_r($list->aktivasi);

            $tgl_penyewaan  = date('d M Y', strtotime($list->mulai_penyewaan));
            $tgl_selesai    = date('d M Y', strtotime($list->selesai_penyewaan));
            $tgl_penyewaan1  = date('Y-m-d', strtotime($list->mulai_penyewaan));
            $tgl_selesai1    = date('Y-m-d', strtotime($list->selesai_penyewaan));
            $tgl = date('Y-m-d');

            if ($tgl > $tgl_selesai1) {
              $test = "Penyewaan Selesai";
              // $st_bukti = "secondary";
            } else {
              $test = "Menunggu Pembayaran";
              // $st_bukti = "warning";
            }

            // print_r($tgl_selesai1 . ' -- ' . $tgl . ' -- ' . $test);

            if ($list->kode_status == '200') {
              if ($tgl > $tgl_selesai1) {
                $bukti_status = "Penyewaan Selesai";
                $st_bukti = "secondary";
              } else {
                $bukti_status = "Penyewaan Aktif";
                $st_bukti = "success";
              }
            } elseif ($list->kode_status == '202') {
              $bukti_status = "Pembayaran Kadaluarsa";
              $st_bukti = "secondary";
            } else {
              if ($tgl > $tgl_selesai1) {
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
                                <div class="pd-list-order"><?= $list->nama_gedung . ' - ' . $list->nama_ruangan ?></div>
                                <div class="pd-list-order">Durasi
                                    <?= $list->jml_durasi . ' ' . $list->tipe_durasi . ' | ' . $tgl_penyewaan . ' - ' . $tgl_selesai ?>
                                </div>
                                <div class="d-flex justify-content-between pd-list-order">
                                    <div><span class="badge badge-<?= $st_bukti ?>"><?= $bukti_status ?></span></div>
                                    <?php if ($bukti_status == 'Penyewaan Selesai') {
                    } else { ?>
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