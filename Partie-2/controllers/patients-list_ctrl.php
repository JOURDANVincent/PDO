<?php

    // élément requis
    require_once dirname(__FILE__).'/../models/Patient.php';


    // récupère le nombre total de patient
    $total_patients = Patient::get_total_patients();

    // traitement de limit pour gérer l'affichage
    $sql_limit = intval(trim(filter_input(INPUT_GET, 'limit', FILTER_SANITIZE_NUMBER_INT)));
    if ($sql_limit <= 10) {
        $sql_limit = 10;
    } else {
        $sql_limit = 10;
    }

    // traitement de offset pour gérer l'affichage
    $sql_offset = intval(trim(filter_input(INPUT_GET, 'offset', FILTER_SANITIZE_NUMBER_INT)));
    if($sql_offset <= 0) {
        $sql_offset = 0;
    } else if ($sql_offset >= $total_patients) {
        $sql_offset = $sql_offset - $sql_limit;
    } 


    // bbd: récupère liste de spatients
    $patients_list = Patient::get_patients_list($sql_offset, $sql_limit);
    
    if (!$patients_list || !is_array($patients_list)) {

        // si erreur on renvoi sur page d'accueil avec message erreur
        header('location: index.php?&alert=4');
    }


    // -----------------------------------------------------------
    // affichage de la vue liste des patients
    // -----------------------------------------------------------

    // appel du header
    require dirname(__FILE__).'/../views/templates/header.php';

    // appel de la page liste patient
    include dirname(__FILE__).'/../views/liste-patients.php';

    // appel du footer
    require dirname(__FILE__).'/../views/templates/footer.php';

    // -----------------------------------------------------------
    // affichage de la vue liste des patients
    // -----------------------------------------------------------

?>



