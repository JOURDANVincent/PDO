<?php

    // exercice 1: afficher tous les clients de la base colyseum

    $server_name = 'localhost';
    $db_name = 'colyseum';
    $server_user = 'root';
    $server_password = '';

    //On essaie de se connecter
    try{

        $pdo = new PDO(
            "mysql:host=$server_name;dbname=$db_name", $serveruser, $serverpassword,
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ]
        );

        echo '<div class="alert alert-success">Connexion BDD OK !! <br></div>';

        // insertion d'une valeur dans une table existante
        $sql = "SELECT * FROM `clients`";

        // déclare une variable qui recoit la réponse
        $query = $pdo->query($sql);

        // traitement de la réponse
        $posts = $query->fetchAll();

        foreach($posts as $post): ?>
        <div><? $post->name ?></div>
        <?php endforeach;

    }
    
    /*On capture les exceptions si une exception est lancée et on affiche
    *les informations relatives à celle-ci*/
    catch(PDOException $e){
        echo '<div class="alert alert-danger">Erreur : '. $e->getMessage().'</div>';
    }

    // on ferme la connexion (en détruisant l'objet on supprime les infos de connexion)
    echo '<div style="color:white">Fermeture de la connexion..<br></div>';
    $pdo = null;