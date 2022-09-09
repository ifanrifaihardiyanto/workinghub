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
									<form>
										<div class="row">
											<div class="col-sm-6">
                                                <div class="form-group">
                                                <label>Nama Gedung</label>
                                                <select class="js-example-basic-single w-100">
                                                    <option value="TX">Gedung 1</option>
                                                    <option value="NY">Gedung 2</option>
                                                    <option value="FL">Gedung 3</option>
                                                    <option value="KN">Gedung 4</option>
                                                </select>
                                                </div>
											</div><!-- Col -->
											<div class="col-sm-6">
												<div class="form-group">
													<label class="control-label">Jenis Gedung</label>
													<input type="text" class="form-control" placeholder="Jenis Gedung">
												</div>
											</div><!-- Col -->
										</div><!-- Row -->
										<div class="row">
											<div class="col-sm-6">
												<div class="form-group">
													<label class="control-label">Lokasi</label>
													<input type="text" class="form-control" placeholder="Lokasi">
												</div>
											</div><!-- Col -->
											<div class="col-sm-6">
												<div class="form-group">
													<label class="control-label">Kota</label>
													<input type="text" class="form-control" placeholder="Kota">
												</div>
											</div><!-- Col -->
										</div><!-- Row -->
                                        <div class="row">
											<div class="col-sm-6">
												<div class="form-group">
													<label class="control-label">Email</label>
													<input type="email" class="form-control" placeholder="Email">
												</div>
											</div><!-- Col -->
											<div class="col-sm-6">
												<div class="form-group">
													<label class="control-label">Nomor Telepon</label>
													<input type="number" class="form-control" placeholder="Nomor Telepon">
												</div>
											</div><!-- Col -->
										</div><!-- Row -->
										<div class="row">
											<div class="col-sm-6">
												<div class="form-group">
													<label class="control-label">Jam Buka</label>
													<div class="input-group date timepicker" id="jambuka" data-target-input="nearest">
                                                    <input type="text" class="form-control datetimepicker-input" data-target="#jambuka"/>
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
                                                        <input type="text" class="form-control datetimepicker-input" data-target="#jamtutup"/>
                                                        <div class="input-group-append" data-target="#jamtutup" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i data-feather="clock"></i></div>
                                                        </div>
                                                    </div>
												</div>
											</div><!-- Col -->
										</div><!-- Row -->
                                        <a href="<?php echo base_url(); ?>index.php/partner/manageruangan/addRuangan" type="button" class="btn btn-primary submit">Berikutnya</a>
                                    </form>
							</div>
						</div>
					</div>
				</div>