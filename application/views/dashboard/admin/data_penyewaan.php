<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Table</a></li>
        <li class="breadcrumb-item active" aria-current="page">Data Pemesanan</li>
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
                                <!-- <th>Status Pembayaran</th> -->
                                <th>Status Penyewaan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                              foreach ($penyewaan['data_penyewaan'] as $index => $p) :
                                // if ($p->status_bukti == '1') {
                                //   $bukti_status = "Sudah Membayar";
                                //   $st_bukti = "success";
                                // } else {
                                //   $bukti_status = "Menunggu Pembayaran";
                                //   $st_bukti = "warning";
                                // }

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
                                <td><?= $p->name ?></td>
                                <td><?= $p->email ?></td>
                                <td><?= $p->name ?></td>
                                <td><?= $p->name ?></td>
                                <td><?= 'Rp ' . number_format($p->total_pembayaran, 0, ',', '.') ?></td>
                                <!-- <td><span class="badge badge-<?= $st_bukti ?>"><?= $bukti_status ?></span></td> -->
                                <td><span class="badge badge-<?= $st_aktivasi ?>"><?= $aktivasi ?></span></td>
                                <!-- <td>
                          <button type="button" class="btn btn-warning btn-icon">
                            <i data-feather="edit"></i>
                          </button>
                          <a href="#" type="button" class="btn btn-danger btn-icon trash"></a>
                        </td> -->
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>