<nav class="page-breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="#">Table</a></li>
						<li class="breadcrumb-item active" aria-current="page">Riwayat Penyewaan</li>
					</ol>
				</nav>

        <?php
        // print_r($penyewaan_on_partner['data_penyewaan']);
        ?>

				<div class="row">
					<div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h6 class="card-title">Riwayat Penyewaan</h6>
                <div class="table-responsive">
                  <table id="dataTableExample" class="table">
                    <thead>
                      <tr>
                        <th>No</th>  
                        <th>Nama Pemesan</th>
                        <th>Email Pemesan</th>
                        <th>Nama Gedung</th>
                        <th>Nama Ruangan</th>
                        <th>Total Tagihan</th>
                        <th>Status Pembayaran</th>
                        <th>Status Penyewaan</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        foreach($penyewaan_on_partner['data_penyewaan'] as $index => $p):
                          if ($p->status_bukti == '1') {
                            $bukti_status = "Sudah Membayar";
                            $st_bukti = "success";
                          } else {
                            $bukti_status = "Menunggu Pembayaran";
                            $st_bukti = "warning";
                          }

                          if ($p->aktivasi == '1') {
                            $aktivasi = "Aktif";
                            $st_aktivasi = "success";
                          } else {
                            $aktivasi = "Menunggu Validasi";
                            $st_aktivasi = "warning";
                          }
                      ?>
                      <tr>
                        <td><?= ++$index ?></td>
                        <td><?= $p->nama ?></td>
                        <td><?= $p->email ?></td>
                        <td><?= $p->nama_gedung ?></td>
                        <td><?= $p->nama_ruangan ?></td>
                        <td><?= 'Rp '.number_format($p->total_pembayaran,0,',','.') ?></td>
                        <td><span class="badge badge-<?= $st_bukti ?>"><?= $bukti_status ?></span></td>
                        <td><span class="badge badge-<?= $st_aktivasi ?>"><?= $aktivasi ?></span></td>
                        <td>
                          <button type="button" class="btn btn-primary btn-icon" data-toggle="modal" data-target="#lihat<?= $p->id_pemesanan ?>"><i data-feather="eye"></i></button>
                        </td>
                      </tr>
                      <!-- Start Modal Edit -->
                      <div class="modal fade bd-example-modal-xl" id="lihat<?= $p->id_pemesanan ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Detail Penyewaan</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <div class="row">
                                <div class="col-md-8">
                                  <div class="detail-penyewaan">
                                    <span>Nama Pemesan : <?= $p->nama ?></span>
                                    <br>
                                    <span>Email : <?= $p->email ?></span>
                                    <br>
                                    <span>Nama Gedung : <?= $p->nama_gedung ?></span>
                                    <br>
                                    <span>Nama Ruangan : <?= $p->nama_ruangan ?></span>
                                    <br>
                                    <span>Durasi : <?= $p->jml_durasi.' '.$p->tipe_durasi ?></span>
                                    <br>
                                    <span>Tanggal Pemesanan : <?= $p->tgl_pemesanan ?></span>
                                    <br>
                                    <span>Mulai Penyewaan : <?= $p->mulai_penyewaan ?></span>
                                    <br>
                                    <span>Selesai Penyewaan : <?= $p->selesai_penyewaan ?></span>
                                    <br>
                                    <span>Total Pembayaran : <?= 'Rp '.number_format($p->total_pembayaran,0,',','.') ?></span>
                                  </div>
                                </div>
                                <div class="col-md-4">
                                  <div class="photo">
                                    <?php
                                      if (empty($p->bukti_penerusan)) {
                                        echo 'Data tidak ditemukan';
                                      } else {
                                    ?>
                                      <img src="data:image;base64,<?= $p->bukti_penerusan ?>" width="100%" height="100%">
                                    <?php } ?>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- End Modal Edit -->
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
					</div>
				</div>