<?php
  $this->load->helper('form');
//   $error = $this->session->flashdata('error');
//   $success = $this->session->flashdata('success');
// print_r($gedung['jenis_gedung']);
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
									<form action="<?php echo base_url(); ?>index.php/partner/manageruangan/addGedung" method="post">
										<div class="row">
											<div class="col-sm-6">
                                                <div class="form-group">
                                                <label>Jenis Gedung</label>
                                                <select class="js-example-basic-single w-100" name="jnsGedung" id="jnsGedung">
													<?php foreach ($gedung['jenis_gedung'] as $nmGedung) : ?>
														<option value="<?= $nmGedung->jenis_gedung ?>" <?= $nmGedung->jenis_gedung == $nmGedung->jenis_gedung ? 'selected' : '' ?>><?= $nmGedung->jenis_gedung ?></option>
													<?php endforeach; ?>
                                                </select>
												
                                                </div>
											</div><!-- Col -->
											<div class="col-sm-6">
												<div class="form-group">
													<label class="control-label">Nama Gedung</label>
													<input type="text" class="form-control" placeholder="Nama Gedung" name="nmGedung" id="nmGedung">
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
													<input type="number" class="form-control" placeholder="Nomor Telepon" name="noTelp" id="noTelp">
													<small class="text-danger"><?= form_error('noTelp'); ?></small>
												</div>
											</div><!-- Col -->
										</div><!-- Row -->
										<div class="row">
											<div class="col-sm-6">
												<div class="form-group">
													<label class="control-label">Jam Buka</label>
													<div class="input-group date timepicker" id="jambuka" data-target-input="nearest">
                                                    <input type="text" class="form-control datetimepicker-input" data-target="#jambuka" name="jamTutup" id="jamBuka"/>
                                                    <div class="input-group-append" data-target="#jambuka" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i data-feather="clock"></i></div>
                                                    </div>
                                                </div>
												</div>
											</div><!-- Col -->
											<div class="col-sm-6">
												<div class="form-group">
													<label class="control-label">Jam Tutup</label>
													<div class="input-group date timepicker" id="jamtutup" data-target-input="nearest">
                                                        <input type="text" class="form-control datetimepicker-input" data-target="#jamtutup" name="jamTutup" id="jamTutup"/>
                                                        <div class="input-group-append" data-target="#jamtutup" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i data-feather="clock"></i></div>
                                                        </div>
                                                    </div>
												</div>
											</div><!-- Col -->
										</div><!-- Row -->
										<input type="submit" value="Tambah Gedung" class="btn btn-primary submit">
                                    </form>
							</div>
						</div>
					</div>
				</div>