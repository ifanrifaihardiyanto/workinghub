<?php
$this->load->helper('form');
$error = $this->session->flashdata('error');
$success = $this->session->flashdata('success');

$date = date('d-m-Y');
$day  = date('d', strtotime('+1 day', strtotime($date)));
$month = date('m', strtotime($date));
?>
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
                // print_r($result->cancel_date);
                // print_r($result);

                // die;

                $tgl_pemesanan  = date('d M Y', strtotime($result->tagihan[0]->tgl_pemesanan));
                $tgl_penyewaan  = date('d M Y', strtotime($result->tagihan[0]->mulai_penyewaan));
                $tgl_selesai    = date('d M Y', strtotime($result->tagihan[0]->selesai_penyewaan));

                if ($result->tagihan[0]->kode_status == '200') {
                    if ($tgl_selesai < date('d M Y')) {
                        $bukti_status = "Penyewaan Selesai";
                        $st_bukti = "secondary";
                    } else {
                        $bukti_status = "Penyewaan Aktif";
                        $st_bukti = "success";
                    }
                } elseif ($result->tagihan[0]->kode_status == '202') {
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

                <div class="">
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
                    <div class="headline-page">

                        <div class=" card">
                            <div class="card-body">
                                <h6 class="card-title">Cancel Tanggal Penyewaan</h6>
                                <div class="alert alert-danger" role="alert">
                                    Tanggal cancel yang tersimpan tidak dapat diaktifkan dalam penyewaan kembali.
                                </div>
                                <form class="forms-sample" method="POST"
                                    action="<?php echo base_url(); ?>order/cancelPenyewaan/<?= $result->tagihan[0]->kode_pemesanan ?>">
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" name="id_ruangan" id="id_ruangan"
                                            value="<?= $result->tagihan[0]->id_ruangan ?>" hidden>
                                        <input type="text" class="form-control" name="durasi" id="durasi"
                                            value="<?= $result->tagihan[0]->tipe_durasi ?>" hidden>
                                        <div class="form-group">
                                            <!-- <label>Tanggal</label> -->
                                            <input type="text" class="form-control" name="tglCancel" id="tglCancel" />
                                        </div>
                                    </div>
                                    <!-- <input type="submit" value="Simpan" class="btn btn-primary mr-2"> -->
                                    <button type="button" class="btn btn-primary mr-2" data-toggle="modal"
                                        data-target="#delete">Simpan</button>

                                    <div class="modal fade" id="delete" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Batalkan Tanggal
                                                        Penyewaan
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div>Apakah anda yakin ingin membatalkan tanggal penyewaan ini?
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <!-- <a href="<?php echo base_url(); ?>order/cancelPenyewaan/<?= $result->tagihan[0]->kode_pemesanan ?>" type="button" class="btn btn-primary">Ya</a> -->
                                                    <input type="submit" value="Simpan" class="btn btn-primary mr-2">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <hr>
                                <?php if ($success) : ?>
                                <div class="alert alert-success alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert"
                                        aria-hidden="true">×</button>
                                    <?= $success; ?>
                                </div>
                                <?php endif; ?>
                                <h6 class="card-title">Data Tanggal Cancel</h6>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Tanggal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($result->cancel_date as $key => $dt) {
                                            ?>
                                            <tr>
                                                <td><?= ++$key ?></td>
                                                <td><?= $dt->cancel_date ?></td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="detail-penyewaan">

                </div>

            </div>
        </div>
    </div>
</div>

<script>
let dd = "<?= $day ?>";
let mm = "<?= $month ?>";

$(document).ready(function() {

    var today = new Date();
    var yyyy = today.getFullYear();

    today = mm + '/' + dd + '/' + yyyy;

    $('#tglCancel').daterangepicker({
        opens: 'right',
        minDate: today,
        singleDatePicker: true,
        autoApply: true,
    }, function(start, end, label) {
        let notif = '';
        var started = new Date(start.format('MM/DD/YYYY'));
        var ended = new Date(end.format('MM/DD/YYYY'));
        const diffTime = Math.abs(ended - started);
        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;
    });
});
</script>