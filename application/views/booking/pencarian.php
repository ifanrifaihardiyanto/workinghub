<?php
$nama_lokasi  = $this->session->userdata('nama_lokasi');
$durasi       = $this->session->userdata('durasi');
$kapasitas    = $this->session->userdata('kapasitas');
?>
<div class="grid-margin">
</div>

<div class="pencarian_list">
    <div class="booking-area pencarian">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- <form action="<?php echo base_url(); ?>index.php/search/find" method="post"> -->
                    <?php
                    // var_dump($search['lokasi']);
                    ?>
                    <div class="booking-wrap d-flex justify-content-between align-items-center">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Kota / Lokasi</label>
                                <select class="js-example-basic-single w-100" name="lokasi" id="lokasi">
                                    <?php foreach ($search['lokasi'] as $lokasi) : ?>
                                    <option value="<?= $lokasi->lokasi ?>"
                                        <?= $nama_lokasi == $lokasi->lokasi ? 'selected' : '' ?>><?= $lokasi->lokasi ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Durasi</label>
                                <select class="js-example-basic-single w-100" name="durasi" id="durasi">
                                    <option value="%" <?= $durasi == '%' ? 'selected' : '' ?>>Semua Durasi</option>
                                    <option value="Jam" <?= $durasi == 'Jam' ? 'selected' : '' ?>>Jam</option>
                                    <option value="Hari" <?= $durasi == 'Hari' ? 'selected' : '' ?>>Hari</option>
                                    <option value="Minggu" <?= $durasi == 'Minggu' ? 'selected' : '' ?>>Minggu</option>
                                    <option value="Bulan" <?= $durasi == 'Bulan' ? 'selected' : '' ?>>Bulan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Kapasitas</label>
                                <select class="js-example-basic-single w-100" name="kapasitas" id="kapasitas">
                                    <option value="%" <?= $kapasitas == '%' ? 'selected' : '' ?>>Semua Kapasitas
                                    </option>
                                    <option value="1 - 5" <?= $kapasitas == '1 - 5' ? 'selected' : '' ?>>1 - 5 Orang
                                    </option>
                                    <option value="6 - 10" <?= $kapasitas == '6 - 10' ? 'selected' : '' ?>>6 - 10 Orang
                                    </option>
                                    <option value="11 - 20" <?= $kapasitas == '11 - 20' ? 'selected' : '' ?>>11 - 20
                                        Orang</option>
                                    <option value="21 - 30" <?= $kapasitas == '21 - 30' ? 'selected' : '' ?>>21 - 30
                                        Orang</option>
                                    <option value="31 - 50" <?= $kapasitas == '31 - 50' ? 'selected' : '' ?>>31 - 50
                                        Orang</option>
                                    <option value="51 - 100" <?= $kapasitas == '51 - 100' ? 'selected' : '' ?>>51 - 100
                                        Orang</option>
                                    <option value="100" <?= $kapasitas == '100' ? 'selected' : '' ?>>100+ Orang</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-9"></div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <input id="filterButton" type="submit" value="Ubah Pencarian"
                                    class="btn btn-block btn-primary" onclick="onFilterSubmitted()">
                            </div>
                        </div>
                    </div>
                    <!-- </form> -->
                </div>
            </div>
        </div>
    </div>
    <!-- booking area -->
    <div class="filter-bar">
        <div class="container">
            <div class="row">
                <div class="">
                    <!-- <form action=""> -->
                    <div class="booking-wrap d-flex justify-content-between align-items-center">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Filter</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Kota / Lokasi</label>
                                <!-- <select class="js-example-basic-single w-100" name="lokasi" id="lokasi">
                                    <?php foreach ($search['lokasi'] as $lokasi) : ?>
                                    <option value="<?= $lokasi->lokasi ?>"
                                        <?= $nama_lokasi == $lokasi->lokasi ? 'selected' : '' ?>><?= $lokasi->lokasi ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select> -->
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Durasi</label>
                                <!-- <select class="js-example-basic-single w-100" name="durasi" id="durasi">
                                    <option value="%" <?= $durasi == '%' ? 'selected' : '' ?>>Semua Durasi</option>
                                    <option value="Jam" <?= $durasi == 'Jam' ? 'selected' : '' ?>>Jam</option>
                                    <option value="Hari" <?= $durasi == 'Hari' ? 'selected' : '' ?>>Hari</option>
                                    <option value="Minggu" <?= $durasi == 'Minggu' ? 'selected' : '' ?>>Minggu</option>
                                    <option value="Bulan" <?= $durasi == 'Bulan' ? 'selected' : '' ?>>Bulan</option>
                                </select> -->
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Kapasitas</label>
                                <!-- <select class="js-example-basic-single w-100" name="kapasitas" id="kapasitas">
                                    <option value="%" <?= $kapasitas == '%' ? 'selected' : '' ?>>Semua Kapasitas
                                    </option>
                                    <option value="1 - 5" <?= $kapasitas == '1 - 5' ? 'selected' : '' ?>>1 - 5 Orang
                                    </option>
                                    <option value="6 - 10" <?= $kapasitas == '6 - 10' ? 'selected' : '' ?>>6 - 10 Orang
                                    </option>
                                    <option value="11 - 20" <?= $kapasitas == '11 - 20' ? 'selected' : '' ?>>11 - 20
                                        Orang</option>
                                    <option value="21 - 30" <?= $kapasitas == '21 - 30' ? 'selected' : '' ?>>21 - 30
                                        Orang</option>
                                    <option value="31 - 50" <?= $kapasitas == '31 - 50' ? 'selected' : '' ?>>31 - 50
                                        Orang</option>
                                    <option value="51 - 100" <?= $kapasitas == '51 - 100' ? 'selected' : '' ?>>51 - 100
                                        Orang</option>
                                    <option value="100" <?= $kapasitas == '100' ? 'selected' : '' ?>>100+ Orang</option>
                                </select> -->
                            </div>
                        </div>
                    </div>
                    <!-- </form> -->
                </div>
                <div class="col-md-12">
                    <div id="dataRuangan"></div>
                </div>
            </div>
            <!-- <?= $this->pagination->create_links(); ?> -->
            <div id="pagination"></div>
        </div>
    </div>
    <!-- filter bar -->
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js" type="text/javascript"></script>
<script>
$(document).ready(() => {
    onFilterSubmitted();
});

function onFilterSubmitted() {
    getDataRuangan(page_url = false);
    // var select = document.querySelector('input[type=radio][name="urut_harga"]').value;

    $(document).on('click', ".pagination li a", function() {
        var page_url = $(this).attr('href');
        getDataRuangan(page_url);
        return false;
    })
}

function getDataRuangan(page_url) {
    let lokasi = $("#lokasi option:selected").val();
    let kapasitas = $("#kapasitas option:selected").val();
    let durasi = $("#durasi option:selected").val();

    console.log(lokasi);

    var base_url = '<?php echo base_url() . "index.php/search/get_Ruangan" ?>';

    if (page_url) {
        base_url = page_url;
    }

    $(document).ready(() => {
        $.ajax({
            type: "POST",
            url: base_url,
            data: {
                "lokasi": lokasi,
                "kapasitas": kapasitas,
                "durasi": durasi
            },
            success: (response) => {
                $('#dataRuangan').html(response);
            }
        });
    });
}
</script>