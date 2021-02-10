<?php

class Admin extends Patient {

    public function __construct() {
        
    }

    public function get_patients_list() {

        $pdo = Database::connect();

        try{  //On essaie de se connecter

            // Préparation de la requête
            $sql = "SELECT `id`, `lastname`, `firstname` FROM `patients` ";

            // envoi requête
            $sth = $pdo->query($sql);

            // traitement de la réponse
            $list = $sth->fetchAll();

            var_dump($list);

            // envoi d ela réponse
            return $list;
    
        } catch(PDOException $e){  // sinon on capture les exceptions si une exception est lancée et on affiche les informations relatives à celle-ci*/
                array_push($error_log, $e->getMessage());
                echo $e->getMessage();
        }
    }
}