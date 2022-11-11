<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Table</a></li>
        <li class="breadcrumb-item active" aria-current="page">Data Pendapatan</li>
    </ol>
</nav>

<?php
// print_r($penyewaan_on_partner['data_penyewaan']);
?>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Pendapatan</h6>
                <div class="table-responsive">
                    <table id="dataTableExample" class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Ruangan</th>
                                <th>Jumlah Penyewaan</th>
                                <th>Pendapatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($pendapatan['data_pendapatan'] as $index => $p) :
                            ?>
                            <tr>
                                <td><?= ++$index ?></td>
                                <td><?= $p->name ?></td>
                                <td><?= $p->jmlPenyewaan ?></td>
                                <td><?= $p->total ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>