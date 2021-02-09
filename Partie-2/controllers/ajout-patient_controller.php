<?php

    //echo 'formulaire';

    require('models/main_model.php');

    // on récupère le fichier des REGEX
    include('utils/regex.php');

    $error = $msg = '';
    
    
    // ---------------traitement formulaire ajout patient ---------------------------//

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)) {
        

        // traitement input lastname
        $lastname = trim(filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING));
        if (!empty($lastname)) {
            if (!preg_match(R_STR ,$lastname)) {
                $form_error['lastname'] = 'données invalides';
            }
        } else {
            $form_error['lastname'] = 'champ obligatoire';
        }


        // traitement input firstname
        $firstname = trim(filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING));
        if (!empty($firstname)) {
            if (!preg_match(R_STR ,$firstname)) {
                $form_error['firstname'] = 'données invalides';
            }
        } else {
            $form_error['firstname'] = 'champ obligatoire';
        }


        // traitement input birthdate
        $birthdate = trim(filter_input(INPUT_POST, 'birthdate', FILTER_SANITIZE_STRING));
        if (!empty($birthdate)) {
            if (empty($birthdate)) {
                $form_error['birthdate'] = 'données invalides';
            }
        } else {
            $form_error['birthdate'] = 'champ obligatoire';
        }


        // traitement input mail //
        $mail = trim(filter_input(INPUT_POST, 'mail', FILTER_SANITIZE_EMAIL));

        if (!empty($mail)) { 
            if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                $form_error['mail'] = '* Le mail n\'est pas valide';
            }
        }
        else {
            $form_error['mail'] = '* champ obligatoire';
        }
        

        // traitement inout phone
        $phone = trim(filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING));
        if (!empty($phone)) {
            if (!preg_match(R_PHONE ,$phone)) {
                $form_error['phone'] = 'données invalides';
            }
        } else {
            $form_error['phone'] = 'champ obligatoire';
        }
        

        // ---------------------------------------------- envoie info vers DB ----------------------------------------------------//

        if (empty($form_error)) {

            // envoi en BDD
            if (add_new_patient($lastname, $firstname, $birthdate, $phone, $mail)) {
                
                // retour page d'accueil
                //header('location: index.php');
            } else {

                // affichage pbm de doublon
                $form_error['bdd'] = 'Pbm de doublon sur adresse mail !!';;
            }
            
        } else {


        }
        

        
    } else if ($_SERVER['REQUEST_METHOD'] == 'GET' && !empty($_GET['id']) && $_GET['id'] == 1) {

        // appel du formualaire ajout de patient
        include('views/ajout-patient.php');
    }

    if (!empty($form_error)) {

        // appel du formualaire ajout de patient
        include('views/ajout-patient.php');
    }
    
    
    
    
?>



