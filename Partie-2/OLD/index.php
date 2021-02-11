<?php

    session_start();

    // récupère variable en session
    $error_log = [($_SESSION['error_log'] ?? '')];

    // déclaration variable générales
    $error_form = [];

    
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST) || $_SERVER['REQUEST_METHOD'] == 'GET' && !empty($_GET['id'])) {

            //appel du controller nouveau patient
            include dirname(__FILE__).'/controllers/main_controller.php';

    } else {

        // appel du header
        require dirname(__FILE__).'/views/templates/header.php';

        // appel de la page d'accueil
        include dirname(__FILE__).'/views/home.php';

        // appel du footer
        require dirname(__FILE__).'/views/templates/footer.php';
    }

    

    
