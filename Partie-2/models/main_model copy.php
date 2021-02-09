<?php

    function db_connect() {

        $server_name = 'localhost';
        $db_name = 'hospitale2n';
        $dsn = "mysql:host=$server_name;dbname=$db_name";
        $server_user = 'hospitale2n';
        $server_password = 'dl6X1gnJpveIGaSh';
        $error = $msg = '';

        $pdo = new PDO(
            $dsn, $server_user, $server_password,
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ]
        );

        // message connexion OK !!
        echo 'Connexion BDD OK !!';

        return $pdo;
    }

    function db_disconnect($pdo) {

        // on détruit l'objet pdo connexion
        $pdo = null;

        // message deconnexion OK !!
        echo 'Déconnexion BDD OK !!';

        return $pdo;
    }

    function new_entry_check($m) {
        
        try{  //On essaie de se connecter

            // demande de connexion 
            $pdo = db_connect();

            // exercice 1: afficher tous les clients de la base colyseum
            $sql = "SELECT COUNT(`mail`) as 'exist' FROM `patients`";
    
            // déclare une variable qui recoit la réponse
            $result = $pdo->prepare($sql);
            $result->execute();

            // traitement de la réponse
            $entry_check_array = $result->fetch();

            $entry_check = $entry_check_array->exist;

            return $entry_check;

    
        } catch(PDOException $e){  // sinon on capture les exceptions si une exception est lancée et on affiche les informations relatives à celle-ci*/
                $error = $e->getMessage().'</div>';
                echo $error;
        }
    }

    function add_new_patient($l,$f,$b,$p,$m) {

        try{  //On essaie de se connecter

            // demande de connexion 
            $pdo = db_connect();

            // controle de doublon
            //new_entry_check($l,$f,$b,$p,$m);
            $entry_check = new_entry_check($m);

            var_dump('check_entry : ', $entry_check);
        
            if ($entry_check == "0"){
                // exercice 1: afficher tous les clients de la base colyseum
                $sql = "INSERT INTO `patients` 
                            (lastname, firstname, birthdate, phone, mail)
                        VALUES ('$l','$f','$b','$p','$m')";

                // déclare une variable qui recoit la réponse
                $result = $pdo->prepare($sql);
                $result->execute();

            } else {

                // affichage pbm de doublon
                echo 'Pbm de doublon sur adresse mail !!';
            }
            

    
        } catch(PDOException $e){  // sinon on capture les exceptions si une exception est lancée et on affiche les informations relatives à celle-ci*/
                $error = $e->getMessage().'</div>';
                echo $error;
        }
        

        // on ferme la connexion (en détruisant l'objet on supprime les infos de connexion)
        db_disconnect($pdo);
        
    }

?>