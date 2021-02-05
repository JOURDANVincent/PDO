<?php

    $exercices = 
    [
        'Afficher tous les clients',
        'Afficher tous les types de spectacles possibles',
        'Afficher les 20 premiers clients',
        'N\'afficher que les clients possédant une carte de fidélité.',
        'Afficher uniquement le nom et le prénom de tous les clients dont le nom commence par la lettre "M".
            Les afficher comme ceci :
            Nom : Nom du client
            Prénom : Prénom du client
            Trier les noms par ordre alphabétique.',
        'Afficher le titre de tous les spectacles ainsi que l\'artiste, la date et l\'heure.
         Trier les titres par ordre alphabétique. Afficher les résultat comme ceci : Spectacle par artiste, le date à heure.',
         'Afficher tous les clients comme ceci :
         Nom : Nom de famille du client
         Prénom : Prénom du client
         Date de naissance : Date de naissance du client
         Carte de fidélité : Oui (Si le client en possède une) ou Non (s\'il n\'en possède pas)
         Numéro de carte : Numéro de la carte fidélité du client s\'il en possède une.'
    ];

    // contrôle de l'id et redirection vers controllers
    if ($_SERVER['REQUEST_METHOD'] == 'GET' && !empty($_GET['id'])) {

        $id =  intval($_GET['id']);
        //echo 'id = ' . $id;

        include ('controllers/ex'.$id.'.php');

    } else {

        include ('controllers/ex1.php');
    }


