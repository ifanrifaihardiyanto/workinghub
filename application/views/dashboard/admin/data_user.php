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
                <h6 class="card-title">Data User</h6>
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
                        <th>Alamat</th>
                        <th>Role</th>
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
                        <td><?= $q->alamat ?></td>
                        <td><?= $q->role ?></td>
                        <td>
                          <a href="<?php echo base_url()?>index.php/admin/manageuser/hapus/<?= $q->id_user ?>" type="button" class="btn btn-danger btn-icon">hapus</a>
                        </td>
                      </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
					</div>
				</div>

<script>
//   $(document).ready(function () {
//     $('#dataUser').DataTable({
//         ajax: '<?php echo base_url() . "index.php/admin/manageuser/get_data_by_ajax" ?>',
//         columns: [
//             { data: 'nik_ktp' },
//             { data: 'nama' },
//             { data: 'tempat_lahir' },
//             { data: 'tanggal_lahir' },
//             { data: 'no_tlp' },
//             { data: 'alamat' },
//             { data: 'role' },
//             { data: null },
//         ],
//     });
// });
  // getDataRegional();

  // function getDataRegional() {
  //       $(document).ready(() => {
  //           $.ajax({
  //               type: "POST",
  //               url: '<?php echo base_url() . "index.php/admin/manageuser/get_data_by_ajax" ?>',
  //               data: {},
  //               success: (response) => {
  //                   let textHtml = '';

  //                   let keys = Object.keys(response.data);

  //                   if (response.data && keys.length !== 0) {
  //                       $.each(response.data, (user, items) => {
  //                         console.log(items);
  //                         textHtml += `
  //                           <td>${items.nik_ktp}</td>
  //                           <td>${items.nama}</td>
  //                           <td>${items.tempat_lahir}</td>
  //                           <td>${items.tanggal_lahir}</td>
  //                           <td>${items.no_tlp}</td>
  //                           <td>${items.alamat}</td>
  //                           <td>${items.role}</td>
  //                           <td>
  //                             <a href="<?php echo base_url()?>index.php/admin/manageuser/hapus/${items.id_user}" type="button" class="btn btn-danger btn-icon">hapus</a>
  //                           </td>
  //                         `

  //                         textHtml += `</tr>`
  //                       });
  //                   } else {
  //                       textHtml += `<tr>
  //                                       <td colspan="100%" class="text-center">No data found.</td>
  //                                   </tr>`
  //                   }

  //                   $('#dataUser')[0].innerHTML = textHtml;
  //               }
  //           });
  //       });
  //   }
</script>        