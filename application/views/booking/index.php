<?php
$user = $this->session->userdata('user');
?>
<div class="grid-margin">
        </div>
        <div class="row">
          <div class="col-12 col-xl-12 stretch-card">
            <div class="row flex-grow">
              <div class="col-md-12 grid-margin stretch-card">
                <div class="card bg-card">
                  <img src="<?php echo base_url(); ?>assets/images/bg.png" alt="background-image" class="bg-pemesan">
                  <div class="bg" style="background-image: url('assets/images/bg.png');"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- row -->

        <div class="booking-area">
          <div class="container">
            <div class="row">
              <div class="col-12">
                <form action="">
                  <div class="booking-wrap d-flex justify-content-between align-items-center" style="margin-top: -200px;">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Kota / Lokasi</label>
                        <select class="js-example-basic-single w-100">
                          <option value="TX">Jakarta</option>
                          <option value="NY">Bandung</option>
                          <option value="FL">Yogyakarta</option>
                          <option value="KN">Surabaya</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="Tanggal Penyewaan">Tanggal Penyewaan</label>
                        <input id="tglPenyewaan" class="form-control" name="tglPenyewaan" type="date">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Durasi</label>
                        <select class="js-example-basic-single w-100">
                          <option value="TX">Jam</option>
                          <option value="NY">Harian</option>
                          <option value="FL">Mingguan</option>
                          <option value="KN">Bulanan</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-3">
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
                        <a role="button" href="pages/pemesan/pencarian.html" class="btn btn-block btn-primary">Cari</a>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- booking area -->

        <div class="pilihan-ruangan">
          <div class="row">
            <div class="col-12">
              <div class="d-flex justify-content-center">
                <div class="judul">Pilihan kota dengan penyewaan terbanyak</div>
              </div>
            </div>
          </div>
          <div class="container">
            <div class="row">
              <div class="col-md-4">
                <div class="card text-white">
                  <img src="https://via.placeholder.com/410x251" class="card-img" alt="...">
                  <div class="card-img-overlay">
                    <h5 class="card-title text-white font-weight-bold">Jakarta</h5>
                    <p class="card-text">Last updated 3 mins ago</p>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card text-white">
                  <img src="https://via.placeholder.com/410x251" class="card-img" alt="...">
                  <div class="card-img-overlay">
                    <h5 class="card-title text-white font-weight-bold">Bandung</h5>
                    <p class="card-text">Last updated 3 mins ago</p>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card text-white">
                  <img src="https://via.placeholder.com/410x251" class="card-img" alt="...">
                  <div class="card-img-overlay">
                    <h5 class="card-title text-white font-weight-bold">Yogyakarta</h5>
                    <p class="card-text">Last updated 3 mins ago</p>
                  </div>
                </div>
              </div>  
            </div>
          </div>
        </div>
        <!-- pilihan ruangan -->

        <hr>

        <div class="pilihan-ruangan">
          <div class="row">
            <div class="col-12">
              <div class="d-flex justify-content-center">
                <div class="judul"><span class="text1">Working</span><span class="text2">Hub.</span> solusi bagi anda untuk dapatkan ruangan terbaik</div>
              </div>
            </div>
            <div class="col-12">
              <div class="d-flex justify-content-center">
                <div class="keterangan">WorkingHub. adalah aplikasi penyewaan ruangan berbasis online di Indonesia yang bisa menjadi pilihan terbaik Anda untuk menyewa ruangan di berbagai kota favorit.</div>
              </div>
            </div>
          </div>
        </div>
        <!-- tentang workinghub. -->