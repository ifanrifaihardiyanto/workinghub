<?php
// print_r($gedung);
$this->load->helper('form');
$error = $this->session->flashdata('error');
$success = $this->session->flashdata('success');
?>
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Table</a></li>
        <li class="breadcrumb-item active" aria-current="page">List Image</li>
    </ol>
</nav>

<?php
// print_r($list['image']);
?>

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
                <div class="alert alert-icon-warning" role="alert">
                    <i data-feather="alert-circle"></i>
                    Sisa upload image anda sebanyak <?= $list['remaining_uploads'] ?> image!
                </div>
                <div class="d-flex justify-content-between">
                    <h6 class="card-title">List Image</h6>
                    <?php
                    $disabled = "";
                    if ($list['remaining_uploads'] == 0) {
                        $disabled = "disabled";
                    }
                    ?>
                    <button type="button" class="btn btn-info btn-icon" data-toggle="modal" data-target="#tambah"
                        <?= $disabled ?>><i data-feather="plus-circle"></i></button>
                </div>
                <div class="table-responsive">
                    <table id="dataTableExample" class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Image</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (empty($list['image'])) {
                            ?>
                            <tr>
                                <td colspan="100%"> Data kosong </td>
                            </tr>
                            <?php } else {
                                foreach ($list['image'] as $index => $p) :
                                    if (!empty($p->image)) {
                                        $data_gambar = explode(', ', $p->image);
                                    }

                                    $cntDataGambar = count($data_gambar);
                                    for ($i = 0; $i < $cntDataGambar; $i++) {
                                        $data_gambar = explode('workinghub', $data_gambar[$i]);
                                    }
                                ?>
                            <tr>
                                <td><?= ++$index ?></td>
                                <td><img src="<?php echo base_url(); ?><?= $data_gambar[1] ?>" alt=""></td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-icon" data-toggle="modal"
                                        data-target="#update<?= $p->id ?>"><i data-feather="eye"></i></button>
                                </td>
                            </tr>
                            <?php
                                endforeach;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Start Modal Non Aktivasi -->
<div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah data image
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form
                    action="<?php echo base_url(); ?>partner/manageruangan/insert_or_update_image/<?= $list['id_ruangan'] ?>"
                    method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>File upload</label>
                                <input type="file" name="image[]" id="image" class="file-upload-default" multiple>
                                <div class="input-group col-xs-12">
                                    <input type="text" class="form-control file-upload-info" disabled=""
                                        placeholder="Upload Image">
                                    <span class="input-group-append">
                                        <button class="file-upload-browse btn btn-primary" type="button">Browse</button>
                                    </span>
                                </div>
                            </div>
                        </div>
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