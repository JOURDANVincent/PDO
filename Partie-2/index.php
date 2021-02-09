<?php


    if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST) || $_SERVER['REQUEST_METHOD'] == 'GET' && !empty($_GET)) {

            //appel du controller nouveau patient
            include dirname(__FILE__).'/controllers/main_controller.php';

    } else {

        // appel du header
        require dirname(__FILE__).'/views/templates/header.php';

        // appel de l apage d'accueil
        include dirname(__FILE__).'/views/home.php';

        // appel du footer
        require dirname(__FILE__).'/views/templates/footer.php';
    }

    

    
