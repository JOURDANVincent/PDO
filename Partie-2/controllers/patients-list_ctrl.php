<?php

    // élément requis
    require dirname(__FILE__).'/../models/Patient.php';
    require dirname(__FILE__).'/../utils/regex.php';


    // récupère le nombre total de patient
    $number_of_patient = Patient::get_total_patients();

    // traitement de limit pour gérer l'affichage
    $sql_limit = intval(trim(filter_input(INPUT_GET, 'limit', FILTER_SANITIZE_NUMBER_INT)));
    if ($sql_limit <= 10) {
        $sql_limit = 10;
    } else {
        $sql_limit = 10;
    }

    // traitement de offset pour gérer l'affichage
    $sql_offset = intval(trim(filter_input(INPUT_GET, 'offset', FILTER_SANITIZE_NUMBER_INT)));
    if($sql_offset <= 0) {
        $sql_offset = 0;
    } else if ($sql_offset > ($number_of_patient - $sql_limit)) {
        $sql_offset = $number_of_patient - $sql_limit;
    } else {
        $sql_offset = 0;
    }


    // bbd: récupère liste de spatients
    $patients_list = Patient::get_patients_list($sql_offset, $sql_limit);

    if (!$patients_list) {

        // si erreur on renvoi sur liste des patients
        $bdd_alert  = 'Erreur accès liste patients : identifiant inconnu';
        header('location: index.php?alert_type=danger&bdd_alert='.$bdd_alert.'');
    }

    //récupère les messages d'alerte success et danger
    if(!empty($_GET['bdd_alert']) && !empty($_GET['alert_type'])) {  
        $bdd_alert = trim(filter_input(INPUT_GET, 'bdd_alert', FILTER_SANITIZE_STRING));
        $alert_type = trim(filter_input(INPUT_GET, 'alert_type', FILTER_SANITIZE_STRING));
    }


    // -----------------------------------------------------------
    // affichage de la vue ajout-patient
    // -----------------------------------------------------------

    // appel du header
    require dirname(__FILE__).'/../views/templates/header.php';

    // appel de la page ajouter patient
    include dirname(__FILE__).'/../views/liste-patients.php';

    // appel du footer
    require dirname(__FILE__).'/../views/templates/footer.php';

?>



