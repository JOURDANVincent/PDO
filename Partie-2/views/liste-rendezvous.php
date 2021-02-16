
<!-- Start Main Row -->
<div id='mainContent' class="row h-100 justify-content-center align-items-center">

    <img id="bgAjoutPatient" class="img-fluid text-center" src="assets/img/addPatient.jpg" alt="Photo du chu d'amiens">

    <?php if(!empty($bdd_alert)) : ?>

        <div class="col-12 alert alert-<?= $alert_type ?? 'danger' ?> alert-dismissible align-self-start">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <?= $bdd_alert ?>
        </div>

    <?php endif ?>

    <div class="col-12 col-lg-6 justify-content-center bg8 bdc1 bl8 sha1 mb-5">

        <h4 class="txt1 text-center my-3">Liste des rendez-vous</h4>

        <table class="table table-hover text-center">

            <thead>
                <tr class="txt1">
                    <th scope="col">Date</th>
                    <th scope="col">Heure</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Prénom</th>
                </tr>
            </thead>

            <tbody>
                
                <?php
                    
                    foreach($appointments_list as $appointment) { 
                        
                        //echo $appointment->dateHour;
                        // on déclare une variable $date et une $hour
                        $date = implode('/', explode('-', explode(' ', $appointment->dateHour)[0]));
                        $hour = explode(' ', $appointment->dateHour)[1]; ?>

                        <tr onclick="location.href='index.php?ctrl=7&idPatients=<?= $appointment->idPatients ?>&idAppointment=<?= $appointment->id ?>'">
                            <td><?= $date ?></td>
                            <td><?= $hour ?></td>
                            <td><?= $appointment->lastname ?></td>
                            <td><?= $appointment->firstname ?></td>
                        </tr>

                <?php } ?>

            </tbody>

        </table>

        <div class="text-center mb-3 txt1">
            <!-- <a href="index.php?ctrl=2&limit=10&offset=<?= ($sql_offset - 10) ?>"><span class="mx-2">précédent</span></a>
            <a href="index.php?ctrl=2&limit=10&offset=<?= ($sql_offset + 10) ?>"><span class="mx-2">suivant</span></a> -->
            <!-- <span class="mx-2"><?= $number_of_patient.' patients' ?></span> -->
        </div>

    </div>

</div>








