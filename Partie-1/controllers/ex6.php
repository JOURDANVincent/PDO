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
        $sql = "SELECT `title`,`performer`,`date`,`startTime` FROM `shows` ORDER BY `title`";

        // déclare une variable qui recoit la réponse
        $result = $pdo->prepare($sql);
        $result->execute();

        // traitement de la réponse
        $timetable = $result->fetchAll();

        //var_dump($timetable);

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

        <h5 class="col-4 mb-3">Liste des spectacles</h5>

        <?php // remplissage dynamique du tableau

            if(!empty($timetable)) {

                $data = '';
            
                foreach($timetable as $show){

                    $data .=    '<li class="mb-2">
                                    <span style="color:white">'.$show->title.'</span>
                                    par <span style="color:white">'.$show->performer.'</span>
                                    le <span style="color:white">'.$show->date.'</span>
                                    à <span style="color:white">'.$show->startTime.'</span><br>
                                </li>';
                    
                }

                echo $data;
            }

        ?> 

    </ul>

<?php
    // appel du footer
    require ('views/templates/footer.php');