<nav class="page-breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="#">Table</a></li>
						<li class="breadcrumb-item active" aria-current="page">Validasi Pembayaran</li>
					</ol>
				</nav>

        <?php
        // print_r($penyewaan['data_penyewaan']);
        ?>

				<div class="row">
					<div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h6 class="card-title">Data Pembayaran</h6>
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
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        foreach($penyewaan['data_penyewaan'] as $index => $p):
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
                        <td>
                          <button type="button" class="btn btn-primary btn-icon" data-toggle="modal" data-target="#aktif<?= $p->id_pembayaran ?>"><i data-feather="check"></i></button>
                          <button type="button" class="btn btn-danger btn-icon" data-toggle="modal" data-target="#nonaktif<?= $p->id_pembayaran ?>"><i data-feather="x-circle"></i></button>
                        </td>
                      </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
					</div>
				</div>