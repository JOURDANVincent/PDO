<?php

    // élément requis
    require_once dirname(__FILE__).'/../models/Patient.php';
    require_once dirname(__FILE__).'/../models/Appointment.php';
    require_once dirname(__FILE__).'/../utils/regex.php';


    // récuper date et heur actuelle
    $actual_date = implode('T',explode(' ', date('Y-m-d H:i')));

    // récupère le nombre total de patient
    $total_patients = Patient::get_total_patients();

    if (!$total_patients) {

        // si erreur on renvoi sur liste des appointments
        $bdd_alert  = 'Erreur accès nombre de  patients';
        header('location: index.php?alert_type=danger&bdd_alert='.$bdd_alert.'');
    }

    // bbd: récupère liste des patients
    $patients_list = Patient::get_patients_list(0, $total_patients);

    if (!$patients_list) {

        // si erreur on renvoi sur liste des appointments
        $bdd_alert  = 'Erreur accès liste des patients : identifiant inconnu';
        header('location: index.php?alert_type=danger&bdd_alert='.$bdd_alert.'');
    }


    if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)) {

        // traitement input datetime
        $dateHour = trim(filter_input(INPUT_POST, 'dateHour', FILTER_SANITIZE_STRING));
        if (!empty($dateHour)) {

            if (!preg_match(R_DATETIME, $dateHour)) {
                $form_error['dateHour'] = 'données invalides';
            }
        } else {
            $form_error['dateHour'] = 'champ obligatoire';
        }   

        $idPatients = intval(trim(filter_input(INPUT_POST, 'idPatients', FILTER_SANITIZE_NUMBER_INT)));


        // ---------------------------------------------- envoie info vers DB ----------------------------------------------------//

        if (empty($form_error)) {

            $date = explode('T', $dateHour)[0];
            $hour = explode('T', $dateHour)[1];

            // on crée le nouvel objet patient
            $new_appointment = new Appointment($dateHour, $idPatients);

            // on envoi en BDD
            if ($new_appointment->add_new_appointment()) {
                
                // retour page d'accueil et affichage message success !!!
                $bdd_alert = 'nouveau rendez-vous: pour Mr blabla le '.$date.' à '.$hour.', enregistré en base de données..';
                header('location: index.php?alert_type=success&bdd_alert='.$bdd_alert.'');
                
            } else {

                // affichage bdd alert error message 
                $alert_type = 'danger';
                $bdd_alert ='Un rendez-vous le '.$date.' à '.$hour.' est déjà enregistré en base de données..';

            }
            
        } 

    } 

    // -----------------------------------------------------------
    // affichage de la vue ajout-rendez-vous
    // -----------------------------------------------------------

    // appel du header
    require dirname(__FILE__).'/../views/templates/header.php';

    // appel de la page ajouter rendez-vous
    include dirname(__FILE__).'/../views/ajout-rendezvous.php';

    // appel du footer
    require dirname(__FILE__).'/../views/templates/footer.php';

    // -----------------------------------------------------------
    // affichage de la vue ajout-rendez-vous
    // -----------------------------------------------------------

?>



