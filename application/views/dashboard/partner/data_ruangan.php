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
                        <th rowspan="2">No</th>
                        <th rowspan="2">Nama Gedung</th>
                        <th rowspan="2">Jenis Gedung</th>
                        <th rowspan="2">Nama Ruangan</th>
                        <th rowspan="2">Luas Ruangan</th>
                        <th rowspan="2">Kapasitas</th>
                        <th rowspan="2">Fasilitas</th>
                        <th rowspan="2">Tipe Durasi</th>
                        <th colspan="4">Harga</th>
                        <th rowspan="2">Status Penyewaan</th>
                        <th rowspan="2">Status Pemberhentian</th>
                        <th rowspan="2">Aksi</th>
                      </tr>
                      <tr>
                        <th>Jam</th>
                        <th>Hari</th>
                        <th>Minggu</th>
                        <th>Bulan</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach($gedung['ruangan'] as $index => $r): ?>
                      <tr>
                        <td><?= ++$index ?></td>
                        <td><?= $r->nama_gedung ?></td>
                        <td><?= $r->jenis_gedung ?></td>
                        <td><?= $r->nama_ruangan ?></td>
                        <td><?= $r->ukuran ?>m</td>
                        <td><?= $r->kapasitas ?> Orang</td>
                        <td><?= $r->fasilitas ?></td>
                        <td></td>
                        <td><?= $r->harga_jam ?></td>
                        <td><?= $r->harga_harian ?></td>
                        <td><?= $r->harga_mingguan ?></td>
                        <td><?= $r->harga_bulanan ?></td>
                        <td><?= $r->pengaktifan ?></td>
                        <td><?= $r->pemberhentian ?></td>
                        <td>
                        <button type="button" class="btn btn-warning btn-icon" data-toggle="modal" data-target="#edit<?= $r->id_ruangan ?>"><i data-feather="edit"></i></button>
                          <button type="button" class="btn btn-danger btn-icon" data-toggle="modal" data-target="#delete<?= $r->id_ruangan ?>"><i data-feather="x-circle"></i></button>
                        </td>
                      </tr>
                      <!-- Start Modal Edit -->
                      <div class="modal fade" id="edit<?= $r->id_ruangan ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                            <form action="<?php echo base_url(); ?>index.php/partner/manageruangan/edit/<?= $r->id_ruangan ?>" method="post">
                                <!-- Row -->	
                                <div class="row">
                                  <div class="col-sm-6">
                                    <div class="form-group">
                                      <label class="control-label">Nama Ruangan</label>
                                      <input type="text" class="form-control" placeholder="Nama Ruangan" name="nmRuangan" id="nmRuangan" value="<?= $r->nama_ruangan; ?>">
                                      <small class="text-danger"><?= form_error('nmRuangan'); ?></small>
                                    </div>
                                  </div><!-- Col -->
                                              <div class="col-sm-6">
                                    <div class="form-group">
                                      <label class="control-label">Ukuran</label>
                                      <input type="text" class="form-control" placeholder="Ukuran" name="ukuran" id="ukuran" value="<?= $r->ukuran; ?>">
                                      <small class="text-danger"><?= form_error('ukuran'); ?></small>
                                    </div>
                                  </div><!-- Col -->
                                </div><!-- Row -->
                                          <div class="row">
                                  <div class="col-sm-6">
                                    <div class="form-group">
                                      <label class="control-label">Kapasitas</label>
                                      <input type="text" class="form-control" placeholder="Kapasitas" name="kapasitas" id="kapasitas" value="<?= $r->kapasitas; ?>">
                                      <small class="text-danger"><?= form_error('kapasitas'); ?></small>
                                    </div>
                                  </div><!-- Col -->
                                  <div class="col-sm-6">
                                    <div class="form-group">
                                    <label>Fasilitas</label>
                                    <select class="js-example-basic-multiple w-100" multiple="multiple" name="fasilitas[]" id="fasilitas" value="<?= $r->fasilitas; ?>">
                                    <?php
                                      $data_fas = explode(',', $r->fasilitas);
                                      
                                      foreach ($data_fas as $item) : 
                                    ?>
                                      <option value="<?= $item ?>" <?= in_array($item, $data_fas) ? 'selected' : '' ?>><?= $item ?></option>
                                    <?php endforeach; ?>
                                    </select>
                                    <small class="text-danger"><?= form_error('fasilitas[]'); ?></small>
                                    </div>
                                  </div><!-- Col -->
                                </div><!-- Row -->
                                <div class="row">
                                  <div class="col-sm-6">
                                    <div class="form-group">
                                      <label class="control-label">Harga Per Jam</label>
                                      <input type="text" class="form-control" placeholder="Harga per jam" name="hargaJam" id="hargaJam" value="<?= $r->harga_jam; ?>">
                                      <small class="text-danger"><?= form_error('hargaJam'); ?></small>
                                    </div>
                                  </div><!-- Col -->
                                  <div class="col-sm-6">
                                    <div class="form-group">
                                      <label class="control-label">Harga Per Hari</label>
                                      <input type="text" class="form-control" placeholder="Harga per hari" name="hargaHarian" id="hargaHarian" value="<?= $r->harga_harian; ?>">
                                      <small class="text-danger"><?= form_error('hargaHarian'); ?></small>
                                    </div>
                                  </div><!-- Col -->
                                              <div class="col-sm-6">
                                    <div class="form-group">
                                      <label class="control-label">Harga Per Minggu</label>
                                      <input type="text" class="form-control" placeholder="Harga per minggu" name="hargaMingguan" id="hargaMingguan" value="<?= $r->harga_mingguan; ?>">
                                      <small class="text-danger"><?= form_error('hargaMingguan'); ?></small>
                                    </div>
                                  </div><!-- Col -->
                                              <div class="col-sm-6">
                                    <div class="form-group">
                                      <label class="control-label">Harga Per Bulan</label>
                                      <input type="text" class="form-control" placeholder="Harga per bulan" name="hargaBulanan" id="hargaBulanan" value="<?= $r->harga_bulanan; ?>">
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
                                    <textarea id="deskripsi" name="deskripsi" class="form-control" maxlength="1000" rows="8" placeholder="This textarea has a limit of 1000 chars." value="<?= $r->deskripsi; ?>"><?= $r->deskripsi; ?></textarea>
                                    <small class="text-danger"><?= form_error('deskripsi'); ?></small>
                                  </div>
                                </div>
                              </div>
                              <input type="submit" value="Ajukan Ruangan" class="btn btn-primary submit">
                            </form>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- End Modal Edit -->
                      <!-- Start Modal Delete -->
                      <div class="modal fade" id="delete<?= $r->id_ruangan ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Hentikan Penyewaan Ruangan</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <div>Apakah anda yakin ingin menonaktifkan penyewaan pada ruangan ini?</div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                              <a href="<?php echo base_url()?>index.php/partner/manageruangan/nonaktif/<?= $r->id_ruangan ?>" type="button" class="btn btn-primary">Hapus</a>
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