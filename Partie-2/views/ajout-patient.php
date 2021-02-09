
<img id="bgAjoutPatient" class="img-fluid text-center" src="assets/img/addPatient.jpg" alt="Photo du chu d'amiens">

<div id="mainContent" class="form-group col-12 col-lg-5 bdc1 bl8 sha1 bgForm">

    <!------------------------------------------ nouveau patient ------------------------------------------------>

    <form action="index.php" method="POST">

        <fieldset class="mb-2">

            <legend class="txt1 py-3 text-center">Nouveau patient</legend>

            
            <div class="text-center txt1 py-2"><?= $form_error['bdd'] ?? '' ?></div>

            <input 
                class="form-control <?= (isset($form_error['lastname'])) ? 'bgError' : '' ;?> mb-2" 
                type="text" 
                name="lastname" 
                placeholder="nom" 
                value="<?= (!empty($_POST['lastname'])) ? $_POST['lastname'] : '' ;?>"
                pattern ="^[a-zA-Z\-][^0-9]{2,}$" 
                title="2 lettres mini / aucun chiffre ou caractères spéciaux"
            >
            <div class="regexAlert mb-2 mt-0 pl-3"><?= $form_error['lastname'] ?? '' ;?></div>

            <input 
                class="form-control <?= (isset($form_error['firstname'])) ? 'bgError' : '' ;?> mb-2" 
                type="text" 
                name="firstname" 
                placeholder="prénom" 
                value="<?= (!empty($_POST['firstname'])) ? $_POST['firstname'] : '' ;?>"
                required pattern ="^[a-zA-Z\-][^0-9]{2,}$" title="2 lettres mini / aucun chiffre ou caractères spéciaux"
            >
            <div class="regexAlert mb-2 mt-0 pl-3"><?= $form_error['firstname'] ?? '' ;?></div>

            <input 
                class="form-control col-4 <?= (isset($form_error['birthdaybirthdate'])) ? 'bgError' : '' ;?> mb-2" 
                type="date" 
                name="birthdate" 
                placeholder="jj-mm-aaaa" 
                value="<?= (!empty($_POST['birthdate'])) ? $_POST['birthdate'] : '' ;?>"
                required  
                title="format jj-mm-aaaa (ex: 20/12/1983)"
            > 
            <div class="regexAlert col-4 mb-2 mt-0"><?= $form_error['birthdate'] ?? '' ;?></div>

            <input class="form-control <?= (isset($form_error['phone'])) ? 'bgError' : '' ;?> mb-2" 
                type="phone" 
                name="phone" 
                placeholder="téléphone" 
                value="<?= (!empty($_POST['phone'])) ? $_POST['phone'] : '' ;?>"
                required pattern="^(0|\+33)[1-9]( *[0-9]{2}){4}$" 
                title="ex: 06-12-34-56-78"
            >
            <div class="regexAlert mb-2 mt-0 pl-3"><?= $form_error['phone'] ?? '' ;?></div>

            <input 
                class="form-control <?= (isset($form_error['mail'])) ? 'bgError' : '' ;?> mb-2" 
                type="email" name="mail" 
                placeholder="email" 
                value="<?= (!empty($_POST['mail'])) ? $_POST['mail'] : '' ;?>"
                required pattern="^[\w-\.]+@([\w-]+\.)+\.[\w-]{2,5}$" 
                title="ex: contact@moi.fr"
            >
            <div class="regexAlert mb-2 mt-0 pl-3"><?= $form_error['mail'] ?? '' ;?></div>

        </fieldset>  

        <!------------------------------------------ submit ------------------------------------------------>
        <div class="text-center my-4">
            <input type="hidden" name="form" value="newPatient">
            <input class="btn bdc1 px-5" type="submit" value="ajouter">
        </div>  

    </form>

</div>