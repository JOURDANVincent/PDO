<?php

    // élément requis
    require dirname(__FILE__).'/../models/Appointment.php';
    require dirname(__FILE__).'/../utils/regex.php';


    // récupère le nombre total de patient
    $total_appointments = Appointment::get_total_appointments();

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
    } else if ($sql_offset >= ($total_appointments)) {
        $sql_offset = $sql_offset - $sql_limit;
    } 


    // incrémentation du numéro de liste
    $a = $sql_offset + 1;

    // bbd: récupère liste des rendez-vous
    $appointments_list = Appointment::get_appointments_list($sql_offset, $sql_limit);

    if (!$appointments_list || !is_array($appointments_list)) {

        // si erreur on renvoi sur liste des appointments
        $bdd_alert  = 'code '.$appointments_list.' : Erreur accès liste des rendez-vous';
        header('location: index.php?alert_type=danger&bdd_alert='.$bdd_alert.'');
    }

    //récupère les messages d'alerte success et danger
    $bdd_alert = trim(filter_input(INPUT_GET, 'bdd_alert', FILTER_SANITIZE_STRING));
    $alert_type = trim(filter_input(INPUT_GET, 'alert_type', FILTER_SANITIZE_STRING));


    // -----------------------------------------------------------
    // affichage de la vue liste des rendez-vous
    // -----------------------------------------------------------

    // appel du header
    require dirname(__FILE__).'/../views/templates/header.php';

    // appel de la page ajouter patient
    include dirname(__FILE__).'/../views/liste-rendezvous.php';

    // appel du footer
    require dirname(__FILE__).'/../views/templates/footer.php';

    // -----------------------------------------------------------
    // affichage de la vue liste des rendez-vous
    // -----------------------------------------------------------

?>



