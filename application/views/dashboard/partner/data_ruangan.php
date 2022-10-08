<?php
// print_r($gedung);
$this->load->helper('form');
$error = $this->session->flashdata('error');
$success = $this->session->flashdata('success');
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
                                <th>No</th>
                                <th>Nama Gedung</th>
                                <th>Jenis Gedung</th>
                                <th>Nama Ruangan</th>
                                <th>Luas Ruangan</th>
                                <th>Kapasitas</th>
                                <th>Status Ruangan</th>
                                <th>Status Penyewaan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($gedung['ruangan'] as $index => $r) :
                              $disable = "";
                              if ($r->pengaktifan == '1') {
                                $aktif = "Aktif";
                                $status = "success";
                              } elseif ($r->pengaktifan == '2') {
                                $aktif = "Ditolak";
                                $status = "danger";
                                $disable = "disabled";
                              } elseif ($r->pengaktifan == '3') {
                                $aktif = "Tidak aktif";
                                $status = "danger";
                                $disable = "disabled";
                              } else {
                                $aktif = "Menunggu persetujuan admin";
                                $status = "warning";
                              }

                              if ($r->pemberhentian == '1') {
                                $henti = "Disewakan";
                                $statusa = "success";
                              } else {
                                $henti = "Dihentikan";
                                $statusa = "danger";
                              }
                            ?>
                            <tr>
                                <td><?= ++$index ?></td>
                                <td><?= $r->nama_gedung ?></td>
                                <td><?= $r->jenis_gedung ?></td>
                                <td><?= $r->nama_ruangan ?></td>
                                <td><?= $r->ukuran ?>m</td>
                                <td><?= $r->kapasitas ?> Orang</td>
                                <td><span class="badge badge-<?= $status ?>"><?= $aktif ?></span></td>
                                <td><span class="badge badge-<?= $statusa ?>"><?= $henti ?></span></td>
                                <td>
                                    <button type="button" class="btn btn-warning btn-icon" data-toggle="modal"
                                        data-target="#edit<?= $r->id_ruangan ?>" <?= $disable ?>><i
                                            data-feather="edit"></i></button>
                                    <button type="button" class="btn btn-danger btn-icon" data-toggle="modal"
                                        data-target="#nonaktif<?= $r->id_ruangan ?>" <?= $disable ?>><i
                                            data-feather="x-circle"></i></button>
                                </td>
                            </tr>
                            <!-- Start Modal Edit -->
                            <div class="modal fade bd-example-modal-xl" id="edit<?= $r->id_ruangan ?>" tabindex="-1"
                                role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-xl" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form
                                                action="<?php echo base_url(); ?>partner/manageruangan/edit/<?= $r->id_ruangan ?>/<?= $r->id_gedung ?>"
                                                method="post" enctype="multipart/form-data">
                                                <!-- Row -->
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="control-label">Nama Ruangan</label>
                                                            <input type="text" class="form-control"
                                                                placeholder="Nama Ruangan" name="nmRuangan"
                                                                id="nmRuangan" value="<?= $r->nama_ruangan; ?>">
                                                            <small
                                                                class="text-danger"><?= form_error('nmRuangan'); ?></small>
                                                        </div>
                                                    </div><!-- Col -->
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="control-label">Ukuran</label>
                                                            <input type="text" class="form-control" placeholder="Ukuran"
                                                                name="ukuran" id="ukuran" value="<?= $r->ukuran; ?>">
                                                            <small
                                                                class="text-danger"><?= form_error('ukuran'); ?></small>
                                                        </div>
                                                    </div><!-- Col -->
                                                </div><!-- Row -->
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="control-label">Kapasitas</label>
                                                            <input type="text" class="form-control"
                                                                placeholder="Kapasitas" name="kapasitas" id="kapasitas"
                                                                value="<?= $r->kapasitas; ?>">
                                                            <small
                                                                class="text-danger"><?= form_error('kapasitas'); ?></small>
                                                        </div>
                                                    </div><!-- Col -->
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Fasilitas</label>
                                                            <select class="js-example-basic-multiple w-100"
                                                                multiple="multiple" name="fasilitas[]"
                                                                id="fasilitas<?= $r->id_ruangan ?>">
                                                                <?php
                                                                $data_fas = explode(', ', $r->fasilitas);

                                                                foreach ($data_fas as $item) :
                                                                ?>
                                                                <option value="<?= $item ?>"
                                                                    <?= in_array($item, $data_fas) ? 'selected' : '' ?>>
                                                                    <?= $item ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                            <small
                                                                class="text-danger"><?= form_error('fasilitas[]'); ?></small>
                                                        </div>
                                                    </div><!-- Col -->
                                                </div><!-- Row -->
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="control-label">Harga Per Jam</label>
                                                            <input type="text" class="form-control"
                                                                placeholder="Harga per jam" name="hargaJam"
                                                                id="hargaJam" value="<?= $r->harga_jam; ?>">
                                                            <small
                                                                class="text-danger"><?= form_error('hargaJam'); ?></small>
                                                        </div>
                                                    </div><!-- Col -->
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="control-label">Harga Per Hari</label>
                                                            <input type="text" class="form-control"
                                                                placeholder="Harga per hari" name="hargaHarian"
                                                                id="hargaHarian" value="<?= $r->harga_harian; ?>">
                                                            <small
                                                                class="text-danger"><?= form_error('hargaHarian'); ?></small>
                                                        </div>
                                                    </div><!-- Col -->
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="control-label">Harga Per Minggu</label>
                                                            <input type="text" class="form-control"
                                                                placeholder="Harga per minggu" name="hargaMingguan"
                                                                id="hargaMingguan" value="<?= $r->harga_mingguan; ?>">
                                                            <small
                                                                class="text-danger"><?= form_error('hargaMingguan'); ?></small>
                                                        </div>
                                                    </div><!-- Col -->
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="control-label">Harga Per Bulan</label>
                                                            <input type="text" class="form-control"
                                                                placeholder="Harga per bulan" name="hargaBulanan"
                                                                id="hargaBulanan" value="<?= $r->harga_bulanan; ?>">
                                                            <small
                                                                class="text-danger"><?= form_error('hargaBulanan'); ?></small>
                                                        </div>
                                                    </div><!-- Col -->
                                                </div><!-- Row -->
                                                <div class="row">
                                                    <div class="col-sm-2">
                                                        <div class="form-group">
                                                            <label for="customRange1">Tipe Durasi</label>
                                                            <?php
                                                            $data_durasi = $r->durasi;
                                                            if (!empty($r->durasi)) {
                                                              $data_durasi = explode(', ', $r->durasi);
                                                            }
                                                            $durasiJ = '';
                                                            $durasiH = '';
                                                            $durasiM = '';
                                                            $durasiB = '';
                                                            foreach ($data_durasi as $item) {
                                                              if ($item == 'Jam') {
                                                                $durasiJ = 'Jam';
                                                              } elseif ($item == 'Hari') {
                                                                $durasiH = 'Hari';
                                                              } elseif ($item == 'Minggu') {
                                                                $durasiM = 'Minggu';
                                                              } else {
                                                                $durasiB = 'Bulan';
                                                              }
                                                            }
                                                            ?>
                                                            <div class="form-check">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox" <?php if ($durasiJ != '') {
                                                              echo 'checked';
                                                            } ?> class="form-check-input" name="durasi[]" id="durasi"
                                                                        value="Jam">
                                                                    Jam
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox" <?php if ($durasiH != '') {
                                                              echo 'checked';
                                                            } ?> class="form-check-input" name="durasi[]" id="durasi"
                                                                        value="Hari">
                                                                    Hari
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox" <?php if ($durasiM != '') {
                                                              echo 'checked';
                                                            } ?> class="form-check-input" name="durasi[]" id="durasi"
                                                                        value="Minggu">
                                                                    Minggu
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox" <?php if ($durasiB != '') {
                                                              echo 'checked';
                                                            } ?> class="form-check-input" name="durasi[]" id="durasi"
                                                                        value="Bulan">
                                                                    Bulan
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-10">
                                                        <div class="form-group">
                                                            <label class="control-label">Deskripsi</label>
                                                            <textarea id="deskripsi" name="deskripsi"
                                                                class="form-control" maxlength="1000" rows="8"
                                                                placeholder="This textarea has a limit of 1000 chars."
                                                                value="<?= $r->deskripsi; ?>"><?= $r->deskripsi; ?></textarea>
                                                            <small
                                                                class="text-danger"><?= form_error('deskripsi'); ?></small>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <label>File upload</label>
                                                            <input type="file" name="image[]" id="image"
                                                                class="file-upload-default" multiple>
                                                            <div class="input-group col-xs-12">
                                                                <input type="text" class="form-control file-upload-info"
                                                                    disabled="" placeholder="Upload Image">
                                                                <span class="input-group-append">
                                                                    <button class="file-upload-browse btn btn-primary"
                                                                        type="button">Browse</button>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="submit" value="Ajukan Ruangan"
                                                    class="btn btn-primary submit">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Modal Edit -->
                            <!-- Start Modal Non Aktivasi -->
                            <div class="modal fade" id="nonaktif<?= $r->id_ruangan ?>" tabindex="-1" role="dialog"
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
                                                action="<?php echo base_url(); ?>partner/manageruangan/nonaktif/<?= $r->id_ruangan ?>"
                                                method="post">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <label class="control-label">Apa alasan anda, menghentikan
                                                                penyewaan ruangan ini?</label>
                                                            <textarea id="pemberhentian" name="pemberhentian"
                                                                class="form-control" maxlength="1000" rows="8"
                                                                placeholder=""></textarea>
                                                            <small
                                                                class="text-danger"><?= form_error('pemberhentian'); ?></small>
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