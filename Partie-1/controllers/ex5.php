<?php

    $server_name = 'localhost';
    $db_name = 'colyseum';
    $dsn = "mysql:host=$server_name;dbname=$db_name";
    $server_user = 'colyseum';
    $server_password = 'T7d5i5x8KI2uXd65';
    $error = $msg = '';

    
    try{  //On essaie de se connecter

        $pdo = new PDO(
            $dsn, $server_user, $server_password,
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ]
        );

        // message connexion OK !!
        $msg = '<br>Connexion BDD OK !!';

        // N'afficher que les clients possédant une carte de fidélité.
        $sql = "SELECT `lastName`,`firstName` FROM `clients` WHERE `lastName` LIKE 'M%' ORDER BY `lastName`";

        // déclare une variable qui recoit la réponse
        $PDO_statment = $pdo->prepare($sql);
        $PDO_statment->execute();

        // traitement de la réponse
        $mClients = $PDO_statment->fetchAll();

        //var_dump($mClients);

        // message requête success
        $msg .= '<br>Requête executée avec succès !!';

    } catch(PDOException $e){  // sinon on capture les exceptions si une exception est lancée et on affiche les informations relatives à celle-ci*/
            $error = $e->getMessage().'</div>';
    }

    // on ferme la connexion (en détruisant l'objet on supprime les infos de connexion)
    $msg .= '<br>Fermeture de la connexion..';
    $pdo = null;


    // appel du header
    require ('views/templates/header.php');

?>


<!-- construction du tableau d'affichage -->

    <ul class="col-12 group-list text-left">
 
        <?php
            foreach($mClients as $client){ ?>
                
                <li> Nom: <span style="color:white"><?= $client->lastName ?></span><br></li>
                <li> Prénom: <span style="color:white"><?= $client->firstName ?></span><br><br></li>   

        <?php } ?>
        
    </ul>

<?php
    // appel du footer
    require ('views/templates/footer.php');