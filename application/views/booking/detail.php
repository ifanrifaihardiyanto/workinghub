
        <div class="grid-margin">
        </div>
        <?php
            // print_r($result->ruangan);

            // print_r($result->ruangan[0]->gambar);
        ?>
        <div class="carousel-img-ruangan">
          <div class="container">
            <div class="card">
              <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                <?php
                    if (!empty($result->ruangan[0]->gambar)) {
                        $data_gambar = explode(', ', $result->ruangan[0]->gambar);
                    }
                    // $no = 0;
                    $cntDataGambar = count($data_gambar);
                    for ($i=0; $i < $cntDataGambar; $i++) {
                ?>
                  <div class="carousel-item <?php echo ($i==0) ? "active" : "" ?>">
                    <img src="data:image;base64,<?= $data_gambar[$i] ?>" class="d-block w-100" alt="..."  width="100%" height="600">
                  </div>
                <?php } ?>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>
              </div>
              <div class="card-body">
                <h5 class="card-title"><?= $result->ruangan[0]->nama_gedung.' - '.$result->ruangan[0]->nama_ruangan ?></h5>
                <div class="row">
                  <div class="col-md-8">
                    <div class="d-flex justify-content-start">
                        <p class="p-1 card-tipe-ruangan"><?= $result->ruangan[0]->jenis_gedung ?></p>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="d-flex justify-content-end">
                      <a href="#" class="btn btn-info">Cek Ketersediaan</a>
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
                <form action="">
                  <div class="form-pemesanan-wrap d-flex justify-content-between align-items-center">
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
                        <label for="Tanggal Penyewaan">Mulai Penyewaan</label>
                        <input id="tglPenyewaan" class="form-control" name="tglPenyewaan" type="date">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="Tanggal Penyewaan">Selesai Penyewaan</label>
                        <input id="tglPenyewaan" class="form-control" name="tglPenyewaan" type="date">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="Jumlah Penyewa">Jumlah Penyewa</label>
                        <input id="jmlPenyewaan" class="form-control" name="jmlPenyewaan" type="text">
                      </div>
                    </div>
                    <div class="col-md-9"></div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <a role="button" href="pemesanan.html" class="btn btn-block btn-primary">Pesan Sekarang</a>
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
                    <p>Ukuran Ruangan : 100 m<sup>2</sup></p>
                    <p>kapasitas Ruangan : 20 orang</p>
                  </div>
                  <hr>
                  <div class="title-detail"><strong>Deskripsi</strong></div>
                  <div class="content-detail">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Tempus in ultrices facilisis sagittis tellus justo. Sociis elit bibendum blandit velit quis in semper praesent. Eget magna quis tortor velit elit, mattis augue sit. Adipiscing porttitor nunc facilisi sit nulla morbi at turpis dui. Blandit auctor integer egestas mauris varius est quam lobortis. Nec id volutpat urna consectetur viverra auctor non. Nunc tempor dignissim ipsum egestas. Consectetur lectus non, in vel, mauris gravida ultrices. Leo auctor quis ipsum morbi semper. Sagittis sit ac ante malesuada sed vehicula. Tristique a dignissim ornare sed porta purus lorem massa in. Sit fringilla hac dictumst eros neque. Vestibulum, elit dictum ultrices scelerisque arcu pretium sit pellentesque vestibulum. Faucibus viverra aliquam ultricies enim quis lacus.</p>
                  </div>
                  <hr>
                  <div class="title-detail"><strong>Fasilitas</strong></div>
                  <div class="content-detail d-flex">
                    <ul>
                      <li>AC</li>
                      <li>Wifi</li>
                      <li>Papan Tulis</li>
                    </ul>
                    <ul>
                      <li>Penyimpanan Barang</li>
                      <li>Proyektor</li>
                      <li>Kabel</li>
                    </ul>
                    <ul>
                      <li>Snack</li>
                    </ul>
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
                  <div class="card-review-ruangan d-flex justify-content-between">
                    <p class="p-2 user"><strong>Abdul</strong></p>
                    <p class="p-2 user-review">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Semper sagittis, bibendum risus sem lacus justo. Id metus aliquet tempor in. Tellus justo lectus convallis purus sit eu amet sed. Risus morbi diam nam amet pellentesque odio nisi nibh tincidunt. Sed justo, vitae, iaculis vel aliquam sit. Massa augue sit aliquam nisi, faucibus. Bibendum luctus eu urna lectus in dictumst.</p>
                  </div>
                  <div class="card-review-ruangan d-flex justify-content-between">
                    <p class="p-2 user"><strong>Abdul</strong></p>
                    <p class="p-2 user-review">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Semper sagittis, bibendum risus sem lacus justo. Id metus aliquet tempor in. Tellus justo lectus convallis purus sit eu amet sed. Risus morbi diam nam amet pellentesque odio nisi nibh tincidunt. Sed justo, vitae, iaculis vel aliquam sit. Massa augue sit aliquam nisi, faucibus. Bibendum luctus eu urna lectus in dictumst.</p>
                  </div>
                  <div class="card-review-ruangan d-flex justify-content-between">
                    <p class="p-2 user"><strong>Abdul</strong></p>
                    <p class="p-2 user-review">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Semper sagittis, bibendum risus sem lacus justo. Id metus aliquet tempor in. Tellus justo lectus convallis purus sit eu amet sed. Risus morbi diam nam amet pellentesque odio nisi nibh tincidunt. Sed justo, vitae, iaculis vel aliquam sit. Massa augue sit aliquam nisi, faucibus. Bibendum luctus eu urna lectus in dictumst.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>