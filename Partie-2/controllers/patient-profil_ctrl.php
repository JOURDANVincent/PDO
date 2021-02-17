<?php

    // élément requis
    require_once dirname(__FILE__).'/../models/Patient.php';
    require dirname(__FILE__).'/../utils/regex.php';

    
    // traitement de l'id envoyé
    $id = intval(trim(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT)));
    $lastctrl = intval(trim(filter_input(INPUT_GET, 'lastctrl', FILTER_SANITIZE_NUMBER_INT)));

    //traitement des messages d'alerte success et danger
    $bdd_alert = trim(filter_input(INPUT_GET, 'bdd_alert', FILTER_SANITIZE_STRING));
    $alert_type = trim(filter_input(INPUT_GET, 'alert_type', FILTER_SANITIZE_STRING));

    // bdd : récupère le profil du patient en fonction de l'id envoyé
    $patient_profil = Patient::get_patient_profil($id);


    if (!$patient_profil || !is_object($patient_profil)) {

        // on renvoi sur liste des patients et affichage error !
        $bdd_alert  = 'code '.$patient_profil.' : Erreur accès au profil patient';
        header('location: index.php?ctrl=2&alert_type=danger&bdd_alert='.$bdd_alert.'');
    }

    // on réécrit la date pour le value d'input date
    $patient_profil->birthdate = implode('/', array_reverse(explode('-', $patient_profil->birthdate)));
    

    // -----------------------------------------------------------
    // affichage de la vue profil-patient
    // -----------------------------------------------------------

    // appel du header
    require dirname(__FILE__).'/../views/templates/header.php';

    // appel de la page profil patient
    include dirname(__FILE__).'/../views/profil-patient.php';

    // appel du footer
    require dirname(__FILE__).'/../views/templates/footer.php';

    // -----------------------------------------------------------
    // affichage de la vue profil-patient
    // -----------------------------------------------------------

?>



