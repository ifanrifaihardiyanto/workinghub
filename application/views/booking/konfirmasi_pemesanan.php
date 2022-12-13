<div class="grid-margin">
</div>

<div class="first-headline-page">
    <div class="container">
        <div class="headline-page">
            <?php
            // print_r($result->ruangan[0]);
            // print_r($data->profile[0]);
            if (!empty($result->ruangan[0]->image)) {
                $data_gambar = explode(', ', $result->ruangan[0]->image);
            }
            $cntDataGambar = count($data_gambar);
            for ($i = 0; $i < $cntDataGambar; $i++) {
                if ($i == 0) {
                    $data_gambar = explode('workinghub', $data_gambar[$i]);
                }
            }

            $tgl_now            = date('Y-m-d');
            $tgl_pemesanan      = date('d M Y', strtotime($result->tglPemesanan));
            $mulai_penyewaan    = date('d M Y', strtotime($result->mulaiPenyewaan));
            $tgl_sewa           = date('Y-m-d', strtotime($result->mulaiPenyewaan));
            $selesai_penyewaan  = date('d M Y', strtotime($result->selesaiPenyewaan));
            $tgl_end            = date('Y-m-d', strtotime($result->selesaiPenyewaan));
            ?>
            <div class="col-md-12 pd-btm-10">
                <div class="alert alert-success text-center" role="alert" id="notify"></div>
            </div>
            <div class="title-page">
                <h4>Mohon Review Pesanan Anda</h4>
            </div>
            <div class="desc-title pd-btm-10">Mohon periksa kembali pemesanan anda sebelum melanjutkan ke pembayaran.
            </div>
        </div>
        <div class="data-pemesanan">
            <div class="bd-example">
                <div class="">
                    <div class="pd-btm-20">
                        <div class="card">
                            <div class="card-body">
                                <h5>Data Pemesan</h5>
                                <div class="content-detail">
                                    <p><?= $data->profile[0]->name ?></p>
                                    <p><?= $data->profile[0]->no_tlp ?></p>
                                    <p><?= $data->profile[0]->email ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form id="payment-form" action="<?php echo base_url(); ?>payment/finish" method="post">
                        <div class="card">
                            <div class="d-flex justify-content-between">
                                <img src="<?php echo base_url(); ?><?= $data_gambar[1] ?>" alt="" style="width: 40%;">
                                <div class="card-body">
                                    <div class="detail-ruangan">
                                        <div>
                                            <strong><?= $result->ruangan[0]->name_gedung . ' - ' . $result->ruangan[0]->name_ruangan ?></strong>
                                        </div>
                                        <hr>
                                        <div class="d-flex justify-content-between">
                                            <p>Alamat</p>
                                            <p><?= $result->ruangan[0]->location ?></p>
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
                                            <p><?= $result->jmlDurasi . ' ' . $result->durasi ?></p>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <p>Kapasitas</p>
                                            <p><?= $result->ruangan[0]->capacity ?> Orang</p>
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
                        <div class="insert-form">
                            <input id="tglSekarang" class="form-control" name="tglSekarang" type="date"
                                value="<?= $tgl_now ?>" hidden>
                            <input id="tglPenyewaan" class="form-control" name="tglPenyewaan" type="date"
                                value="<?= $tgl_sewa ?>" hidden>
                            <input id="tglSelesai" class="form-control" name="tglSelesai" type="date"
                                value="<?= $tgl_end ?>" hidden>
                            <input id="tipeDurasi" class="form-control" name="tipeDurasi" type="text"
                                value="<?= $result->durasi ?>" hidden>
                            <input id="jmlDurasi" class="form-control" name="jmlDurasi" type="text"
                                value="<?= $result->jmlDurasi ?>" hidden>
                            <input id="id_gedung" class="form-control" name="id_gedung" type="text"
                                value="<?= $result->ruangan[0]->id_gedung ?>" hidden>
                            <input id="id_ruangan" class="form-control" name="id_ruangan" type="text"
                                value="<?= $result->ruangan[0]->id_ruangan ?>" hidden>
                            <input id="id_durasi" class="form-control" name="id_durasi" type="text"
                                value="<?= $result->ruangan[0]->id_durasi ?>" hidden>
                            <input id="id_penyedia" class="form-control" name="id_penyedia" type="text"
                                value="<?= $result->ruangan[0]->id_penyedia ?>" hidden>
                            <input id="id_user" class="form-control" name="id_user" type="text"
                                value="<?= $data->profile[0]->id ?>" hidden>
                            <input id="durasi" class="form-control" name="durasi" type="text"
                                value="<?= $result->durasi ?>" hidden>
                            <input id="harga" class="form-control" name="harga" type="text"
                                value="<?= $result->hidejmlHarga ?>" hidden>
                            <input id="name_ruangan" class="form-control" name="name_ruangan" type="text"
                                value="<?= $result->ruangan[0]->name_ruangan ?>" hidden>
                            <input id="name_gedung" class="form-control" name="name_gedung" type="text"
                                value="<?= $result->ruangan[0]->name_gedung ?>" hidden>
                            <input id="name" class="form-control" name="name" type="text"
                                value="<?= $data->profile[0]->name ?>" hidden>
                            <input id="no_tlp" class="form-control" name="no_tlp" type="text"
                                value="<?= $data->profile[0]->no_tlp ?>" hidden>
                            <input id="email" class="form-control" name="email" type="text"
                                value="<?= $data->profile[0]->email ?>" hidden>
                            <input type="hidden" name="result_type" id="result-type" value="">
                            <input type="hidden" name="result_data" id="result-data" value="">
                        </div>
                        <div class="d-flex justify-content-between width-30">
                            <input type="submit" value="Bayar" id="bayar" class="btn btn-block btn-primary">
                        </div>
                    </form>
                </div>
                <div class="detail-penyewaan">

                </div>

            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="SB-Mid-client-UdPVLV1xvAmz28eT"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script type="text/javascript">
$('#bayar').click(function(event) {
    event.preventDefault();
    // $(this).attr("disabled", "disabled");
    let harga = $("#harga").val();
    let tglPenyewaan = $("#tglPenyewaan").val();
    let tglSelesai = $("#tglSelesai").val();
    let tipeDurasi = $("#tipeDurasi").val();
    let jmlDurasi = $("#jmlDurasi").val();
    let id_gedung = $("#id_gedung").val();
    let id_ruangan = $("#id_ruangan").val();
    let id_durasi = $("#id_durasi").val();
    let id_penyedia = $("#id_penyedia").val();
    let id_user = $("#id_user").val();
    let name_ruangan = $("#name_ruangan").val();
    let name_gedung = $("#name_gedung").val();
    let name = $("#name").val();
    let no_tlp = $("#no_tlp").val();
    let email = $("#email").val();

    $.ajax({
        type: 'POST',
        url: '<?= site_url() ?>payment/token',
        cache: false,
        data: {
            "harga": harga,
            "tglPenyewaan": tglPenyewaan,
            "tglSelesai": tglSelesai,
            "tipeDurasi": tipeDurasi,
            "jmlDurasi": jmlDurasi,
            "id_gedung": id_gedung,
            "id_ruangan": id_ruangan,
            "id_durasi": id_durasi,
            "id_penyedia": id_penyedia,
            "id_user": id_user,
            "name_ruangan": name_ruangan,
            "name_gedung": name_gedung,
            "name": name,
            "no_tlp": no_tlp,
            "email": email,
        },
        success: function(data) {
            //location = data;

            let notifyHtml = '';

            notifyHtml += `Berhasil melakukan pemesanan!`

            $(`#notify`).html(notifyHtml);

            console.log('token = ' + data);

            var resultType = document.getElementById('result-type');
            var resultData = document.getElementById('result-data');

            function changeResult(type, data) {
                $("#result-type").val(type);
                $("#result-data").val(JSON.stringify(data));
                //resultType.innerHTML = type;
                //resultData.innerHTML = JSON.stringify(data);
            }

            snap.pay(data, {

                onSuccess: function(result) {
                    changeResult('success', result);
                    console.log(result.status_message);
                    console.log(result);
                    $("#payment-form").submit();
                },
                onPending: function(result) {
                    changeResult('pending', result);
                    console.log(result.status_message);
                    $("#payment-form").submit();
                },
                onError: function(result) {
                    changeResult('error', result);
                    console.log(result.status_message);
                    $("#payment-form").submit();
                }
            });
        }
    });
});
</script>