
<!-- Start Main Row -->
<div id='' class="row h-100 justify-content-center align-items-center">

    <img id="bgAjoutPatient" class="img-fluid text-center" src="assets/img/UnAqLO.jpg" alt="Photo du chu d'amiens">

    
    <div class="col-4 justify-content-center">

        <!-- <h4 class=" txt1 text-center my-3">Profil du patient</h4> -->

        <div class="card py-3 bl8 bdc1 sha1 bg8" >

            <div class="text-center">
                <img class="card-img-top img-fluid" style="max-width:150px;" src="assets/icon/addPatient.png" alt="Card image cap">
            </div>

            <div class="card-body">
                <h5 class="card-title">Profil patient</h5>
                <div>nom <span class="txt1"><?= $patient_profil->lastname?></span></div>
                <div>prenom <span class="txt1"><?= $patient_profil->firstname?></span></div>
                <div>date de naissance <span class="txt1"><?= $patient_profil->birthdate?></span></div>
                <div>téléphone <span class="txt1"><?= $patient_profil->phone?></span></div>
                <div>email <span class="txt1"><?= $patient_profil->mail?></span></div>
                <div class="text-center">
                    <a href="index.php?ctrl=2" class="btn bgW mt-4 mr-3 px-4">Retour</a>
                    <a href="index.php?ctrl=4&id=<?= $patient_profil->id ?>" class="btn bg1 bdc1 mt-4 px-4">Modifier</a>
                </div>
            </div>

        </div>
    </div>

</div>