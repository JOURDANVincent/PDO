
<!-- Start Main Row -->
<div class="row h-100 justify-content-center align-items-center">

    <img id="bgAjoutPatient" class="img-fluid text-center" src="assets/img/doctor.jpg" alt="Photo du chu d'amiens">

    <?php 
        if(!empty($form_error['update_patient'])) { ?>

            <div class="col-12 bddAlert alert alert-danger alert-dismissible align-self-start">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Error!</strong> <?= $form_error['update_patient'] ?>
            </div>
        <?php
    }  ?>

    <div id="mainContent" class="form-group col-12 col-lg-5 bdc1 bl8 sha1 bgForm">

        <!------------------------------------------ nouveau patient ------------------------------------------------>

        <form action="index.php" method="POST">

            <fieldset class="mb-2">

                <legend class="txt1 py-3 text-center">Modifier patient</legend>

                <input 
                    class="form-control <?= (!empty($form_error['lastname'])) ? 'bgError' : '' ;?> mb-2" 
                    type="text" 
                    name="lastname" 
                    placeholder="nom" 
                    value="<?= (!empty($_POST['lastname'])) ? $_POST['lastname'] : $patient_profil->lastname ;?>"
                    pattern ="^[a-zA-Z\-][^0-9]{2,}$" 
                    title="2 lettres mini / aucun chiffre ou caractères spéciaux"
                >
                <div class="regexAlert mb-2 mt-0 pl-3"><?= $form_error['lastname'] ?? '' ;?></div>

                <input 
                    class="form-control <?= (!empty($form_error['firstname'])) ? 'bgError' : '' ;?> mb-2" 
                    type="text" 
                    name="firstname" 
                    placeholder="prénom" 
                    value="<?= (!empty($_POST['firstname'])) ? $_POST['firstname'] : $patient_profil->firstname ;?>"
                    required pattern ="^[a-zA-Z\-][^0-9]{2,}$" title="2 lettres mini / aucun chiffre ou caractères spéciaux"
                >
                <div class="regexAlert mb-2 mt-0 pl-3"><?= $form_error['firstname'] ?? '' ;?></div>

                <input 
                    class="form-control col-4 <?= (!empty($form_error['birthdaybirthdate'])) ? 'bgError' : '' ;?> mb-2" 
                    type="date" 
                    name="birthdate" 
                    value="<?= (!empty($_POST['birthdate'])) ? $_POST['birthdate'] : $patient_profil->birthdate ;?>"
                    required  
                    title="format jj-mm-aaaa (ex: 20/12/1983)"
                > 
                <div class="regexAlert col-4 mb-2 mt-0"><?= $form_error['birthdate'] ?? '' ;?></div>

                <input class="form-control <?= (!empty($form_error['phone'])) ? 'bgError' : '' ;?> mb-2" 
                    type="phone" 
                    name="phone" 
                    placeholder="téléphone" 
                    value="<?= (!empty($_POST['phone'])) ? $_POST['phone'] : $patient_profil->phone ;?>"
                    required pattern="^(0|\+33)[1-9]( *[0-9]{2}){4}$" 
                    title="ex: 06-12-34-56-78"
                >
                <div class="regexAlert mb-2 mt-0 pl-3"><?= $form_error['phone'] ?? '' ;?></div>

                <input 
                    class="form-control <?= (!empty($form_error['mail'])) ? 'bgError' : '' ;?> mb-2" 
                    type="email" name="mail" 
                    placeholder="email" 
                    value="<?= (!empty($_POST['mail'])) ? $_POST['mail'] : $patient_profil->mail ;?>"
                    required pattern="^[\w-\.]+@([\w-]+\.)+\.[\w-]{2,5}$" 
                    title="ex: contact@moi.fr"
                >
                <div class="regexAlert mb-2 mt-0 pl-3"><?= $form_error['mail'] ?? '' ;?></div>

            </fieldset>  

            <!------------------------------------------ submit ------------------------------------------------>
            <div class="text-center my-4">
                <input type="hidden" name="type" value="2">
                <input type="hidden" name="id_patient" value="<?= $patient_profil->id ?>">
                <input class="btn bdc1 px-5" type="submit" value="modifier">
            </div>  

        </form>

    </div>

</div>