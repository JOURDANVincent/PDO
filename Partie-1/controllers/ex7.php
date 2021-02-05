<?php

    $server_name = 'localhost';
    $db_name = 'colyseum';
    $dsn = "mysql:host=$server_name;dbname=$db_name";
    $server_user = 'root';
    $server_password = '';
    $error = $msg = '';

    
    try{  //On essaie de se connecter

        $pdo = new PDO(
            $dsn, $server_user, $server_password,
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ]
        );

        // message connexion OK !!
        $msg = '<br>Connexion BDD OK !!';

        // Requête
        $sql = "SELECT * FROM `clients` ORDER BY `lastName`";

        // déclare une variable qui recoit la réponse
        $result = $pdo->prepare($sql);
        $result->execute();

        // traitement de la réponse
        $allClients = $result->fetchAll();

        //var_dump($allClients);

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

    
    <ul id="showList" class="col-12 group-list text-left">

        <h3 class="col-4 mb-3 ">Liste des clients</h3>

        <?php // remplissage dynamique du tableau

            if(!empty($allClients)) {

                $data = '';
            
                foreach($allClients as $client){

                    $data .= '<li> Nom: <span style="color:white">'.$client->lastName.'</span><br></li>';
                    $data .= '<li> Prénom: <span style="color:white">'.$client->firstName.'</span><br></li>';
                    $data .= '<li> Date de naissance: <span style="color:white">'.$client->birthDate.'</span><br></li>';
                    $ans = ($client->card) ? 'oui' : 'non';
                    $data .= '<li> Carte de fidélité: <span style="color:white">'.$ans.'</span><br></li>';
                    if ($ans == 'oui') {
                        $data .= '<li> Numéro de carte: <span style="color:white">'.$client->cardNumber.'</span><br></li>';
                    }
                    $data .= '<br>';
                    
                }

                echo $data;
            }

        ?> 

    </ul>

<?php
    // appel du footer
    require ('views/templates/footer.php');