<div class="grid-margin">
        </div>

        <div class="first-headline-page">
          <div class="container">
            <div class="headline-page">
              <div class="title-page"><h4>Metode Pembayaran</h4></div>
              <div class="desc-title pd-btm-10">Pilih metode pembayaran transfer bank yang tersedia</div>
            </div>
            <?php
                // print_r($data);
                $tgl_now            = date('Y-m-d');
                $tgl_pemesanan      = date('d M Y', strtotime($result->tglPemesanan));
                $mulai_penyewaan    = date('d M Y', strtotime($result->mulaiPenyewaan));
                $tgl_sewa           = date('Y-m-d', strtotime($result->mulaiPenyewaan));
                $selesai_penyewaan  = date('d M Y', strtotime($result->selesaiPenyewaan));
                $tgl_end            = date('Y-m-d', strtotime($result->selesaiPenyewaan));
                $kode_pemesanan     = strtoupper("WH-".random_string('alnum',8));
            ?>
            <div class="data-pemesanan">
              <div class="bd-example">
                <div class="d-flex justify-content-between">
                  <div class="detail-pemesan">
                    <div class="card">
                      <div class="card-body">
                        <h5>Transfer Bank (Verifikasi Manual)</h5>
                        <div class="row">
                          <div class="col-md-12">
                            <hr>
                            <div class="bank bank-bni">
                              <div class="d-flex justify-content-between" data-toggle="modal" data-target="#modalBNI">
                                <img src="../../assets/images/logo_bank_bni.png" alt="logo bank bni">
                                <div>Transfer Bank BNI</div>
                              </div>
                            </div>
                            <!-- Modal Bank BNI -->
                            <div class="modal fade" id="modalBNI" tabindex="-1" role="dialog" aria-labelledby="modalBNI" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalCenterTitle">Pembayaran</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <form action="<?php echo base_url(); ?>index.php/search/tagihan" method="post">
                                    <div class="total-pembayaran pd-btm-10">
                                      <div class="d-flex justify-content-between">
                                        <div>Total tagihan</div>
                                        <div><?= 'Rp '.number_format($result->hidejmlHarga,0,',','.') ?></div>
                                      </div>
                                    </div>
                                    <div class="nama-bank">
                                      <div class="d-flex justify-content-between">
                                        <div>Transfer Bank BNI</div>
                                        <img src="../../assets/images/logo_bank_bni.png" alt="Bank BNI">
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-md-12">
                                        <div class="form-group">
                                          <label for="Nomor Rekening">Nomor Rekening</label>
                                          <input id="nmrRekening" class="form-control" name="nmrRekening" type="number" value="<?= $data->profile[0]->rek_bni ?>" disabled>
                                          <input id="nmrRekening" class="form-control" name="nmrRekening" type="number" value="<?= $data->profile[0]->rek_bni ?>" hidden>
                                        </div>
                                      </div>
                                      <div class="col-md-12">
                                        <div class="form-group">
                                          <label for="Nomor Rekening">Nama Pemilik</label>
                                          <input id="nmPemilik" class="form-control" name="nmPemilik" type="text" value="<?= $data->profile[0]->nama ?>" disabled>
                                          <input id="nmPemilik" class="form-control" name="nmPemilik" type="text" value="<?= $data->profile[0]->nama ?>" hidden>
                                        </div>
                                      </div>
                                        <input id="jmlDurasi" class="form-control" name="jmlDurasi" type="text" value="<?= $result->jmlDurasi ?>" hidden>
                                        <input id="durasi" class="form-control" name="durasi" type="text" value="<?= $result->durasi ?>" hidden>
                                        <input id="id_ruangan" class="form-control" name="id_ruangan" type="text" value="<?= $result->ruangan[0]->id_ruangan ?>" hidden>
                                        <input id="tglSekarang" class="form-control" name="tglSekarang" type="date" value="<?= $tgl_now ?>" hidden>
                                        <input id="tglPenyewaan" class="form-control" name="tglPenyewaan" type="date" value="<?= $tgl_sewa ?>" hidden>
                                        <input id="tglSelesai" class="form-control" name="tglSelesai" type="date" value="<?= $tgl_end ?>" hidden>
                                        <input id="harga" class="form-control" name="harga" type="text" value="<?= $result->hidejmlHarga ?>" hidden>
                                        <input id="kode_pemesanan" class="form-control" name="kode_pemesanan" type="text" value="<?= $kode_pemesanan ?>" hidden>
                                        <input id="metode_transfer" class="form-control" name="metode_transfer" type="text" value="Transfer Bank BNI" hidden>
                                      <div class="col-md-12">
                                        <div class="form-group">
                                          <input type="submit" value="Bayar" class="btn btn-block btn-primary">
                                        </div>
                                      </div>
                                    </div>
                                    </form>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <!-- Modal Bank BNI -->
                          </div>
                          <div class="col-md-12">
                            <hr>
                            <div class="bank bank-bri">
                              <div class="d-flex justify-content-between" data-toggle="modal" data-target="#modalBRI">
                                <img src="../../assets/images/logo_bank_bri.png" alt="logo bank bri">
                                <div>Transfer Bank BRI</div>
                              </div>
                            </div>
                            <!-- Modal Bank BRI -->
                            <div class="modal fade" id="modalBRI" tabindex="-1" role="dialog" aria-labelledby="modalBRI" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalCenterTitle">Pembayaran</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                  <form action="<?php echo base_url(); ?>index.php/search/tagihan" method="post">
                                    <div class="total-pembayaran pd-btm-10">
                                      <div class="d-flex justify-content-between">
                                        <div>Total tagihan</div>
                                        <div><?= 'Rp '.number_format($result->hidejmlHarga,0,',','.') ?></div>
                                      </div>
                                    </div>
                                    <div class="nama-bank">
                                      <div class="d-flex justify-content-between">
                                        <div>Transfer Bank BRI</div>
                                        <img src="../../assets/images/logo_bank_bri.png" alt="Bank BRI">
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-md-12">
                                        <div class="form-group">
                                          <label for="Nomor Rekening">Nomor Rekening</label>
                                          <input id="nmrRekening" class="form-control" name="nmrRekening" type="number" value="<?= $data->profile[0]->rek_bri ?>" disabled>
                                          <input id="nmrRekening" class="form-control" name="nmrRekening" type="number" value="<?= $data->profile[0]->rek_bri ?>" hidden>
                                        </div>
                                      </div>
                                      <div class="col-md-12">
                                        <div class="form-group">
                                          <label for="Nomor Rekening">Nama Pemilik</label>
                                          <input id="nmPemilik" class="form-control" name="nmPemilik" type="text" value="<?= $data->profile[0]->nama ?>" disabled>
                                          <input id="nmPemilik" class="form-control" name="nmPemilik" type="text" value="<?= $data->profile[0]->nama ?>" hidden>
                                        </div>
                                      </div>
                                        <input id="jmlDurasi" class="form-control" name="jmlDurasi" type="text" value="<?= $result->jmlDurasi ?>" hidden>
                                        <input id="durasi" class="form-control" name="durasi" type="text" value="<?= $result->durasi ?>" hidden>
                                        <input id="id_ruangan" class="form-control" name="id_ruangan" type="text" value="<?= $result->ruangan[0]->id_ruangan ?>" hidden>
                                        <input id="tglSekarang" class="form-control" name="tglSekarang" type="date" value="<?= $tgl_now ?>" hidden>
                                        <input id="tglPenyewaan" class="form-control" name="tglPenyewaan" type="date" value="<?= $tgl_sewa ?>" hidden>
                                        <input id="tglSelesai" class="form-control" name="tglSelesai" type="date" value="<?= $tgl_end ?>" hidden>
                                        <input id="harga" class="form-control" name="harga" type="text" value="<?= $result->hidejmlHarga ?>" hidden>
                                        <input id="kode_pemesanan" class="form-control" name="kode_pemesanan" type="text" value="<?= $kode_pemesanan ?>" hidden>
                                        <input id="metode_transfer" class="form-control" name="metode_transfer" type="text" value="Transfer Bank BRI" hidden>
                                      <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="submit" value="Bayar" class="btn btn-block btn-primary">
                                        </div>
                                      </div>
                                    </div>
                                    </form>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <!-- Modal Bank BRI -->
                          </div>
                          <div class="col-md-12">
                            <hr>
                            <div class="bank bank-mandiri">
                              <div class="d-flex justify-content-between" data-toggle="modal" data-target="#modalMandiri">
                                <img src="../../assets/images/logo_bank_mandiri.png" alt="logo bank mandiri">
                                <div>Transfer Bank Mandiri</div>
                              </div>
                            </div>
                            <!-- Modal Bank Mandiri -->
                            <div class="modal fade" id="modalMandiri" tabindex="-1" role="dialog" aria-labelledby="modalMandiri" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalCenterTitle">Pembayaran</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                  <form action="<?php echo base_url(); ?>index.php/search/tagihan" method="post">
                                    <div class="total-pembayaran pd-btm-10">
                                      <div class="d-flex justify-content-between">
                                        <div>Total tagihan</div>
                                        <div><?= 'Rp '.number_format($result->hidejmlHarga,0,',','.') ?></div>
                                      </div>
                                    </div>
                                    <div class="nama-bank">
                                      <div class="d-flex justify-content-between">
                                        <div>Transfer Bank Mandiri</div>
                                        <img src="../../assets/images/logo_bank_mandiri.png" alt="Bank Mandiri">
                                      </div>
                                    </div>
                                    <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                          <label for="Nomor Rekening">Nomor Rekening</label>
                                          <input id="nmrRekening" class="form-control" name="nmrRekening" type="number" value="<?= $data->profile[0]->rek_mandiri ?>" disabled>
                                          <input id="nmrRekening" class="form-control" name="nmrRekening" type="number" value="<?= $data->profile[0]->rek_mandiri ?>" hidden>
                                        </div>
                                      </div>
                                      <div class="col-md-12">
                                        <div class="form-group">
                                          <label for="Nomor Rekening">Nama Pemilik</label>
                                          <input id="nmPemilik" class="form-control" name="nmPemilik" type="text" value="<?= $data->profile[0]->nama ?>" disabled>
                                          <input id="nmPemilik" class="form-control" name="nmPemilik" type="text" value="<?= $data->profile[0]->nama ?>" hidden>
                                        </div>
                                      </div>
                                        <input id="jmlDurasi" class="form-control" name="jmlDurasi" type="text" value="<?= $result->jmlDurasi ?>" hidden>
                                        <input id="durasi" class="form-control" name="durasi" type="text" value="<?= $result->durasi ?>" hidden>
                                        <input id="id_ruangan" class="form-control" name="id_ruangan" type="text" value="<?= $result->ruangan[0]->id_ruangan ?>" hidden>
                                        <input id="tglSekarang" class="form-control" name="tglSekarang" type="date" value="<?= $tgl_now ?>" hidden>
                                        <input id="tglPenyewaan" class="form-control" name="tglPenyewaan" type="date" value="<?= $tgl_sewa ?>" hidden>
                                        <input id="tglSelesai" class="form-control" name="tglSelesai" type="date" value="<?= $tgl_end ?>" hidden>
                                        <input id="harga" class="form-control" name="harga" type="text" value="<?= $result->hidejmlHarga ?>" hidden>
                                        <input id="kode_pemesanan" class="form-control" name="kode_pemesanan" type="text" value="<?= $kode_pemesanan ?>" hidden>
                                        <input id="metode_transfer" class="form-control" name="metode_transfer" type="text" value="Transfer Bank Mandiri" hidden>
                                      <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="submit" value="Bayar" class="btn btn-block btn-primary">
                                        </div>
                                      </div>
                                    </div>
                                    </form>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <!-- Modal Bank Mandiri -->
                          </div>
                          <div class="col-md-12">
                            <hr>
                            <div class="bank bank-bca">
                              <div class="d-flex justify-content-between" data-toggle="modal" data-target="#modalBCA">
                                <img src="../../assets/images/logo_bank_bca.png" alt="logo bank bca">
                                <div>Transfer Bank BCA</div>
                              </div>
                            </div>
                            <!-- Modal Bank BCA -->
                            <div class="modal fade" id="modalBCA" tabindex="-1" role="dialog" aria-labelledby="modalBCA" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalCenterTitle">Pembayaran</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                  <form action="<?php echo base_url(); ?>index.php/search/tagihan" method="post">
                                    <div class="total-pembayaran pd-btm-10">
                                      <div class="d-flex justify-content-between">
                                        <div>Total tagihan</div>
                                        <div><?= 'Rp '.number_format($result->hidejmlHarga,0,',','.') ?></div>
                                      </div>
                                    </div>
                                    <div class="nama-bank">
                                      <div class="d-flex justify-content-between">
                                        <div>Transfer Bank BCA</div>
                                        <img src="../../assets/images/logo_bank_bca.png" alt="Bank BCA">
                                      </div>
                                    </div>
                                    <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                          <label for="Nomor Rekening">Nomor Rekening</label>
                                          <input id="nmrRekening" class="form-control" name="nmrRekening" type="number" value="<?= $data->profile[0]->rek_bca ?>" disabled>
                                          <input id="nmrRekening" class="form-control" name="nmrRekening" type="number" value="<?= $data->profile[0]->rek_bca ?>" hidden>
                                        </div>
                                      </div>
                                      <div class="col-md-12">
                                        <div class="form-group">
                                          <label for="Nomor Rekening">Nama Pemilik</label>
                                          <input id="nmPemilik" class="form-control" name="nmPemilik" type="text" value="<?= $data->profile[0]->nama ?>" disabled>
                                          <input id="nmPemilik" class="form-control" name="nmPemilik" type="text" value="<?= $data->profile[0]->nama ?>" hidden>
                                        </div>
                                      </div>
                                        <input id="jmlDurasi" class="form-control" name="jmlDurasi" type="text" value="<?= $result->jmlDurasi ?>" hidden>
                                        <input id="durasi" class="form-control" name="durasi" type="text" value="<?= $result->durasi ?>" hidden>
                                        <input id="id_ruangan" class="form-control" name="id_ruangan" type="text" value="<?= $result->ruangan[0]->id_ruangan ?>" hidden>
                                        <input id="tglSekarang" class="form-control" name="tglSekarang" type="date" value="<?= $tgl_now ?>" hidden>
                                        <input id="tglPenyewaan" class="form-control" name="tglPenyewaan" type="date" value="<?= $tgl_sewa ?>" hidden>
                                        <input id="tglSelesai" class="form-control" name="tglSelesai" type="date" value="<?= $tgl_end ?>" hidden>
                                        <input id="harga" class="form-control" name="harga" type="text" value="<?= $result->hidejmlHarga ?>" hidden>
                                        <input id="kode_pemesanan" class="form-control" name="kode_pemesanan" type="text" value="<?= $kode_pemesanan ?>" hidden>
                                        <input id="metode_transfer" class="form-control" name="metode_transfer" type="text" value="Transfer Bank BCA" hidden>
                                      <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="submit" value="Bayar" class="btn btn-block btn-primary">
                                        </div>
                                      </div>
                                    </div>
                                    </form>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <!-- Modal Bank BCA -->
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>