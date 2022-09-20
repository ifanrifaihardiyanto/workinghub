<?php
	$this->load->helper('form');
  	$error = $this->session->flashdata('error');
  	$success = $this->session->flashdata('success');
?>
<nav class="page-breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="#">Form</a></li>
						<li class="breadcrumb-item active" aria-current="page">Input Data Ruangan</li>
					</ol>
				</nav>

				<div class="row">
					<div class="col-md-12 stretch-card">
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
								<h6 class="card-title">Form Ruangan</h6>
									<form action="<?php echo base_url(); ?>index.php/partner/manageruangan/addRuangan" method="post" enctype="multipart/form-data">
									<div class="row">
											<div class="col-sm-12">
												<div class="form-group">
												<label for="exampleFormControlSelect1">Nama Gedung</label>
												<select class="form-control" name="nmGedung" id="nmGedung">
													<!-- <option selected disabled>Pilih gedung</option> -->
													<?php foreach ($gedung['nm_gedung'] as $nmGedung) : ?>
														<option value="<?= $nmGedung->id_gedung ?>" <?= $nmGedung->nama_gedung == $nmGedung->nama_gedung ? 'selected' : '' ?>><?= $nmGedung->nama_gedung ?></option>
													<?php endforeach; ?>
												</select>
												<small class="text-danger"><?= form_error('nmGedung'); ?></small>
												</div>
											</div><!-- Col -->
										</div><!-- Row -->	
										<div class="row">
											<div class="col-sm-6">
												<div class="form-group">
													<label class="control-label">Nama Ruangan</label>
													<input type="text" class="form-control" placeholder="Nama Ruangan" name="nmRuangan" id="nmRuangan">
													<small class="text-danger"><?= form_error('nmRuangan'); ?></small>
												</div>
											</div><!-- Col -->
                      						<div class="col-sm-6">
												<div class="form-group">
													<label class="control-label">Ukuran</label>
													<input type="text" class="form-control" placeholder="Ukuran" name="ukuran" id="ukuran">
													<small class="text-danger"><?= form_error('ukuran'); ?></small>
												</div>
											</div><!-- Col -->
										</div><!-- Row -->
                    					<div class="row">
											<div class="col-sm-6">
												<div class="form-group">
													<label class="control-label">Kapasitas</label>
													<input type="text" class="form-control" placeholder="Kapasitas" name="kapasitas" id="kapasitas">
													<small class="text-danger"><?= form_error('kapasitas'); ?></small>
												</div>
											</div><!-- Col -->
											<div class="col-sm-6">
												<div class="form-group">
												<label>Fasilitas</label>
												<select class="js-example-basic-multiple w-100" multiple="multiple" name="fasilitas[]" id="fasilitas">
													<option value="WiFi">WiFi</option>
													<option value="Papan Tulis">Papan Tulis</option>
													<option value="Proyektor">Proyektor</option>
													<option value="Snack">Snack</option>
												</select>
												<small class="text-danger"><?= form_error('fasilitas[]'); ?></small>
												</div>
											</div><!-- Col -->
										</div><!-- Row -->
										<div class="row">
											<div class="col-sm-6">
												<div class="form-group">
													<label class="control-label">Harga Per Jam</label>
													<input type="text" class="form-control" placeholder="Harga per jam" name="hargaJam" id="hargaJam">
													<small class="text-danger"><?= form_error('hargaJam'); ?></small>
												</div>
											</div><!-- Col -->
											<div class="col-sm-6">
												<div class="form-group">
													<label class="control-label">Harga Per Hari</label>
													<input type="text" class="form-control" placeholder="Harga per hari" name="hargaHarian" id="hargaHarian">
													<small class="text-danger"><?= form_error('hargaHarian'); ?></small>
												</div>
											</div><!-- Col -->
                      						<div class="col-sm-6">
												<div class="form-group">
													<label class="control-label">Harga Per Minggu</label>
													<input type="text" class="form-control" placeholder="Harga per minggu" name="hargaMingguan" id="hargaMingguan">
													<small class="text-danger"><?= form_error('hargaMingguan'); ?></small>
												</div>
											</div><!-- Col -->
                      						<div class="col-sm-6">
												<div class="form-group">
													<label class="control-label">Harga Per Bulan</label>
													<input type="text" class="form-control" placeholder="Harga per bulan" name="hargaBulanan" id="hargaBulanan">
													<small class="text-danger"><?= form_error('hargaBulanan'); ?></small>
												</div>
											</div><!-- Col -->
										</div><!-- Row -->
											<div class="row">
												<div class="col-sm-2">
												<div class="form-group">
												<label for="customRange1">Tipe Durasi</label>
												<div class="form-check">
													<label class="form-check-label">
													<input type="checkbox" class="form-check-input">
													Jam
													</label>
												</div>
												<div class="form-check">
													<label class="form-check-label">
													<input type="checkbox" class="form-check-input">
													Hari
													</label>
												</div>
												<div class="form-check">
													<label class="form-check-label">
													<input type="checkbox" checked class="form-check-input">
													Minggu
													</label>
												</div>
												<div class="form-check">
													<label class="form-check-label">
													<input type="checkbox" class="form-check-input">
													Bulan
													</label>
												</div>
												</div>
											</div>
										<div class="col-sm-10">
											<div class="form-group">
												<label class="control-label">Deskripsi</label>
												<textarea id="deskripsi" name="deskripsi" class="form-control" maxlength="1000" rows="8" placeholder="This textarea has a limit of 1000 chars."></textarea>
												<small class="text-danger"><?= form_error('deskripsi'); ?></small>
											</div>
										</div>
										<div class="col-sm-12">
											<div class="form-group">
												<label>File upload</label>
												<input type="file" name="image[]" id="image" class="file-upload-default" multiple>
												<div class="input-group col-xs-12">
													<input type="text" class="form-control file-upload-info" disabled="" placeholder="Upload Image">
													<span class="input-group-append">
														<button class="file-upload-browse btn btn-primary" type="button">Browse</button>
													</span>
												</div>
											</div>
										</div>
									</div>
									<input type="submit" value="Ajukan Ruangan" class="btn btn-primary submit">
								</form>
							</div>
						</div>
					</div>
				</div>