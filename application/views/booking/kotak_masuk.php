<div class="grid-margin">
</div>

<div class="first-headline-page">
    <div class="container">
        <div class="headline-page">
            <div class="title-page">
                <h4>Kotak Masuk</h4>
            </div>
        </div>
        <div class="data-pemesanan">
            <div class="bd-example">
                <div class="row">
                    <?php
                    if (count($data->profile) === 0) { ?>
                    <div class="col-md-12 pd-btm-10">
                        <div class="alert alert-light text-center" role="alert">Silahkan login untuk melihat histori
                            pesanan anda!</div>
                    </div>
                    <?php
                    } elseif (count($result->notif) === 0) { ?>
                    <div class="col-md-12 pd-btm-10">
                        <div class="alert alert-light text-center" role="alert">Kotak masuk kosong!</div>
                    </div>
                    <?php
                    }

                    foreach ($result->notif[0] as $notify) :
                    ?>
                    <div class="col-md-12 pd-btm-10">
                        <div class="alert alert-info" role="alert"><?= $notify ?></div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>