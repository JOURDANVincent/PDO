<?php

    // élément requis
    require dirname(__FILE__).'/../models/Patient.php';
    require dirname(__FILE__).'/../utils/Admin.php';
    require dirname(__FILE__).'/../utils/regex.php';


    // --------------- -------traitement du contenu à afficher ---------------------------//

    if ($_SERVER['REQUEST_METHOD'] == 'GET' && !empty($_GET['id'])) {


        // traitement de la page demandée en fonction de l'id
        $id = intval(trim(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT)));

        // appel du header
        require dirname(__FILE__).'/../views/templates/header.php';

        switch ($id) {

            case 0:
                // appel de la page d'accueil
                include dirname(__FILE__).'/index.php';
                break;

            case 1:
                // appel du formualaire ajout de patient
                include dirname(__FILE__).'/../views/ajout-patient.php';
                break;

            case 2:
                
                // bbd: récupère liste de spatients
                $admin = new Admin();
                $patients_list = $admin->get_patients_list();

                // appel du formualaire ajout de patient
                include dirname(__FILE__).'/../views/liste-patients.php';
                break;
        }

         // appel du footer
         require dirname(__FILE__).'/../views/templates/footer.php';
    }


    // ------------------------ traitement formulaire ajout patient ---------------------------//

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
            if (!preg_match(R_DATE ,$birthdate)) {
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
        
        // traitement input phone
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

            // on crée le nouvel objet patient
            $new_patient = new Patient($lastname, $firstname, $birthdate, $phone, $mail);

            // on envoi en BDD
            if ($new_patient->add_new_patient()) {
                
                // bdd alert message
                $bdd_alert = $_SESSION['bdd_alert'] = 'nouveau patient enregistré en base de données..<br>Patient: '.$lastname.' '.$firstname;

                // retour page d'accueil
                header('location: index.php');
                
            } else {

                // bdd alert message
                $bdd_alert = $_SESSION['bdd_alert'] = 'L\'adresse email : '.$mail.' est déjà enregistré en base ..';

                // appel du header
                require dirname(__FILE__).'/../views/templates/header.php';

                // appel de la page ajouter patient
                require dirname(__FILE__).'/../views/ajout-patient.php';

                // appel du footer
                require dirname(__FILE__).'/../views/templates/footer.php';

            }
            
        } 

        
    } 
    
?>



