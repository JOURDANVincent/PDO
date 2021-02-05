<?php

    require 'views/templates/header.php';

    $form_error = [];


    if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)) {

        if ($_POST['form'] == 'newPatient' ) {

            include('controllers/ajout-patient_controller.php');
        }
        
    }

    // contrôle de l'id et redirection vers controllers
    else if ($_SERVER['REQUEST_METHOD'] == 'GET' && !empty($_GET['id'])) {

        $id =  intval($_GET['id']);

        ($id == 1) ? include ('controllers/ajout-patient_controller.php') : '';
       

    } else {

        include('views/home.php');

    }


    require 'views/templates/footer.php';
