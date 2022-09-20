<?php
// print_r($result->ruangan);
$nama_lokasi = $this->session->userdata('nama_lokasi');
?>
<div class="grid-margin">
        </div>
        
        <div class="pencarian_list">
          <div class="booking-area pencarian">
            <div class="container">
              <div class="row">
                <div class="col-12">
                  <form action="<?php echo base_url(); ?>index.php/search/find" method="post">
                    <div class="booking-wrap d-flex justify-content-between align-items-center">
                    <div class="col-md-6">
                      <div class="form-group">
                        <?php
                          // print_r($search['lokasi']);
                          print_r($nama_lokasi);
                        ?>
                        <label>Kota / Lokasi</label>
                        <select class="js-example-basic-single w-100" name="lokasi" id="lokasi">
                        <?php foreach ($search['lokasi'] as $lokasi) : ?>
                          <option value="<?= $lokasi->lokasi ?>" <?= $nama_lokasi == $lokasi->lokasi ? 'selected' : '' ?>><?= $lokasi->lokasi ?></option>
                        <?php endforeach; ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Kapasitas</label>
                        <select class="js-example-basic-single w-100">
                          <option value="KN">Semua Kapasitas</option>
                          <option value="TX">1 - 5 Orang</option>
                          <option value="NY">6 - 10 Orang</option>
                          <option value="FL">11 - 20 Orang</option>
                          <option value="KN">21 - 30 Orang</option>
                          <option value="TX">31 - 50 Orang</option>
                          <option value="NY">51 - 100 Orang</option>
                          <option value="FL">100+ Orang</option>
                        </select>
                      </div>
                    </div>
                      <div class="col-md-9"></div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <!-- <a role="button" href="pencarian.html" class="btn btn-block btn-primary">Ubah Pencarian</a> -->
                          <input type="submit" value="Ubah Pencarian" class="btn btn-block btn-primary">
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- booking area -->
          <div class="filter-bar">
            <div class="container">
              <div class="row">
                <div class="col-md-12">
                  <form action="">
                    <div class="booking-wrap d-flex align-items-center">
                      <div class="col-md-1">
                        <label>Filter :</label>
                      </div>
                      <div class="col-md-2">
                        <div class="dropdown">
                          <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Urutkan
                          </button>
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton3">
                            <h6 class="dropdown-header">Urutkan berdasarkan harga</h6>
                            <div class="form-group">
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios" value="option1">
                                  Harga Terendah
                                </label>
                              </div>
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios1" value="option1">
                                  Harga Tertinggi
                                </label>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="dropdown">
                          <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Tipe Gedung
                          </button>
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton3">
                            <h6 class="dropdown-header">Pilih tipe gedung</h6>
                            <div class="form-group">
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios" value="option1">
                                  All
                                </label>
                              </div>
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios1" value="option1">
                                  Hotel
                                </label>
                              </div>
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input type="radio" class="form-check-input" name="optionsRadios2" id="optionsRadios2" value="option2" checked="">
                                  Co-Working Space
                                </label>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="dropdown">
                          <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Harga
                          </button>
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton3">
                            <h6 class="dropdown-header">Pilih rentang harga</h6>
                            <a class="dropdown-item" href="#">All</a>
                            <a class="dropdown-item" href="#">Hotel</a>
                            <a class="dropdown-item" href="#">Co-Working Space</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
                <div class="row">
                  <?php foreach($result->ruangan as $index => $r): ?>
                  <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                        <h6 class="card-title">Data Ruangan</h6>
                        <div><?= $r->nama_ruangan ?></div>
                        <!-- <div id="datatables"></div> -->
                      </div>
                    </div>
                  </div>
                  <?php endforeach; ?>
                  <?= $this->pagination->create_links(); ?>
                </div>
                <!-- <div class="row">
                  <div id="dataRuangan"></div>
                </div> -->
              </div>
              <!-- <div id="pagination"></div> -->
            </div>
          </div>
          <!-- filter bar -->
        </div>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script>
    $(document).ready(() => {
      let lokasi = $("#lokasi option:selected").text();
      console.log(lokasi)

      getDataRuangan(lokasi);
    });

    function getDataRuangan(lokasi) {

        $(document).ready(() => {
            $.ajax({
                type: "POST",
                url: '<?php echo base_url() . "index.php/search/get_Ruangan" ?>',
                data: {
                  "lokasi": lokasi
                },
                success: (response) => {

                    console.log(response.pagination);
                    let textHtml = '';

                    let keys = Object.keys(response.data);
                    console.log(keys);


                    if (response.data && keys.length !== 0) {
                        $.each(response.data, (index, items) => {
                          // console.log(items);

                          textHtml +=`
                          <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                              <div class="card-body">
                                <h6 class="card-title">Data Ruangan</h6>
                                <div>${items.nama_ruangan}</div>
                                <div id="datatables"></div>
                              </div>
                            </div>
                          </div>
                          `
                        });
                    } else {
                    }

                    $('#dataRuangan')[0].innerHTML = textHtml;
                    $('#pagination').html(response.pagination);
                }
            });
        });
    }
</script>