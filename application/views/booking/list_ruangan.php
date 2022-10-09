<?php
foreach ($result->ruangan as $index => $r) :
  if ($r->duration == 'Jam') {
    $harga = $r->hourly_price;
  } elseif ($r->duration == 'Hari') {
    $harga = $r->daily_price;
  } elseif ($r->duration == 'Minggu') {
    $harga = $r->weekly_price;
  } else {
    $harga = $r->monthly_price;
  }
?>
<!-- <div class="col-md-12"> -->
<a href="<?php echo base_url(); ?>search/detail/<?= $r->id . '/' . $r->duration ?>" target="_blank">
    <div class="list-ruangan">
        <div class="card-ruangan">
            <div class="card">
                <div class="row">
                    <div class="col-md-4">
                        <?php
              if (!empty($r->image)) {
                $data_gambar = explode(', ', $r->image);
              }

              $cntDataGambar = count($data_gambar);
              for ($i = 0; $i < $cntDataGambar; $i++) {
                if ($i == 0) {
              ?>
                        <img src="data:image;base64,<?= $data_gambar[$i] ?>" width="100%" height="250">
                        <?php
                }
              }
              ?>
                    </div>
                    <div class="col-md-5">
                        <div class="card-body">
                            <h5 class="card-title"><?= $r->name . ' - ' . $r->name ?></h5>
                            <div class="d-flex justify-content-start">
                                <p class="p-1 card-tipe-ruangan"><?= $r->type ?></p>
                            </div>
                            <br>
                            <p class="card-text">
                                <iconify-icon icon="ci:location-outline" width="28" height="28"></iconify-icon>
                                <?= $r->location ?>
                            </p>
                            <p class="card-text">
                                <iconify-icon icon="tabler:users" width="28" height="28"></iconify-icon>
                                <?= $r->capacity ?> Orang
                            </p>
                            <p class="card-text">
                                <iconify-icon icon="akar-icons:money" width="28" height="28"></iconify-icon>
                                <strong><?= 'Rp ' . number_format($harga, 0, ',', '.') . ' / ' . $r->duration ?></strong>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</a>
<!-- </div> -->
<?php endforeach; ?>
<?= $this->pagination->create_links(); ?>