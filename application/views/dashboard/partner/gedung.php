<?php
$this->load->helper('form');
//   $error = $this->session->flashdata('error');
//   $success = $this->session->flashdata('success');
// print_r($gedung['startHour']);
?>
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Form</a></li>
        <li class="breadcrumb-item active" aria-current="page">Input Data Gedung</li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-12 stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Input Data Gedung</h6>
                <form action="<?php echo base_url(); ?>partner/manageruangan/addGedung" method="post">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Jenis Gedung</label>
                                <select class="js-example-basic-single w-100" name="jnsGedung" id="jnsGedung">
                                    <?php foreach ($gedung['jenis_gedung'] as $nmGedung) : ?>
                                    <option value="<?= $nmGedung->type ?>"
                                        <?= $nmGedung->type == $nmGedung->type ? 'selected' : '' ?>>
                                        <?= $nmGedung->type ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div><!-- Col -->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Nama Gedung</label>
                                <input type="text" class="form-control" placeholder="Nama Gedung" name="nmGedung"
                                    id="nmGedung">
                                <small class="text-danger"><?= form_error('nmGedung'); ?></small>
                            </div>
                        </div><!-- Col -->
                    </div><!-- Row -->
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Lokasi</label>
                                <input type="text" class="form-control" placeholder="Lokasi" name="lokasi" id="lokasi">
                                <small class="text-danger"><?= form_error('lokasi'); ?></small>
                            </div>
                        </div><!-- Col -->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Kota</label>
                                <input type="text" class="form-control" placeholder="Kota" name="kota" id="kota">
                                <small class="text-danger"><?= form_error('kota'); ?></small>
                            </div>
                        </div><!-- Col -->
                    </div><!-- Row -->
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Email</label>
                                <input type="email" class="form-control" placeholder="Email" name="email" id="email">
                                <small class="text-danger"><?= form_error('email'); ?></small>
                            </div>
                        </div><!-- Col -->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Nomor Telepon</label>
                                <input type="number" class="form-control" placeholder="Nomor Telepon" name="noTelp"
                                    id="noTelp">
                                <small class="text-danger"><?= form_error('noTelp'); ?></small>
                            </div>
                        </div><!-- Col -->
                    </div><!-- Row -->
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Jam Buka</label>
                                <select class="js-example-basic-single w-100" name="startHour" id="startHour">
                                    <?php foreach ($gedung['startHour'] as $startHour) : ?>
                                    <option value="<?= $startHour ?>" <?= $startHour == $startHour ? 'selected' : '' ?>>
                                        <?= $startHour . ".00" ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div><!-- Col -->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Jam Tutup</label>
                                <select class="js-example-basic-single w-100" name="endHour" id="endHour">
                                    <?php foreach ($gedung['endHour'] as $endHour) : ?>
                                    <option value="<?= $endHour ?>" <?= $endHour == $endHour ? 'selected' : '' ?>>
                                        <?= $endHour . ".00" ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div><!-- Col -->
                    </div><!-- Row -->
                    <input type="submit" value="Tambah Gedung" class="btn btn-primary submit">
                </form>
            </div>
        </div>
    </div>
</div>