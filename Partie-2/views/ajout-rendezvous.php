<!-- Start Main Row -->
<div class="row h-100 justify-content-center align-items-center">

    <img id="bgAjoutPatient" class="img-fluid text-center" src="assets/img/doctor.jpg" alt="Photo du chu d'amiens">

    <?php 
        if(!empty($bdd_alert)) { ?>

            <div class="col-12 alert alert-<?= $alert_type ?? 'danger' ?> alert-dismissible align-self-start">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?= $bdd_alert ?>
            </div>
        <?php 
    }  ?>

    <div id="mainContent" class="form-group col-4 bdc1 bl8 sha1 bgForm">

        <!------------------------------------------ nouveau patient ------------------------------------------------>

        <form action="index.php" method="POST">

            <fieldset class="mb-2">

                <legend class="txt1 py-3 text-center">Nouveau rendez-vous</legend>

                <input 
                    class="form-control <?= (!empty($form_error['lastname'])) ? 'bgError' : '' ;?> mb-2" 
                    type="datetime-local" 
                    min="2018-06-07T00:00" 
                    max="2018-06-14T00:00"
                    name="lastname" 
                    placeholder="nom" 
                    value="<?= (!empty($_POST['dateHour'])) ? $_POST['dateHour'] : '2018-06-12T19:30' ;?>"
                    required 
                >
                <div class="regexAlert mb-2 mt-0 pl-3"><?= $form_error['dateHour'] ?? '' ;?></div>
 
            </fieldset>  

            <!------------------------------------------ submit ------------------------------------------------>
            <div class="text-center my-4">
                <input type="hidden" name="which" value="2">
                <input type="hidden" name="type" value="1">
                <!-- <input type="hidden" name="id_patient" value="<?= $patient_profil->id ?>"> -->
                <input class="btn bg1 bdc1 px-5" type="submit" value="ajouter">
            </div>  

        </form>

    </div>

</div>