<?php

    // élément requis
    require dirname(__FILE__).'/../models/Appointment.php';
    require dirname(__FILE__).'/../utils/regex.php';


    // bbd: récupère liste des rendez-vous
    $appointments_list = Appointment::get_appointments_list();

    if (!$appointments_list) {

        // si erreur on renvoi sur liste des appointments
        $bdd_alert  = 'Erreur accès liste des rendez-vous : identifiant inconnu';
        header('location: index.php?alert_type=danger&bdd_alert='.$bdd_alert.'');
    }

    //récupère les messages d'alerte success et danger
    if(!empty($_GET['bdd_alert']) && !empty($_GET['alert_type'])) {  
        $bdd_alert = trim(filter_input(INPUT_GET, 'bdd_alert', FILTER_SANITIZE_STRING));
        $alert_type = trim(filter_input(INPUT_GET, 'alert_type', FILTER_SANITIZE_STRING));
    }


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



