<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Table</a></li>
        <li class="breadcrumb-item active" aria-current="page">Validasi Pembayaran</li>
    </ol>
</nav>

<?php
// print_r($penyewaan['data_penyewaan']);
?>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Data Pembayaran</h6>
                <div class="table-responsive">
                    <table id="dataTableExample" class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Pemesan</th>
                                <th>Email Pemesan</th>
                                <th>Nama Gedung</th>
                                <th>Nama Ruangan</th>
                                <th>Total Tagihan</th>
                                <!-- <th>Bukti Pembayaran</th> -->
                                <!-- <th>Status Pembayaran</th> -->
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($penyewaan['data_penyewaan'] as $index => $p) :
                            //   if ($p->status_bukti == '1') {
                            //     $bukti_status = "Sudah Membayar";
                            //     $st_bukti = "success";
                            //   } else {
                            //     $bukti_status = "Menunggu Pembayaran";
                            //     $st_bukti = "warning";
                            //   }

                              if ($p->aktivasi == '1') {
                                $aktivasi = "Aktif";
                                $st_aktivasi = "success";
                              } else {
                                $aktivasi = "Menunggu Validasi";
                                $st_aktivasi = "warning";
                              }
                            ?>
                            <tr>
                                <td><?= ++$index ?></td>
                                <td><?= $p->name ?></td>
                                <td><?= $p->email ?></td>
                                <td><?= $p->name ?></td>
                                <td><?= $p->name ?></td>
                                <td><?= 'Rp ' . number_format($p->total_pembayaran, 0, ',', '.') ?></td>
                                <!-- <td><button type="button" class="btn btn-info btn-icon" data-toggle="modal"
                                        data-target="#buktiPembayaran<?= $p->kode_pemesanan ?>"><i
                                            data-feather="eye"></i></button></td> -->
                                <!-- <td><span class="badge badge-<?= $st_bukti ?>"><?= $bukti_status ?></span></td> -->
                                <td>
                                    <button type="button" class="btn btn-primary btn-icon" data-toggle="modal"
                                        data-target="#aktif<?= $p->kode_pemesanan ?>"><i
                                            data-feather="check"></i></button>
                                    <button type="button" class="btn btn-danger btn-icon" data-toggle="modal"
                                        data-target="#nonaktif<?= $p->kode_pemesanan ?>"><i
                                            data-feather="x-circle"></i></button>
                                </td>
                            </tr>
                            <!-- Start Modal Bukti Pembayaran -->
                            <div class="modal fade" id="buktiPembayaran<?= $p->kode_pemesanan ?>" tabindex="-1"
                                role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Bukti Pembayaran</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <?php if ($p->bukti_pembayaran == '') { print_r('Data tidak ditemukan'); } else { ?>
                                            <img src="data:image;base64,<?= $p->bukti_pembayaran ?>" alt="">
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Modal Bukti Pembayaran -->
                            <!-- Start Modal Aktivasi -->
                            <div class="modal fade" id="aktif<?= $p->kode_pemesanan ?>" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Transaksi Penyewaan Ruangan
                                                Sesuai</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form
                                                action="<?php echo base_url(); ?>admin/managetransaksi/valid/<?= $p->id_pemesanan . '/' . $p->kode_pemesanan ?>"
                                                method="post" enctype="multipart/form-data">
                                                <div class="row">
                                                    <input id="perihal" class="form-control" name="perihal" type="text"
                                                        value="validasi transaksi" hidden>
                                                    <input id="validasi" class="form-control" name="validasi"
                                                        type="text" value="Validasi penyewaan sesuai" hidden>
                                                    <!-- <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <label class="control-label">Apa alasan anda, menghentikan
                                                                penyewaan ruangan ini?</label>
                                                            <textarea id="pemberhentian" name="pemberhentian"
                                                                class="form-control" maxlength="1000" rows="8"
                                                                placeholder=""></textarea>
                                                        </div>
                                                    </div> -->
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <label>Upload bukti pembayaran diteruskan ke
                                                                penyedia</label>
                                                            <input type="file" name="bukti_forward" id="bukti_forward"
                                                                class="file-upload-default">
                                                            <div class="input-group col-xs-12">
                                                                <input type="text" class="form-control file-upload-info"
                                                                    disabled="" placeholder="Upload Image"
                                                                    name="bukti_forward" id="bukti_forward">
                                                                <span class="input-group-append">
                                                                    <button class="file-upload-browse btn btn-primary"
                                                                        type="button">Browse</button>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- Row -->
                                        </div>
                                        <div class="modal-footer">
                                            <input type="submit" value="Simpan" class="btn btn-block btn-primary">
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- End Modal Aktivasi -->
                            <!-- Start Modal Non Aktivasi -->
                            <div class="modal fade" id="nonaktif<?= $p->kode_pemesanan ?>" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Transaksi Penyewaan Ruangan
                                                Tidak Sesuai</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form
                                                action="<?php echo base_url(); ?>admin/managetransaksi/invalid/<?= $p->id_pemesanan . '/' . $p->kode_pemesanan ?>"
                                                method="post" enctype="multipart/form-data">
                                                <div class="row">
                                                    <input id="perihal" class="form-control" name="perihal" type="text"
                                                        value="validasi transaksi" hidden>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <label class="control-label">Apa alasan anda, menghentikan
                                                                penyewaan ruangan ini?</label>
                                                            <textarea id="validasi" name="validasi" class="form-control"
                                                                maxlength="1000" rows="8" placeholder=""></textarea>
                                                            <small
                                                                class="text-danger"><?= form_error('validasi'); ?></small>
                                                        </div>
                                                    </div><!-- Col -->
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <label>Upload bukti pembayaran dikembalikan ke
                                                                pemesan</label>
                                                            <input type="file" name="bukti_pembalikkan"
                                                                id="bukti_pembalikkan" class="file-upload-default">
                                                            <div class="input-group col-xs-12">
                                                                <input type="text" class="form-control file-upload-info"
                                                                    disabled="" placeholder="Upload Image"
                                                                    name="bukti_pembalikkan" id="bukti_pembalikkan">
                                                                <span class="input-group-append">
                                                                    <button class="file-upload-browse btn btn-primary"
                                                                        type="button">Browse</button>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- Row -->
                                        </div>
                                        <div class="modal-footer">
                                            <input type="submit" value="Simpan" class="btn btn-block btn-primary">
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- End Modal Non Aktivasi -->
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>