
<!-- Start Main Row -->
<div id='mainContent' class="row h-100 justify-content-center align-items-center">

    <img id="bgAjoutPatient" class="img-fluid text-center" src="assets/img/addPatient.jpg" alt="Photo du chu d'amiens">

    <?php 
        if(!empty($bdd_alert)) { ?>

            <div class="col-12 alert alert-<?= $alert_type ?? 'danger' ?> alert-dismissible align-self-start">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?= $bdd_alert ?>
            </div>
        <?php 
    }  ?>

    <div class="col-12 col-lg-8 justify-content-center bg8 bdc1 bl8 sha1 mb-5">

        <h4 class="txt1 text-center my-3">Liste des patients</h4>

        <table class="table table-hover text-center">

            <thead>
                <tr class="txt1">
                    <th scope="col">#</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Prénom</th>
                    <th scope="col">Anniversaire</th>
                    <th scope="col">Téléphone</th>
                    <th scope="col">Email</th>
                </tr>
            </thead>

            <tbody>
                
                <?php
                    
                    foreach($patients_list as $patient) { 
                        
                        // on réécrit la date (jj-mm-aaaa)
                        $patient->birthdate = implode('/', array_reverse(explode('-', $patient->birthdate))); ?>

                        <tr onclick="location.href='index.php?ctrl=3&id=<?= $patient->id ?>'">
                            <td><?= $patient->id ?></td>
                            <td><?= $patient->lastname ?></td>
                            <td><?= $patient->firstname ?></td>
                            <td><?= $patient->birthdate ?></td>
                            <td><?= $patient->phone ?></td>
                            <td><?= $patient->mail ?></td>
                            <td><img style="max-width:20px;" src="assets/icon/eye.svg" alt="icon vue"></td>
                        </tr>

                <?php } ?>

            </tbody>

        </table>

        <div class="text-center mb-3 txt1">
            <a href="index.php?ctrl=2&limit=10&offset=<?= ($sql_offset - 10) ?>"><span class="mx-2">précédent</span></a>
            <a href="index.php?ctrl=2&limit=10&offset=<?= ($sql_offset + 10) ?>"><span class="mx-2">suivant</span></a>
            <span class="mx-2"><?= $number_of_patient.' patients' ?></span>
        </div>

    </div>

</div>








