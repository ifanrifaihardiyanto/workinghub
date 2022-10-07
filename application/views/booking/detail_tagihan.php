<div class="grid-margin">
</div>

<div class="first-headline-page">
    <div class="container">
        <div class="headline-page">
            <div class="title-page">
                <div class="d-flex flex-row">
                    <div class="p-2"><a href="<?php echo base_url(); ?>index.php/order/list/">
                            <iconify-icon icon="ic:round-keyboard-backspace" width="28" height="28"></iconify-icon>
                        </a></div>
                    <div class="p-2">
                        <h4>Tagihan</h4>
                    </div>
                </div>
            </div>
            <div class="desc-title pd-btm-10">
                <?php if ($result->tagihan[0]->status_bukti == '1' && $result->tagihan[0]->aktivasi == '0') { ?>
                <div class="alert alert-fill-warning" role="alert">Menunggu Validasi</div>
                <?php } elseif ($result->tagihan[0]->status_bukti == '1' && $result->tagihan[0]->aktivasi == '1') { ?>
                <div class="alert alert-fill-success" role="alert">Penyewaan Aktif</div>
                <?php } ?>
            </div>
        </div>
        <?php
          // print_r($result);
          if (!empty($result->tagihan[0]->gambar)) {
            $data_gambar = explode(', ', $result->tagihan[0]->gambar);
          }
          $gambar = $data_gambar[0];

          if ($result->tagihan[0]->metode_pembayaran == 'Transfer Bank BNI') {
            $img = "logo_bank_bni.png";
          } elseif ($result->tagihan[0]->metode_pembayaran == 'Transfer Bank BRI') {
            $img = "logo_bank_bri.png";
          } elseif ($result->tagihan[0]->metode_pembayaran == 'Transfer Bank Mandiri') {
            $img = "logo_bank_mandiri.png";
          } else {
            $img = "logo_bank_bca.png";
          }

          $tgl_pemesanan  = date('d M Y', strtotime($result->tagihan[0]->tgl_pemesanan));
          $tgl_penyewaan  = date('d M Y', strtotime($result->tagihan[0]->mulai_penyewaan));
          $tgl_selesai    = date('d M Y', strtotime($result->tagihan[0]->selesai_penyewaan));
        ?>
        <div class="data-pemesanan">
            <div class="bd-example">
                <div class="d-flex justify-content-between">
                    <div class="detail-pemesan">
                        <div class="card">
                            <div class="d-flex justify-content-between">
                                <img src="data:image;base64,<?= $gambar ?>" alt="" style="width: 40%;">
                                <div class="card-body">
                                    <div class="detail-ruangan">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <strong><?= $result->tagihan[0]->nama_gedung . ' - ' . $result->tagihan[0]->nama_ruangan ?></strong>
                                            </div>
                                            <?php if ($result->tagihan[0]->status_bukti == '0') { ?>
                                            <!-- <div class="alert alert-warning" role="alert">Menunggu Pembayaran</div> -->
                                            <span class="badge badge-warning">Menunggu Pembayaran</span>
                                            <?php } else { ?>
                                            <!-- <div class="alert alert-success" role="alert">Sudah Membayar</div> -->
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
                                    <p><?= $data->profile[0]->nama ?></p>
                                    <p><?= $data->profile[0]->no_tlp ?></p>
                                    <p><?= $data->profile[0]->email ?></p>
                                </div>
                            </div>
                        </div>
                        <?php if ($result->tagihan[0]->status_bukti == '0') { ?>
                        <div class="card">
                            <div class="card-body">
                                <h5>Upload Bukti Pembayaran</h5>
                                <div class="content-detail">
                                    <form action="<?php echo base_url(); ?>index.php/search/uploadBuktiPembayaran"
                                        method="post" enctype="multipart/form-data">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>File upload</label>
                                                <input type="file" name="bukti_pembayaran" id="bukti_pembayaran"
                                                    class="file-upload-default">
                                                <div class="input-group col-xs-12">
                                                    <input type="text" class="form-control file-upload-info" disabled=""
                                                        placeholder="Upload Image" name="bukti_pembayaran"
                                                        id="bukti_pembayaran">
                                                    <span class="input-group-append">
                                                        <button class="file-upload-browse btn btn-primary"
                                                            type="button">Browse</button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="submit" value="Unggah" class="btn btn-primary submit">
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php } else { ?>
                        <!-- Button trigger modal -->
                        <div class="col-md-12">
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#buktiPembayaran" style="width:100%;">
                                Lihat Bukti Pembayaran
                            </button>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="buktiPembayaran" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <img src="data:image;base64,<?= $result->tagihan[0]->bukti_pembayaran ?>"
                                            alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>