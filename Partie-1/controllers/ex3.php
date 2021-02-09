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

        // Afficher les 20 premiers clients.
        $sql = "SELECT * FROM `clients` LIMIT 20";

        // déclare une variable qui recoit la réponse
        $result = $pdo->prepare($sql);
        $result->execute();

        // traitement de la réponse
        $twentyFirstClients = $result->fetchAll();

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

    
    <table class="col-8 table table-dark bdc">

        <thead>
            <tr class="bg2">

                <?php
                    // remplissage du header
                    foreach($twentyFirstClients[0] as $key => $data) {
                        echo '<th class="txt2">' . $key . '</th>';
                    }
                ?>

            </tr>
        </thead>

        <tbody>
            
            <?php // remplissage dynamique du tableau

                if(!empty($twentyFirstClients)) {

                    foreach($twentyFirstClients as $keys => $item) {

                        echo '<tr class="bg2">';

                            foreach($item as $data) {
                                echo '<td>' . (($data != null) ? $data : '-') . '</td>';
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