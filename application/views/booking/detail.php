<?php
$this->load->helper('form');
$date = date('d-m-Y');
$day  = date('d', strtotime('+1 day', strtotime($date)));
$month = date('m', strtotime($date));

$date = [];
foreach ($result->activeOrderDate as $key) {
    $date = $key;
}
$activeOrderDate = implode(',', $date);
?>
<div class="grid-margin">
</div>
<div class="carousel-img-ruangan">
    <div class="container">
        <div class="card">
            <!-- <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <?php
                    // print_r($result->activeOrderDate);
                    // print_r($result->startHour);
                    // die;

                    if (!empty($result->ruangan[0]->image)) {
                        $data_gambar = explode(', ', $result->ruangan[0]->image);
                    }

                    $cntDataGambar = count($data_gambar);
                    for ($i = 0; $i < $cntDataGambar; $i++) {
                        $data_img = explode('workinghub', $data_gambar[$i]);
                    ?>
                    <div class="carousel-item <?php echo ($i == 0) ? "active" : "" ?>">
                        <img src="<?php echo base_url(); ?><?= $data_img[1] ?>" class="d-block w-100" alt="..."
                            width="100%" height="600">
                    </div>
                    <?php } ?>
                </div>
                <?php if ($cntDataGambar == 1) {
                } else { ?>
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
                <?php } ?>
            </div> -->

            <section class="">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="product__details__pic">
                                <div class="product__details__pic__left product__thumb nice-scroll">
                                    <?php
                                    // print_r($result->activeOrderDate);
                                    // print_r($result->startHour);
                                    // die;

                                    if (!empty($result->ruangan[0]->image)) {
                                        $data_gambar = explode(', ', $result->ruangan[0]->image);
                                    }

                                    $cntDataGambar = count($data_gambar);
                                    for ($i = 0; $i < $cntDataGambar; $i++) {
                                        $data_img = explode('workinghub', $data_gambar[$i]);
                                    ?>
                                    <a class="pt <?php echo ($i == 0) ? "active" : "" ?>" href="#<?= $data_img[1] ?>">
                                        <img src="<?php echo base_url(); ?><?= $data_img[1] ?>" alt="" />
                                    </a>
                                    <?php } ?>
                                </div>
                                <div class="product__details__slider__content">
                                    <div class="product__details__pic__slider owl-carousel">
                                        <?php
                                        $cntDataGambar = count($data_gambar);
                                        for ($i = 0; $i < $cntDataGambar; $i++) {
                                            $data_img = explode('workinghub', $data_gambar[$i]);
                                        ?>
                                        <img data-hash="<?= $data_img[1] ?>" class="product__big__img"
                                            src="<?php echo base_url(); ?><?= $data_img[1] ?>" alt="" />
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <div class="card-body">
                <h5 class="card-title">
                    <?= $result->ruangan[0]->name_gedung . ' - ' . $result->ruangan[0]->name_ruangan ?></h5>
                <div class="row">
                    <div class="col-md-8">
                        <div class="d-flex justify-content-start">
                            <p class="p-1 card-tipe-ruangan"><?= $result->ruangan[0]->type ?></p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex justify-content-end">
                            <!-- <a href="#" class="btn btn-info">Cek Ketersediaan</a> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card-form-pemesanan">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div id="notif"></div>
                <form
                    action="<?php echo base_url(); ?>index.php/search/pemesanan/<?= $result->ruangan[0]->id_ruangan . "/" . $result->durasi ?>"
                    method="post">
                    <div class="form-pemesanan-wrap d-flex justify-content-between align-items-center">
                        <div class="col-md-12">
                            <div id="notifHour"></div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Tanggal</label>
                                <input type="text" class="form-control" name="tglSewa" id="tglSewa" />
                            </div>
                        </div>
                        <?php
                        if ($result->durasi == 'Minggu') { ?>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="Tanggal Penyewaan">Jumlah <?= $result->durasi ?></label>
                                <input id="jmlDurasi" class="form-control" name="jmlDurasi" type="number">
                                <small class="text-danger"><?= form_error('jmlDurasi'); ?></small>
                            </div>
                        </div>
                        <?php } elseif ($result->durasi == 'Bulan') { ?>
                        <div class="form-group">
                            <label for="Tanggal Penyewaan">Jumlah <?= $result->durasi ?></label>
                            <input id="jmlDurasi" class="form-control" name="jmlDurasi" type="number">
                            <small class="text-danger"><?= form_error('jmlDurasi'); ?></small>
                        </div>
                        <?php } elseif ($result->durasi == 'Jam') { ?>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Jam Mulai</label>
                                <select class="js-example-basic-single w-100" name="startHour" id="startHour"
                                    onchange="changeFunc();">
                                    <?php foreach ($result->startHour as $startHour) : ?>
                                    <option value="<?= $startHour->hour ?>"
                                        <?= $startHour->hour == $startHour->hour ? 'selected' : '' ?>>
                                        <?= $startHour->hour ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <? } { ?>

                        <?php } ?>
                        <?php if ($result->durasi == 'Jam') { ?>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Jam Selesai</label>
                                <select class="js-example-basic-single w-100" name="endHour" id="endHour"
                                    onchange="changeFunc();">
                                    <?php foreach ($result->endHour as $endHour) : ?>
                                    <option value="<?= $endHour->hour ?>"
                                        <?= $endHour->hour == $endHour->hour ? 'selected' : '' ?>>
                                        <?= $endHour->hour ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <?php } ?>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Detail Harga</label>
                                <div class="d-flex justify-content-between">
                                    <div class="rincian-pemesanan">
                                        <div id="rincian"></div>
                                    </div>
                                    <div class="total-pemesanan">
                                        <div id="hasil"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-md-9"></div> -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="submit" value="Pesan Sekarang" id="pesan"
                                    class="btn btn-block btn-primary">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="detail-ruangan">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="detail-ruangan-wrap">
                    <div class="title-detail"><strong>Ukuran dan Kapasitas</strong></div>
                    <div class="content-detail">
                        <p>Ukuran Ruangan : <?= $result->ruangan[0]->size ?> m<sup>2</sup></p>
                        <p>kapasitas Ruangan : <?= $result->ruangan[0]->capacity ?> orang</p>
                    </div>
                    <hr>
                    <div class="title-detail"><strong>Deskripsi</strong></div>
                    <div class="content-detail">
                        <p><?= $result->ruangan[0]->description ?></p>
                    </div>
                    <hr>
                    <div class="title-detail"><strong>Fasilitas</strong></div>
                    <div class="content-detail d-flex">
                        <?php
                        $fasilitas = explode(', ', $result->ruangan[0]->facility);

                        foreach ($fasilitas as $item) {
                        ?>
                        <ul>
                            <li><?= $item ?></li>
                        </ul>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="review">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="review-wrap">
                    <div class="title-detail"><strong>Review</strong></div>
                    <?php
                    if (count($result->reviews) === 0) {
                    ?>
                    <div class="col-md-12">
                        <div class="alert alert-light text-center" role="alert">Review tidak ditemukan</div>
                    </div>
                    <?php
                    }

                    foreach ($result->reviews as $item) {
                    ?>
                    <div class="card-review-ruangan d-flex justify-content-between">
                        <p class="p-2 user"><strong><?= $item->name ?></strong></p>
                        <p class="p-2 user-review"><?= $item->review ?></p>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://js.pusher.com/7.2/pusher.min.js"></script>
<script>

</script>
<script>
let durasi = "<?= $result->durasi ?>";
let id_ruangan = "<?= $result->ruangan[0]->id_ruangan ?>";
let dd = "<?= $day ?>";
let mm = "<?= $month ?>";
let invalidDate = [];
let disabledArr = [<?= $activeOrderDate ?>];



$(document).ready(function() {
    // $("select.startHour").change(function() {
    //     var selectedCountry = $(this).children("option:selected").val();
    //     alert("You have selected the country - " + selectedCountry);
    // });
    // console.log(durasi)
    // console.log(jmlDurasi)

    changeFunc();

    var today = new Date();
    var yyyy = today.getFullYear();

    today = mm + '/' + dd + '/' + yyyy;

    let diffDays = 0;

    getDate(today);

    getHarga(durasi, diffDays, id_ruangan);

    $("#pesan").prop("disabled", true);

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('c14531a571ba79886871', {
        cluster: 'ap1'
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
        getDate();
    });

    document.getElementById('jmlDurasi').addEventListener('focus', function() {
        $("#jmlDurasi").on("input", null, null, function(e) {
            if ($("#jmlDurasi").val().length >= 1) {
                let diffDays = $("#jmlDurasi").val();
                getHarga(durasi, diffDays, id_ruangan);
                $("#pesan").prop("disabled", false);
            } else {
                let diffDays = 0;
                getHarga(durasi, diffDays, id_ruangan);
                $("#pesan").prop("disabled", true);
            }
        });
    });

});

function changeFunc() {
    const startHour = $("#startHour option:selected").val();
    const endHour = $("#endHour option:selected").val();
    let textHtmlNotif = '';

    let replaceStart = startHour.replace('.', '');
    let replaceEnd = endHour.replace('.', '');

    let diffHours = replaceEnd - replaceStart;

    let lengthStr = diffHours.toString().length;

    if (lengthStr > 2) {
        let getStr = diffHours.toString().search('70');
        let getStrFront = diffHours.toString().slice(0, 1);

        if (getStr == 1) {
            getStrFront += '.5';
        }

        let resultDiff = getStrFront;

        console.log(resultDiff);

        $("#pesan").prop("disabled", false);

        getHarga(durasi, resultDiff, id_ruangan);

    } else {
        textHtmlNotif += `<div class="col-md-12 pd-btm-10">
                        <div class="alert alert-warning text-center" role="alert">Minimal durasi pemesanan 1 jam!</div>
                    </div>`;

        $("#pesan").prop("disabled", true);
    }

    $('#notifHour')[0].innerHTML = textHtmlNotif;
}

function getDate(today) {
    $.ajax({
        type: "GET",
        dataType: "JSON",
        url: '<?php echo base_url() . "index.php/order/isOrderDate" ?>',
        data: {
            "id_ruangan": id_ruangan,
            "durasi": durasi,
        },
        success: (response) => {
            let activeRentDate = Object.values(response.date);
            let activeRentHour = Object.values(response.hour);
            console.log(response);

            if (durasi == 'Hari') {

                $('#tglSewa').daterangepicker({
                    opens: 'right',
                    minDate: today,
                    isInvalidDate: function(arg) {
                        // console.log(arg);

                        // Prepare the date comparision
                        var thisMonth = arg._d.getMonth() + 1;
                        // Months are 0 based
                        if (thisMonth < 10) {
                            thisMonth = "0" + thisMonth; // Leading 0
                        }
                        var thisDate = arg._d.getDate();
                        if (thisDate < 10) {
                            thisDate = "0" + thisDate; // Leading 0
                        }
                        var thisYear = arg._d.getYear() + 1900;
                        // Years are 1900 based

                        var thisCompare = thisMonth + "/" + thisDate + "/" +
                            thisYear;
                        // console.log(thisCompare);

                        if ($.inArray(thisCompare, activeRentDate) != -1) {
                            // console.log("      ^--------- DATE FOUND HERE");
                            return true;
                        }
                    }
                }, function(start, end, label) {
                    let notif = '';
                    var started = new Date(start.format('MM/DD/YYYY'));
                    var ended = new Date(end.format('MM/DD/YYYY'));
                    const diffTime = Math.abs(ended - started);
                    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 *
                        24)) + 1;
                    getHarga(durasi, diffDays, id_ruangan);
                    $("#pesan").prop("disabled", false);
                });

            }

            if (durasi == 'Minggu' || durasi == 'Bulan') {
                $('#tglSewa').daterangepicker({
                    opens: 'right',
                    minDate: today,
                    singleDatePicker: true,
                    autoApply: true,
                    isInvalidDate: function(arg) {
                        // console.log(arg);

                        // Prepare the date comparision
                        var thisMonth = arg._d.getMonth() +
                            1; // Months are 0 based
                        if (thisMonth < 10) {
                            thisMonth = "0" + thisMonth; // Leading 0
                        }
                        var thisDate = arg._d.getDate();
                        if (thisDate < 10) {
                            thisDate = "0" + thisDate; // Leading 0
                        }
                        var thisYear = arg._d.getYear() +
                            1900; // Years are 1900 based

                        var thisCompare = thisMonth + "/" + thisDate + "/" +
                            thisYear;
                        // console.log(thisCompare);

                        if ($.inArray(thisCompare, activeRentDate) != -1) {
                            // console.log("      ^--------- DATE FOUND HERE");
                            return true;
                        }
                    }
                }, function(start, end, label) {
                    let notif = '';
                    var started = new Date(start.format('MM/DD/YYYY'));
                    var ended = new Date(end.format('MM/DD/YYYY'));
                    const diffTime = Math.abs(ended - started);
                    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 *
                        24)) + 1;
                });
            }

            if (durasi == 'Jam') {
                $('#tglSewa').daterangepicker({
                    opens: 'right',
                    minDate: today,
                    singleDatePicker: true,
                    autoApply: true
                }, function(start, end, label) {
                    let notif = '';
                    var started = new Date(start.format('MM/DD/YYYY'));
                    var ended = new Date(end.format('MM/DD/YYYY'));
                    const diffTime = Math.abs(ended - started);
                    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 *
                        24)) + 1;
                });

                activeRentHour.forEach(entry => {
                    $("#startHour option:contains( " + entry + ")").attr("disabled", "disabled");
                });

                activeRentHour.forEach(entry => {
                    $("#endHour option:contains( " + entry + ")").attr("disabled", "disabled");
                });

            }
        }
    });
}

// const data = ["08", "09"];
// data.forEach(entry => {
//     $("#endHour option:contains( " + entry + ")").attr("disabled", "disabled");
// });

function getHarga(durasi, jmlDurasi, id_ruangan) {
    $(document).ready(() => {
        $.ajax({
            type: "POST",
            url: '<?php echo base_url() . "index.php/search/get_RincianHarga" ?>',
            data: {
                "id_ruangan": id_ruangan,
                "durasi": durasi,
                "jmlDurasi": jmlDurasi
            },
            success: (response) => {
                let textHtmlRincian = '';
                let textHtmlHasil = '';

                $.each(response.data, (hrga, items) => {
                    let harga = items.harga;
                    let total_harga = jmlDurasi * harga;

                    textHtmlRincian += `<div>${jmlDurasi} ${durasi} x Rp ${rubah(harga)}</div>
            <input type="text" class="form-control" id="hidejmlDurasi" name="hidejmlDurasi" value="${jmlDurasi}" hidden>
            `;

                    textHtmlHasil += `Rp ${rubah(total_harga)}
            <input type="text" class="form-control" id="hidejmlHarga" name="hidejmlHarga" value="${total_harga}" hidden>
            `;

                });

                $('#rincian')[0].innerHTML = textHtmlRincian;
                $('#hasil')[0].innerHTML = textHtmlHasil;
            }
        });
    });
}

function rubah(angka) {
    var reverse = angka.toString().split('').reverse().join(''),
        ribuan = reverse.match(/\d{1,3}/g);
    ribuan = ribuan.join('.').split('').reverse().join('');
    return ribuan;
}
</script>