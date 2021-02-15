<?php

    // élément requis
    require_once dirname(__FILE__).'/../models/Patient.php';
    require dirname(__FILE__).'/../utils/regex.php';

    
    // traitement de l'id envoyé
    $id = intval(trim(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT)));

    // bdd : récupère les données du patient en fonction de l'id envoyé
    $patient_profil = Patient::get_patient_profil($id);


    if (!$patient_profil) {

        // si erreur on renvoi sur liste des patients
        $bdd_alert  = 'Erreur accès liste patients : identifiant inconnu';
        header('location: index.php?ctrl=2&alert_type=danger&bdd_alert='.$bdd_alert.'');
    }


    // on réécrit la date pour le value d'input date
    $patient_profil->birthdate = implode('/', array_reverse(explode('-', $patient_profil->birthdate)));
    

    // -----------------------------------------------------------
    // affichage de la vue ajout-patient
    // -----------------------------------------------------------

    // appel du header
    require dirname(__FILE__).'/../views/templates/header.php';

    // appel de la page ajouter patient
    include dirname(__FILE__).'/../views/profil-patient.php';

    // appel du footer
    require dirname(__FILE__).'/../views/templates/footer.php';

    // -----------------------------------------------------------
    // affichage de la vue ajout-patient
    // -----------------------------------------------------------

?>



