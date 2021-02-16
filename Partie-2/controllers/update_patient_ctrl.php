<?php

    // élément requis
    require dirname(__FILE__).'/../models/Patient.php';
    require dirname(__FILE__).'/../utils/regex.php';


    // traitement de l'id envoyé
    $id = intval(trim(filter_input($post, 'id', FILTER_SANITIZE_NUMBER_INT)));

    // bdd : récupère le profil du patient en fonction de l'id envoyé
    $patient_profil = Patient::get_patient_profil($id);

    if (!$patient_profil) {

        // si erreur on renvoi sur liste des patients
        $bdd_alert  = 'Erreur modification profil du patient';
        header('location: index.php?ctrl=2&alert_type=danger&bdd_alert='.$bdd_alert.'');
    }


    if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)) {


        // appel du formulaire patient
        require dirname(__FILE__).'/../functions/form_traitment.php';
        

        // ---------------------------------------------- envoie info vers DB ----------------------------------------------------//

        if (empty($form_error)) {

            // on instancie un nouvel objet patient pour mise à jour
            $update_patient = new Patient($lastname, $firstname, $birthdate, $phone, $mail, $id);

            // on envoi en BDD
            if ($update_patient->update_patient()) {
                
                // retour page d'accueil et affichage message success !
                $bdd_alert = 'Mise à jour des données du patient: '.$lastname.' '.$firstname.', réussie !';
                header('location: index.php?ctrl=3&id='.$id.'&alert_type=success&bdd_alert='.$bdd_alert.'');
                
            } else {

                // bdd alert message error !
                $alert_type = 'danger';
                $bdd_alert ='Impossible de mettre à jour les données du patient: '.$lastname.' '.$firstname.' ..';

            }
            
        } 
    } 


    // -----------------------------------------------------------
    // affichage de la vue update-patient
    // -----------------------------------------------------------

    // appel du header
    require dirname(__FILE__).'/../views/templates/header.php';

    // appel de la page modifier patient
    include dirname(__FILE__).'/../views/modifier-patient.php';

    // appel du footer
    require dirname(__FILE__).'/../views/templates/footer.php';

    // -----------------------------------------------------------
    // affichage de la vue update-patient
    // -----------------------------------------------------------


    
?>



