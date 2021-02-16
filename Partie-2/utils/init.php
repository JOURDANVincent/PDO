<?php

    // Donnée de connexion
    session_start();

    // limite d'affichage nombre de ligne et ligne par page

    // déclaration des variables
    $form_error = [];
    $bdd_error = [];

    // tableau titre de page
    $title_page = [
        'Accueil',
        'Ajouter patient',
        'Liste des patients',
        'Profil du patient',
        'Mise à jour du patient',
        'Ajouter rendez-vous',
        'Liste des rendez-vous'
    ];

    // détection méthode
    $post = ($_SERVER['REQUEST_METHOD'] == 'POST') ? INPUT_POST : INPUT_GET;
