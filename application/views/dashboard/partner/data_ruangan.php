<?php
print_r($gedung);
?>
<nav class="page-breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="#">Table</a></li>
						<li class="breadcrumb-item active" aria-current="page">Data Ruangan</li>
					</ol>
				</nav>

				<div class="row">
					<div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h6 class="card-title">Data Ruangan</h6>
                <div class="table-responsive">
                  <table id="dataTableExample" class="table">
                    <thead>
                      <tr>
                        <th rowspan="2">No</th>
                        <th rowspan="2">Nama Gedung</th>
                        <th rowspan="2">Jenis Gedung</th>
                        <th rowspan="2">Nama Ruangan</th>
                        <th rowspan="2">Luas Ruangan</th>
                        <th rowspan="2">Kapasitas</th>
                        <th rowspan="2">Fasilitas</th>
                        <th rowspan="2">Tipe Durasi</th>
                        <th colspan="4">Harga</th>
                        <th rowspan="2">Status Penyewaan</th>
                        <th rowspan="2">Status Pemberhentian</th>
                        <th rowspan="2">Aksi</th>
                      </tr>
                      <tr>
                        <th>Jam</th>
                        <th>Hari</th>
                        <th>Minggu</th>
                        <th>Bulan</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach($gedung['ruangan'] as $index => $r): ?>
                      <tr>
                        <td><?= ++$index ?></td>
                        <td><?= $r->nama_gedung ?></td>
                        <td><?= $r->jenis_gedung ?></td>
                        <td><?= $r->nama_ruangan ?></td>
                        <td><?= $r->ukuran ?>m</td>
                        <td><?= $r->kapasitas ?> Orang</td>
                        <td><?= $r->fasilitas ?></td>
                        <td></td>
                        <td><?= $r->harga_jam ?></td>
                        <td><?= $r->harga_harian ?></td>
                        <td><?= $r->harga_mingguan ?></td>
                        <td><?= $r->harga_bulanan ?></td>
                        <td><?= $r->pengaktifan ?></td>
                        <td><?= $r->pemberhentian ?></td>
                        <td>
                          <button type="button" class="btn btn-warning btn-icon">
                            <i data-feather="edit"></i>
                          </button>
                          <button type="button" class="btn btn-danger btn-icon">
                            <i data-feather="trash"></i>
                          </button>
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