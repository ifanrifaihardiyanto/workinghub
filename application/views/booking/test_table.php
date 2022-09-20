<?php foreach($result->ruangan as $index => $r): ?>
                  <div id="listRuangan" class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                        <h6 class="card-title">Data Ruangan</h6>
                        <div><?= $r->nama_ruangan ?></div>
                        <div id="datatables"></div>
                      </div>
                    </div>
                  </div><?php endforeach; ?>
<?= $this->pagination->create_links(); ?>