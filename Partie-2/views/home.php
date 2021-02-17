
<!-- Start Main Row -->
<div class="row h-100 justify-content-center align-items-center">

    <img id="wall" class="img-fluid" src="assets/img/chuAmiens.jpg" alt="Photo du chu d'amiens">

    <?php if(!empty($bdd_alert)) : ?>

        <div class="col-12 alert alert-<?= $alert_type ?? 'danger' ?> alert-dismissible align-self-start">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <?= $bdd_alert ?>
        </div>

    <?php endif ?>

    <div id="homeMessage" class="col-12 bl8 bdcup1 py-3 text-center align-self-end">
        <h1 class="txt1">HOSPITALE 2N</h1>
    </div>

</div>

