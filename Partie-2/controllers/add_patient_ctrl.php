<?php

    // élément requis
    require dirname(__FILE__).'/../models/Patient.php';
    require dirname(__FILE__).'/../utils/regex.php';


    if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)) {


        // appel du formulaire patient
        require dirname(__FILE__).'/../functions/form_traitment.php';
        

        // ---------------------------------------------- envoie info vers DB ----------------------------------------------------//

        if (empty($form_error)) {

            // on crée le nouvel objet patient
            $new_patient = new Patient($lastname, $firstname, $birthdate, $phone, $mail);

            // on envoi en BDD
            if ($new_patient->add_new_patient()) {

                $last_id = Patient::get_last_id();
                
                // retour page d'accueil et affichage message success !
                $bdd_alert = 'nouveau patient: '.$lastname.' '.$firstname.', enregistré en base de données..';
                header('location: index.php?ctrl=3&id='.$last_id->id.'&lastctrl=1&alert_type=success&bdd_alert='.$bdd_alert.'');
                // modifier ctrl=2 par 3 pour afficher le nouveau patient
                
            } else {

                // bdd alert message
                $alert_type = 'danger';
                $bdd_alert = 'L\'adresse email '.$mail.' est déjà enregistré en base de données..';

            }
            
        } 

    } 

    // -----------------------------------------------------------
    // affichage de la vue ajout-patient
    // -----------------------------------------------------------

    // appel du header
    require dirname(__FILE__).'/../views/templates/header.php';

    // appel de la page ajouter patient
    include dirname(__FILE__).'/../views/ajout-patient.php';

    // appel du footer
    require dirname(__FILE__).'/../views/templates/footer.php';

    // -----------------------------------------------------------
    // affichage de la vue ajout-patient
    // -----------------------------------------------------------

?>



