<?php
  $this->load->helper('form');
  $date = date('d-m-Y');
  $day  = date('d', strtotime('+1 day', strtotime($date)));
  $month = date('m', strtotime($date));
?>
        <div class="grid-margin">
        </div>
        <div class="carousel-img-ruangan">
          <div class="container">
            <div class="card">
              <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                <?php
                    if (!empty($result->ruangan[0]->gambar)) {
                        $data_gambar = explode(', ', $result->ruangan[0]->gambar);
                    }
                    
                    $cntDataGambar = count($data_gambar);
                    for ($i=0; $i < $cntDataGambar; $i++) {
                ?>
                  <div class="carousel-item <?php echo ($i==0) ? "active" : "" ?>">
                    <img src="data:image;base64,<?= $data_gambar[$i] ?>" class="d-block w-100" alt="..."  width="100%" height="600">
                  </div>
                <?php } ?>
                </div>
                <?php if ($cntDataGambar == 1) { } else { ?>
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>
                <?php } ?>
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
                <form action="<?php echo base_url(); ?>index.php/search/pemesanan/<?= $result->ruangan[0]->id_ruangan."/".$result->durasi ?>" method="post">
                  <div class="form-pemesanan-wrap d-flex justify-content-between align-items-center">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="Tanggal Penyewaan">Mulai Penyewaan</label>
                        <input id="tglPenyewaan" class="form-control" name="tglPenyewaan" type="date">
                        <small class="text-danger"><?= form_error('tglPenyewaan'); ?></small>
                      </div>
                    </div>
                    <?php
                    if ($result->durasi !== 'Jam') { ?>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="Tanggal Penyewaan">Jumlah <?= $result->durasi ?></label>
                        <input id="jmlDurasi" class="form-control" name="jmlDurasi" type="number">
                        <small class="text-danger"><?= form_error('jmlDurasi'); ?></small>
                      </div>
                    </div>
                    <?php } else { ?>

                    <?php } ?>
                    <div class="col-md-4">
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
                    <div class="col-md-9"></div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <input type="submit" value="Pesan Sekarang" id="pesan" class="btn btn-block btn-primary">
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
                    <p>Ukuran Ruangan : <?= $result->ruangan[0]->ukuran ?> m<sup>2</sup></p>
                    <p>kapasitas Ruangan : <?= $result->ruangan[0]->kapasitas ?> orang</p>
                  </div>
                  <hr>
                  <div class="title-detail"><strong>Deskripsi</strong></div>
                  <div class="content-detail">
                    <p><?= $result->ruangan[0]->deskripsi ?></p>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js" type="text/javascript"></script>
<script>
  let durasi = "<?= $result->durasi ?>";
  let id_ruangan = "<?= $result->ruangan[0]->id_ruangan ?>";
  let dd = "<?= $day ?>";
  let mm = "<?= $month ?>";

  $(document).ready( function() {
    console.log(durasi)
    if (durasi != 'Jam') {
      var today = new Date();
      // var dd = String(today.getDate() + 1).padStart(1, '0');
      // var mm = String(today.getMonth() + 1).padStart(2, '0');
      var yyyy = today.getFullYear();

      today = yyyy + '-' + mm + '-' + dd;
      console.log(dd)
      $('#tglPenyewaan').attr('min',today);
    }

    let jmlDurasi = 0;
    getHarga(durasi, jmlDurasi, id_ruangan);
    $("#pesan").prop("disabled",true);

    document.getElementById('jmlDurasi').addEventListener('focus', function() {
      $("#jmlDurasi").on("input", null, null, function(e) {
        if($("#jmlDurasi").val().length >= 1) {
          let jmlDurasi = $("#jmlDurasi").val();

          getHarga(durasi, jmlDurasi, id_ruangan);
          $("#pesan").prop("disabled",false);
        } else {
          let jmlDurasi = 0;
          getHarga(durasi, jmlDurasi, id_ruangan);
          $("#pesan").prop("disabled",true);
        }
      });
    });
  });
  
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
            let total_harga = jmlDurasi*harga;

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
  
  function rubah(angka){
    var reverse = angka.toString().split('').reverse().join(''),
    ribuan = reverse.match(/\d{1,3}/g);
    ribuan = ribuan.join('.').split('').reverse().join('');
    return ribuan;
 }
</script>