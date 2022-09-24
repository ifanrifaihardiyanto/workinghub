<?php
  $this->load->helper('form');
  $error = $this->session->flashdata('error');
  $success = $this->session->flashdata('success');
?>
<nav class="page-breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="#">Table</a></li>
						<li class="breadcrumb-item active" aria-current="page">Data User</li>
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
                <div class="d-flex justify-content-between">
                  <h6 class="card-title">Data User</h6>
                  <button type="button" class="btn btn-info btn-icon" data-toggle="modal" data-target="#tambah"><i data-feather="plus-circle"></i></button>
                </div>
                <div class="table-responsive">
                  <table id="dataTableExample" class="table">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Tempat Lahir</th>
                        <th>Tanggal Lahir</th>
                        <th>Nomor Telepon</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach($hasil['data_user'] as $index => $q): ?>
                      <tr>
                        <td><?= ++$index; ?></td>
                        <td><?= $q->nik_ktp ?></td>
                        <td><?= $q->nama ?></td>
                        <td><?= $q->tempat_lahir ?></td>
                        <td><?= $q->tanggal_lahir ?></td>
                        <td><?= $q->no_tlp ?></td>
                        <td><?= $q->role ?></td>
                        <td>
                          <?php
                            if ($q->aktivasi == '1') {
                              $aktif = "Aktif";
                              $status = "success";
                            } else {
                              $aktif = "Tidak aktif";
                              $status = "warning";
                            }
                          ?>
                          <span class="badge badge-<?= $status ?>"><?= $aktif ?></span>
                        </td>
                        <td>
                          <button type="button" class="btn btn-warning btn-icon" data-toggle="modal" data-target="#edit<?= $q->id_user ?>"><i data-feather="edit"></i></button>
                          <button type="button" class="btn btn-danger btn-icon" data-toggle="modal" data-target="#nonaktif<?= $q->id_user ?>"><i data-feather="x-circle"></i></button>
                        </td>
                      </tr>
                      <!-- Start Modal Edit -->
                      <div class="modal fade" id="edit<?= $q->id_user ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                            <form action="<?php echo base_url(); ?>index.php/admin/manageuser/edit/<?= $q->id_user ?>" method="post">
                              <div class="row">
                                <div class="col-sm-6">
                                  <div class="form-group">
                                    <label class="control-label">Nama</label>
                                    <input type="text" class="form-control" placeholder="Nama" name="nama" id="nama" value="<?= $q->nama; ?>">
                                    <small class="text-danger"><?= form_error('nama'); ?></small>
                                  </div>
                                </div><!-- Col -->
                                <div class="col-sm-6">
                                  <div class="form-group">
                                    <label class="control-label">NIK</label>
                                    <input type="text" class="form-control" placeholder="NIK" name="nik" id="nik" value="<?= $q->nik_ktp; ?>">
                                    <small class="text-danger"><?= form_error('nik'); ?></small>
                                  </div>
                                </div><!-- Col -->
                              </div><!-- Row -->
                              <div class="row">
                                <div class="col-sm-6">
                                  <div class="form-group">
                                    <label class="control-label">Nomor Telepon</label>
                                    <input type="text" class="form-control" placeholder="Nomor Telepon" name="noTelp" id="noTelp" value="<?= $q->no_tlp; ?>">
                                    <small class="text-danger"><?= form_error('noTelp'); ?></small>
                                  </div>
                                </div><!-- Col -->
                                <?php if (in_array($q->role, ['Partner','Pemesan'])) : ?>
                                <div class="col-sm-6">
                                  <div class="form-group">
                                    <label class="control-label">Nomor Rekening Bank BNI</label>
                                    <input type="number" class="form-control" placeholder="Nomor Rekening Bank BNI" name="rekBNI" id="rekBNI" value="<?= $q->rek_bni; ?>">
                                    <small class="text-danger"><?= form_error('rekBNI'); ?></small>
                                  </div>
                                </div><!-- Col -->
                                <?php endif; ?>
                              </div><!-- Row -->
                              <div class="row">
                                <div class="col-sm-6">
                                  <div class="form-group">
                                    <label class="control-label">Tempat Lahir</label>
                                    <input type="text" class="form-control" placeholder="Tempat Lahir" name="tmptLahir" id="tmptLahir" value="<?= $q->tempat_lahir; ?>">
                                    <small class="text-danger"><?= form_error('tmptLahir'); ?></small>
                                  </div>
                                </div><!-- Col -->
                                <?php if (in_array($q->role, ['Partner','Pemesan'])) : ?>
                                <div class="col-sm-6">
                                  <div class="form-group">
                                    <label class="control-label">Nomor Rekening Bank BRI</label>
                                    <input type="text" class="form-control" placeholder="Nomor Rekening Bank BRI" name="rekBRI" id="rekBRI" value="<?= $q->rek_bri; ?>">
                                    <small class="text-danger"><?= form_error('rekBRI'); ?></small>
                                  </div>
                                </div><!-- Col -->
                                <?php endif; ?>
                              </div><!-- Row -->
                              <div class="row">
                                <div class="col-sm-6">
                                  <div class="form-group">
                                    <label class="control-label">Tanggal Lahir</label>
                                    <input type="date" class="form-control" placeholder="Tanggal Lahir" name="tglLahir" id="tglLahir" value="<?= $q->tanggal_lahir; ?>">
                                    <small class="text-danger"><?= form_error('tglLahir'); ?></small>
                                  </div>
                                </div><!-- Col -->
                                <?php if (in_array($q->role, ['Partner','Pemesan'])) : ?>
                                <div class="col-sm-6">
                                  <div class="form-group">
                                    <label class="control-label">Nomor Rekening Bank Mandiri</label>
                                    <input type="number" class="form-control" placeholder="Nomor Rekening Bank Mandiri" name="rekMandiri" id="rekMandiri" value="<?= $q->rek_mandiri; ?>">
                                    <small class="text-danger"><?= form_error('rekMandiri'); ?></small>
                                  </div>
                                </div><!-- Col -->
                                <?php endif; ?>
                              </div><!-- Row -->
                              <div class="row">
                                <div class="col-sm-6">
                                  <div class="form-group">
                                    <label class="control-label">Alamat</label>
                                    <input type="text" class="form-control" placeholder="Alamat" name="alamat" id="alamat" value="<?= $q->alamat; ?>">
                                    <small class="text-danger"><?= form_error('alamat'); ?></small>
                                  </div>
                                </div><!-- Col -->
                                <?php if (in_array($q->role, ['Partner','Pemesan'])) : ?>
                                <div class="col-sm-6">
                                  <div class="form-group">
                                    <label class="control-label">Nomor Rekening Bank BCA</label>
                                    <input type="number" class="form-control" placeholder="Nomor Rekening Bank BCA" name="rekBCA" id="rekBCA" value="<?= $q->rek_bca; ?>">
                                    <small class="text-danger"><?= form_error('rekBCA'); ?></small>
                                  </div>
                                </div><!-- Col -->
                                <?php endif; ?>
                              </div><!-- Row -->
                              <div class="d-flex justify-content-center">
                                <input type="submit" value="Simpan" class="btn btn-block btn-primary">
                              </div>
                            </form>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- End Modal Edit -->
                      <!-- Start Modal Delete -->
                      <div class="modal fade" id="nonaktif<?= $q->id_user ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <div>Apakah anda yakin ingin menonaktifkan user ini?</div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <a href="<?php echo base_url()?>index.php/admin/manageuser/nonaktif/<?= $q->id_user ?>" type="button" class="btn btn-primary">Hapus</a>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- End Modal Delete -->
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
					</div>
				</div>

                      <!-- Start Modal Tambah -->
                      <div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                            <form action="<?php echo base_url(); ?>index.php/admin/manageuser/tambah" method="post">
                              <div class="row">
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <label for="nama">Email</label>
                                    <input type="email" class="form-control" placeholder="Your Email" id="email" name="email" value="<?= set_value('email'); ?>">
                                    <small class="text-danger"><?= form_error('email'); ?></small>
                                  </div>
                                </div>
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" placeholder="Your Password" id="password" name="password">
                                    <small class="text-danger"><?= form_error('password'); ?></small>
                                  </div>
                                </div>
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <label for="exampleFormControlSelect1">Role</label>
                                    <select class="form-control" id="exampleFormControlSelect1" id="role" name="role">
                                      <option selected disabled>Pilih role</option>
                                      <option value="Admin">Admin</option>
                                      <option value="Penyedia">Penyedia</option>
                                      <option value="Pemesan">Pemesan</option>
                                    </select>
                                    <small class="text-danger"><?= form_error('role'); ?></small>
                                  </div>
                                </div>
                              </div><!-- Row -->
                              <div class="d-flex justify-content-center">
                                <input type="submit" value="Simpan" class="btn btn-primary submit">
                              </div>
                            </form>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- End Modal Tambah -->