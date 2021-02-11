<?php

    // déclaration variable générales
    $form_error = [];
    
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)) {

        //appel du controller de formulaire
        include dirname(__FILE__).'/controllers/form_controller.php';

    } else if ($_SERVER['REQUEST_METHOD'] == 'GET' && !empty($_GET['id'])) {

        //appel du controller gestion de contenu
        include dirname(__FILE__).'/controllers/content_controller.php';

    } else {

        // appel du header
        require dirname(__FILE__).'/views/templates/header.php';

        // appel de la page d'accueil
        include dirname(__FILE__).'/views/home.php';

        // appel du footer
        require dirname(__FILE__).'/views/templates/footer.php';
    }

    

    
