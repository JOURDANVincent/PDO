<?php

    // élément requis
    require dirname(__FILE__).'/../models/main_model.php';
    require dirname(__FILE__).'/../utils/regex.php';


    // ---------------traitement du contenu à afficher ---------------------------//

    if ($_SERVER['REQUEST_METHOD'] == 'GET' && !empty($_GET['id'])) {


        // traitement de la page demandée
        $id = intval(trim(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT)));

        // appel du header
        require dirname(__FILE__).'/../views/templates/header.php';

        switch ($id) {

            case 0:
                echo "i égal 0";
                break;

            case 1:
               // appel du formualaire ajout de patient
                include dirname(__FILE__).'/../views/ajout-patient.php';
                break;

            case 2:
                echo "i égal 2";
                break;
        }

         // appel du footer
         require dirname(__FILE__).'/../views/templates/footer.php';
    }


    // ---------------traitement formulaire ajout patient ---------------------------//

    else if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)) {
        

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
                header('location: index.php');
                
            } else {

                // affichage pbm de doublon
                $form_error['bdd'] = 'Pbm de doublon sur adresse mail !!';

                // appel du header
                require dirname(__FILE__).'/../views/templates/header.php';

                // rappel du header
                require dirname(__FILE__).'/../views/ajout-patient.php';

                // appel du footer
                require dirname(__FILE__).'/../views/templates/footer.php';

            }
            
        } 

        
    } 
    
?>


