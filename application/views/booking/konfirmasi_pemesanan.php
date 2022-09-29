<div class="grid-margin">
        </div>

        
        <div class="first-headline-page">
          <div class="container">
            <div class="headline-page">
            <?php
                // print_r($result);
                $tgl_now            = date('Y-m-d');
                $tgl_pemesanan      = date('d M Y', strtotime($result->tglPemesanan));
                $mulai_penyewaan    = date('d M Y', strtotime($result->mulaiPenyewaan));
                $tgl_sewa           = date('Y-m-d', strtotime($result->mulaiPenyewaan));
                $selesai_penyewaan  = date('d M Y', strtotime($result->selesaiPenyewaan));
                $tgl_end            = date('Y-m-d', strtotime($result->selesaiPenyewaan));
            ?>
              <div class="title-page"><h4>Mohon Review Pesanan Anda</h4></div>
              <div class="desc-title pd-btm-10">Mohon periksa kembali pemesanan anda sebelum melanjutkan ke pembayaran.</div>
            </div>
            <div class="data-pemesanan">
              <div class="bd-example">
                <div class="d-flex justify-content-between">
                    <div class="detail-pemesan">
                    <form action="<?php echo base_url(); ?>index.php/search/terkonfirmasi" method="post">
                        <div class="card">
                        <div class="d-flex justify-content-between">
                            <img src="../../images/bg_1.jpg" alt="" style="width: 40%;">
                            <div class="card-body">
                            <div class="detail-ruangan">
                                <div><strong><?= $result->ruangan[0]->nama_gedung.' - '.$result->ruangan[0]->nama_ruangan ?></strong></div>
                                <hr>
                                <div class="d-flex justify-content-between">
                                <p>Alamat</p>
                                <p><?= $result->ruangan[0]->lokasi ?></p>
                                </div>
                                <div class="d-flex justify-content-between">
                                <p>Tanggal Pemesanan</p>
                                <p><?= $tgl_pemesanan ?></p>
                                </div>
                                <div class="d-flex justify-content-between">
                                <p>Mulai Penyewaan</p>
                                <p><?= $mulai_penyewaan ?></p>
                                </div>
                                <div class="d-flex justify-content-between">
                                <p>Selesai Penyewaan</p>
                                <p><?= $selesai_penyewaan ?></p>
                                </div>
                                <div class="d-flex justify-content-between">
                                <p>Durasi Penyewaan</p>
                                <p><?= $result->jmlDurasi.' '.$result->durasi ?></p>
                                </div>
                                <div class="d-flex justify-content-between">
                                <p>Kapasitas</p>
                                <p><?= $result->ruangan[0]->kapasitas ?> Orang</p>
                                </div>
                                <div class="d-flex justify-content-between">
                                <p>Jumlah Penyewa</p>
                                <p>2 Orang</p>
                                </div>
                            </div>
                            </div>
                        </div>
                        </div>
                        <div class="headline-page pd-btm-20">
                            <div class="title-page"><h4>Total Pembayaran</h4></div>
                            <div class="card">
                                <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <p>Total</p>
                                    <p><?= 'Rp '.number_format($result->hidejmlHarga,0,',','.') ?></p>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="insert-form">
                            <input id="tglSekarang" class="form-control" name="tglSekarang" type="date" value="<?= $tgl_now ?>" hidden>
                            <input id="tglPenyewaan" class="form-control" name="tglPenyewaan" type="date" value="<?= $tgl_sewa ?>" hidden>
                            <input id="tglSelesai" class="form-control" name="tglSelesai" type="date" value="<?= $tgl_end ?>" hidden>
                            <input id="tipeDurasi" class="form-control" name="tipeDurasi" type="text" value="<?= $result->durasi ?>" hidden>
                            <input id="jmlDurasi" class="form-control" name="jmlDurasi" type="text" value="<?= $result->jmlDurasi ?>" hidden>
                            <input id="id_ruangan" class="form-control" name="id_ruangan" type="text" value="<?= $result->ruangan[0]->id_ruangan ?>" hidden>
                            <input id="durasi" class="form-control" name="durasi" type="text" value="<?= $result->durasi ?>" hidden>
                            <input id="harga" class="form-control" name="harga" type="text" value="<?= $result->hidejmlHarga ?>" hidden>
                        </div>
                        <div class="d-flex justify-content-between width-30">
                            <input type="submit" value="Pilih Pembayaran" class="btn btn-block btn-primary">
                        </div>
                        </form>
                    </div>
                  <div class="detail-penyewaan">
                    <div class="card">
                      <div class="card-body">
                        <h5>Data Pemesan</h5>
                        <div class="content-detail">
                          <p><?= $data->profile[0]->nama ?></p>
                          <p><?= $data->profile[0]->no_tlp ?></p>
                          <p><?= $data->profile[0]->email ?></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>