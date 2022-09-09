<?php
$user = $this->session->userdata('user');
$this->load->helper('form');
$error = $this->session->flashdata('error');
$success = $this->session->flashdata('success');
?>
<div class="grid-margin">
</div>
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

				<h6 class="card-title">Data Pribadi</h6>
				<form action="<?php echo base_url(); ?>index.php/manageuser/edit" method="post">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Nama</label>
								<input type="text" class="form-control" placeholder="Nama" name="nama" id="nama" value="<?= $data->profile[0]->nama; ?>">
								<small class="text-danger"><?= form_error('nama'); ?></small>
							</div>
						</div><!-- Col -->
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">NIK</label>
								<input type="text" class="form-control" placeholder="NIK" name="nik" id="nik" value="<?= $data->profile[0]->nik_ktp; ?>">
								<small class="text-danger"><?= form_error('nik'); ?></small>
							</div>
						</div><!-- Col -->
					</div><!-- Row -->
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Nomor Telepon</label>
								<input type="text" class="form-control" placeholder="Nomor Telepon" name="noTelp" id="noTelp" value="<?= $data->profile[0]->no_tlp; ?>">
								<small class="text-danger"><?= form_error('noTelp'); ?></small>
							</div>
						</div><!-- Col -->
						<?php if (in_array($user[0]->role, ['Partner','Pemesan'])) : ?>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Nomor Rekening Bank BNI</label>
								<input type="number" class="form-control" placeholder="Nomor Rekening Bank BNI" name="rekBNI" id="rekBNI" value="<?= $data->profile[0]->rek_bni; ?>">
								<small class="text-danger"><?= form_error('rekBNI'); ?></small>
							</div>
						</div><!-- Col -->
						<?php endif; ?>
					</div><!-- Row -->
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Tempat Lahir</label>
								<input type="text" class="form-control" placeholder="Tempat Lahir" name="tmptLahir" id="tmptLahir" value="<?= $data->profile[0]->tempat_lahir; ?>">
								<small class="text-danger"><?= form_error('tmptLahir'); ?></small>
							</div>
						</div><!-- Col -->
						<?php if (in_array($user[0]->role, ['Partner','Pemesan'])) : ?>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Nomor Rekening Bank BRI</label>
								<input type="text" class="form-control" placeholder="Nomor Rekening Bank BRI" name="rekBRI" id="rekBRI" value="<?= $data->profile[0]->rek_bri; ?>">
								<small class="text-danger"><?= form_error('rekBRI'); ?></small>
							</div>
						</div><!-- Col -->
						<?php endif; ?>
					</div><!-- Row -->
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Tanggal Lahir</label>
								<input type="date" class="form-control" placeholder="Tanggal Lahir" name="tglLahir" id="tglLahir" value="<?= $data->profile[0]->tanggal_lahir; ?>">
								<small class="text-danger"><?= form_error('tglLahir'); ?></small>
							</div>
						</div><!-- Col -->
						<?php if (in_array($user[0]->role, ['Partner','Pemesan'])) : ?>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Nomor Rekening Bank Mandiri</label>
								<input type="number" class="form-control" placeholder="Nomor Rekening Bank Mandiri" name="rekMandiri" id="rekMandiri" value="<?= $data->profile[0]->rek_mandiri; ?>">
								<small class="text-danger"><?= form_error('rekMandiri'); ?></small>
							</div>
						</div><!-- Col -->
						<?php endif; ?>
					</div><!-- Row -->
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Alamat</label>
								<input type="text" class="form-control" placeholder="Alamat" name="alamat" id="alamat" value="<?= $data->profile[0]->alamat; ?>">
								<small class="text-danger"><?= form_error('alamat'); ?></small>
							</div>
						</div><!-- Col -->
						<?php if (in_array($user[0]->role, ['Partner','Pemesan'])) : ?>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Nomor Rekening Bank BCA</label>
								<input type="number" class="form-control" placeholder="Nomor Rekening Bank BCA" name="rekBCA" id="rekBCA" value="<?= $data->profile[0]->rek_bca; ?>">
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