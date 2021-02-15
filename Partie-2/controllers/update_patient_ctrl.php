<?php

    // élément requis
    require dirname(__FILE__).'/../models/Patient.php';
    require dirname(__FILE__).'/../utils/regex.php';


    // traitement de l'id envoyé
    $id = intval(trim(filter_input($post, 'id', FILTER_SANITIZE_NUMBER_INT)));

    // récupère le profil en fonction de l'id patient
    $patient_profil = Patient::get_patient_profil($id);


    if (!$patient_profil) {

        // si erreur on renvoi sur liste des patients
        $bdd_alert  = 'Erreur accès profil du patient : identifiant inconnu';
        header('location: index.php?ctrl=2&alert_type=danger&bdd_alert='.$bdd_alert.'');
    }


    if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)) {


        // appel du formulaire patient
        require dirname(__FILE__).'/../functions/form_traitment.php';
        

        // ---------------------------------------------- envoie info vers DB ----------------------------------------------------//

        if (empty($form_error)) {

            // on instancie un nouvel objet patient pour update
            $update_patient = new Patient($lastname, $firstname, $birthdate, $phone, $mail, $id);

            // on envoi en BDD
            if ($update_patient->update_patient()) {
                
                $bdd_alert = 'Mise à jour des données du patient: '.$lastname.' '.$firstname.', réussie !';
                // retour page d'accueil
                header('location: index.php?ctrl=2&alert_type=success&bdd_alert='.$bdd_alert.'');
                
            } else {

                // bdd alert message
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

    // appel de la page ajouter patient
    include dirname(__FILE__).'/../views/modifier-patient.php';

    // appel du footer
    require dirname(__FILE__).'/../views/templates/footer.php';


    
?>



