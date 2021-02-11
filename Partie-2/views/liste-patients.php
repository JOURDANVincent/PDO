
<!-- Start Main Row -->
<div id=mainContent class="row h-100 justify-content-center align-items-center">

    <img id="bgAjoutPatient" class="img-fluid text-center" src="assets/img/addPatient.jpg" alt="Photo du chu d'amiens">

    <div class="col-4 justify-content-center bg8 bdc1 bl8 sha1">

        <h4 class="txt1 text-center my-3">Liste des patients</h4>

        <table class="table text-center">

            <thead>
                <tr class="txt1">
                    <th scope="col">#</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Prénom</th>
                </tr>
            </thead>

            <tbody>
                
                <?php
                    
                    foreach($patients_list as $patient) { ?>

                        <tr>
                            <td><?= $patient->id ?></td>
                            <td><?= $patient->lastname ?></td>
                            <td><?= $patient->firstname ?></td>
                        </tr>

                <?php } ?>

            </tbody>

        </table>

    </div>

</div>








