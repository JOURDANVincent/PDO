
<!-- Start Main Row -->
<div id='' class="row h-100 justify-content-center align-items-center">

    <img id="wall" class="img-fluid text-center" src="assets/img/stetoscope.jpg" alt="Photo du chu d'amiens">

    <?php if(!empty($alert_msg)) : ?>
        <div class="col-12 alert alert-<?= $alert_type ?? 'danger' ?> alert-dismissible align-self-start">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <?= $alert_msg ?>
        </div>
    <?php endif ?>

    <div class="col-4 justify-content-center">
        <div class="card pt-4 bl8 bdc1 sha1 bg8" >

            <div class="text-center">
                <img class="card-img-top img-fluid" style="max-width:150px;" src="assets/icon/appointment.svg" alt="Card image cap">
            </div>

            <div class="card-body">
                <h5 class="card-title">Rendez-vous</h5>
                <div class="mb-3">le <span class="txt1"><?= $date?></span> à <span class="txt1"><?= $hour?></span></div>
                <div>avec Mr <span class="txt1"><?= $appointment_data->lastname.' '.$appointment_data->firstname?></span></div>
                
                <div>téléphone <span class="txt1"><?= $appointment_data->phone?></span></div>
                <!-- <div>email <span class="txt1"><?php //$appointment_data->mail?></span></div> -->

                <div class="text-center">
                    <a href="index.php?ctrl=6" class="btn bgW mt-4 mr-3 px-4">Retour</a>
                    <a href="index.php?ctrl=8&idA=<?= $appointment_data->idAppointments ?>&idP=<?= $appointment_data->idPatients ?>" class="btn bg1 bdc1 mt-4 px-4">Modifier</a>
                </div>
            </div>

        </div>
    </div>

</div>








