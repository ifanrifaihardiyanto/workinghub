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
								<h6 class="card-title">Form</h6>
									<form>
										<div class="row">
											<div class="col-sm-6">
												<div class="form-group">
													<label class="control-label">Nama Ruangan</label>
													<input type="text" class="form-control" placeholder="Nama Ruangan">
												</div>
											</div><!-- Col -->
                      <div class="col-sm-6">
												<div class="form-group">
													<label class="control-label">Ukuran</label>
													<input type="text" class="form-control" placeholder="Ukuran">
												</div>
											</div><!-- Col -->
										</div><!-- Row -->
                    <div class="row">
											<div class="col-sm-6">
												<div class="form-group">
													<label class="control-label">Kapasitas</label>
													<input type="text" class="form-control" placeholder="Kapasitas">
												</div>
											</div><!-- Col -->
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Fasilitas</label>
                          <select class="js-example-basic-multiple w-100" multiple="multiple">
                            <option value="TX">WiFi</option>
                            <option value="NY">Papan Tulis</option>
                            <option value="FL">Proyektor</option>
                            <option value="KN">Snack</option>
                          </select>
                        </div>
                      </div><!-- Col -->
										</div><!-- Row -->
										<div class="row">
											<div class="col-sm-6">
												<div class="form-group">
													<label class="control-label">Harga Per Jam</label>
													<input type="text" class="form-control" placeholder="Harga per jam">
												</div>
											</div><!-- Col -->
											<div class="col-sm-6">
												<div class="form-group">
													<label class="control-label">Harga Per Hari</label>
													<input type="text" class="form-control" placeholder="Harga per hari">
												</div>
											</div><!-- Col -->
                      <div class="col-sm-6">
												<div class="form-group">
													<label class="control-label">Harga Per Minggu</label>
													<input type="text" class="form-control" placeholder="Harga per minggu">
												</div>
											</div><!-- Col -->
                      <div class="col-sm-6">
												<div class="form-group">
													<label class="control-label">Harga Per Bulan</label>
													<input type="text" class="form-control" placeholder="Harga per bulan">
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
                          <textarea id="maxlength-textarea" class="form-control" maxlength="1000" rows="8" placeholder="This textarea has a limit of 1000 chars."></textarea>
                        </div>
                      </div>
                    </div>
									</form>
									<button type="button" class="btn btn-primary submit">Ajukan Ruangan</button>
							</div>
						</div>
					</div>
				</div>