<?php
// print_r($gedung);
$this->load->helper('form');
$error = $this->session->flashdata('error');
$success = $this->session->flashdata('success');
?>
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Table</a></li>
        <li class="breadcrumb-item active" aria-current="page">Validasi Data Ruangan</li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <?php if ($error) : ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?= $error; ?>
                </div>
                <?php endif; ?>

                <?php if ($success) : ?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?= $success; ?>
                </div>
                <?php endif; ?>
                <h6 class="card-title">Data Ruangan</h6>
                <div class="table-responsive">
                    <table id="dataTableExample" class="table">
                        <thead>
                            <tr>
                                <th rowspan="2">No</th>
                                <th rowspan="2">Nama Gedung</th>
                                <th rowspan="2">Jenis Gedung</th>
                                <th rowspan="2">Nama Ruangan</th>
                                <th rowspan="2">Status Ruangan</th>
                                <th rowspan="2">Status Penyewaan</th>
                                <th rowspan="2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($gedung['ruangan'] as $index => $r) :
                                if ($r->activation == '1') {
                                $aktif = "Aktif";
                                $status = "success";
                                } else {
                                $aktif = "Belum aktif";
                                $status = "warning";
                                }

                                if ($r->discontinue == '1') {
                                $henti = "Disewakan";
                                } else {
                                $henti = "Dihentikan";
                                }
                            ?>
                            <tr>
                                <!-- <?php if (count($gedung['ruangan']) > 0) { ?> -->
                                <td><?= ++$index ?></td>
                                <td><?= $r->name ?></td>
                                <td><?= $r->type ?></td>
                                <td><?= $r->name ?></td>
                                <td><span class="badge badge-<?= $status ?>"><?= $aktif ?></span></td>
                                <td><span class="badge badge-success"><?= $henti ?></span></td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-icon" data-toggle="modal"
                                        data-target="#delete<?= $r->id ?>"><i data-feather="check"></i></button>
                                    <button type="button" class="btn btn-danger btn-icon" data-toggle="modal"
                                        data-target="#nonaktif<?= $r->id ?>"><i data-feather="x-circle"></i></button>
                                </td>
                                <!-- <?php } else { ?>
                          <td colspan="100%">Data tidak ditemukan</td>
                        <?php } ?> -->
                            </tr>
                            <!-- Start Modal Aktivasi -->
                            <div class="modal fade" id="delete<?= $r->id ?>" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Aktifkan Penyewaan Ruangan
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div>Apakah anda yakin ingin mengaktifkan penyewaan pada ruangan ini?</div>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="<?php echo base_url() ?>admin/manageruangan/activation/<?= $r->id ?>"
                                                type="button" class="btn btn-primary">Aktifkan</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Modal Aktivasi -->
                            <!-- Start Modal Non Aktivasi -->
                            <div class="modal fade" id="nonaktif<?= $r->id ?>" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Penolakan Penyewaan Ruangan
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form
                                                action="<?php echo base_url(); ?>admin/manageruangan/nonActivation/<?= $r->id ?>"
                                                method="post">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <label class="control-label">Apa alasan anda, tidak
                                                                menyetujui ruangan ini untuk disewakan?</label>
                                                            <textarea id="penolakan" name="penolakan"
                                                                class="form-control" maxlength="1000" rows="8"
                                                                placeholder=""></textarea>
                                                            <small
                                                                class="text-danger"><?= form_error('penolakan'); ?></small>
                                                        </div>
                                                    </div><!-- Col -->
                                                </div><!-- Row -->
                                        </div>
                                        <div class="modal-footer">
                                            <input type="submit" value="Simpan" class="btn btn-block btn-primary">
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- End Modal Non Aktivasi -->
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>