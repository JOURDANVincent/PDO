<?php

    // élément requis
    require dirname(__FILE__).'/../models/Appointment.php';


    // traitement de l'id et idPatients envoyé
    $id = intval(trim(filter_input($post, 'idAppointment', FILTER_SANITIZE_NUMBER_INT)));
    $idPatients = intval(trim(filter_input($post, 'idPatients', FILTER_SANITIZE_NUMBER_INT)));

    echo 'id'.$id.' patient '.$idPatients;

    // bdd : récupère le profil du patient en fonction de l'id envoyé
    $patient_appointment = Appointment::get_patient_appointments($id, $idPatients);

    if (!$patient_appointment) {

        // si erreur on renvoi sur liste des patients
        $bdd_alert  = 'Erreur modification profil du patient';
        header('location: index.php?ctrl=6&alert_type=danger&bdd_alert='.$bdd_alert.'');
    }


    var_dump($patient_appointment);die;


    // -----------------------------------------------------------
    // affichage de la vue rendez-vous
    // -----------------------------------------------------------

    // appel du header
    require dirname(__FILE__).'/../views/templates/header.php';

    // appel de la page afficher rendez-vous
    include dirname(__FILE__).'/../views/rendezvous.php';

    // appel du footer
    require dirname(__FILE__).'/../views/templates/footer.php';

    // -----------------------------------------------------------
    // affichage de la vue rendez-vous
    // -----------------------------------------------------------


    
?>



