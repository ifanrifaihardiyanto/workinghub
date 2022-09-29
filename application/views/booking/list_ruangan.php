                <?php
                    foreach($result->ruangan as $index => $r):
                        if ($r->durasi == 'Jam') {
                            $harga = $r->harga_jam;
                        } elseif ($r->durasi == 'Hari') {
                            $harga = $r->harga_harian;
                        } elseif ($r->durasi == 'Minggu') {
                            $harga = $r->harga_mingguan;
                        } else {
                            $harga = $r->harga_bulanan;
                        }
                ?>
                    <!-- <div class="col-md-12"> -->
                      <a href="<?php echo base_url(); ?>index.php/search/detail/<?= $r->id_ruangan.'/'.$r->durasi ?>" target="_blank">
                        <div class="list-ruangan">
                          <div class="card-ruangan">
                            <div class="card">
                              <div class="row">
                                <div class="col-md-4">
                                  <?php
                                    if (!empty($r->gambar)) {
                                      $data_gambar = explode(', ', $r->gambar);
                                    }

                                    $cntDataGambar = count($data_gambar);
                                    for ($i=0; $i < $cntDataGambar; $i++) { 
                                      if ($i == 0) {
                                  ?>
                                    <img src="data:image;base64,<?= $data_gambar[$i] ?>" width="100%" height="250">
                                  <?php
                                      }
                                    }
                                  ?>
                                </div>
                                <div class="col-md-5">
                                  <div class="card-body">
                                    <h5 class="card-title"><?= $r->nama_gedung.' - '.$r->nama_ruangan ?></h5>
                                    <div class="d-flex justify-content-start">
                                      <p class="p-1 card-tipe-ruangan"><?= $r->jenis_gedung ?></p>
                                    </div>
                                    <br>
                                    <p class="card-text">
                                      <iconify-icon icon="ci:location-outline" width="28" height="28"></iconify-icon> <?= $r->lokasi ?>
                                    </p>
                                    <p class="card-text">
                                      <iconify-icon icon="tabler:users" width="28" height="28"></iconify-icon> <?= $r->kapasitas ?> Orang
                                    </p>
                                    <p class="card-text">
                                        <iconify-icon icon="akar-icons:money" width="28" height="28"></iconify-icon> <strong><?= 'Rp '.number_format($harga,0,',','.').' / '.$r->durasi ?></strong>
                                    </p>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </a>
                    <!-- </div> -->
                  <?php endforeach; ?>
                  <?= $this->pagination->create_links(); ?>