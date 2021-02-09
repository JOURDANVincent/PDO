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
        $sql = "SELECT `lastName`,`firstName` FROM `clients` WHERE `card` = 1";

        // déclare une variable qui recoit la réponse
        $PDO_statment = $pdo->prepare($sql);
        $PDO_statment->execute();

        // traitement de la réponse
        $loyaltyClients = $PDO_statment->fetchAll();

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

    
    <table class="col-4 table table-dark bdc">

        <h5 class="col-12 mb-3">Clients possédant une carte de fidélité</h5>

        <thead>
            <tr class="bg2">

                <?php
                    // remplissage du header
                    foreach($loyaltyClients[0] as $key => $data) {
                        echo '<th class="txt2">' . $key . '</th>';
                    }
                ?>

            </tr>
        </thead>

        <tbody>
            
            <?php // remplissage dynamique du tableau

                if(!empty($loyaltyClients)) {

                    foreach($loyaltyClients as $keys => $item) {

                        echo '<tr class="bg2">';

                            foreach($item as $data) {
                                echo '<td>' . ($data ? $data : '-') . '</td>';
                            }

                        echo '</tr>';

                    }
                }
            ?>

        </tbody>
        
    </table>


<?php
    // appel du footer
    require ('views/templates/footer.php');