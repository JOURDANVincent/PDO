<?php

require_once dirname(__FILE__). '/../utils/Database.php';


class Appointment {

    private $_id;
    private $_dateHour;
    private $_idPatients;
    private $_pdo;
    

    public function __construct($dateHour, $idPatients, $id=0) {

        $this->_dateHour = $dateHour;
        $this->_idPatients = $idPatients;
        $this->_id = $id;
        $this->_pdo = Database::connect();
    }
    

    public function add_new_appointment() {

        try{  //On essaie de se connecter   
            
            $dateHour = implode(' ',explode('T', $this->_dateHour));

            // insérer le nouveau patient
            $sql = "INSERT INTO `appointments` 
                        (dateHour, IdPatients)
                    VALUES (:dateHour, :idPatients);";
        
            // préparation de la requête
            $sth = $this->_pdo->prepare($sql);

            // association des marqueurs nominatif via méthode bindvalue
            $sth->bindValue(':dateHour', $dateHour, PDO::PARAM_STR);
            $sth->bindValue(':idPatients', $this->_idPatients, PDO::PARAM_INT);

            // envoi et retourne de la requête préparée
            return $sth->execute();

            
        } catch(PDOException $e){  // sinon on capture les exceptions si une exception est lancée et on affiche les informations relatives à celle-ci*/
            
            return $e->getCode();
        }
        
    }

    public static function get_appointments_list() {
        
        try{  //On essaie de se connecter

            $pdo = Database::connect();

            // demande liste des patients
            $sql = "SELECT 
                        `appointments`.`id` AS `id`, `dateHour`, `lastname`, `firstname`, `idPatients`
                    FROM 
                        `appointments` 
                    INNER JOIN 
                        `patients` 
                    ON 
                        `appointments`.`idPatients` = `patients`.`id` ;";
    
            // déclare une variable qui recoit la réponse
            $sth = $pdo->query($sql);

            // traitement de la réponse
            $list = $sth->fetchAll();

            // envoi d ela réponse
            return $list;
            
        } catch(PDOException $e){  // sinon on capture les exceptions si une exception est lancée et on affiche les informations relatives à celle-ci*/
            
            return $e->getCode();
        }
        
    }

    public static function get_patient_appointments($id, $idPatients) {
        
        try{  //On essaie de se connecter

            $pdo = Database::connect();

            // demande liste des patients
            $sql = "SELECT 
                        `appointments`.`id` AS `id`, `dateHour`, `lastname`, `firstname`, `idPatients`
                    FROM 
                        `appointments` 
                    INNER JOIN 
                        `patients` 
                    ON 
                        `appointments`.`idPatients` = `patients`.`id` 
                    WHERE 
                        (`appointments`.`id` = :idA AND `idPatients` = :idP) ;";
    
            // déclare une variable qui recoit la réponse
            $sth = $pdo->prepare($sql);

            // association des marqueurs nominatif via méthode bindvalue
            $sth->bindValue(':idA', $id, PDO::PARAM_INT);
            $sth->bindValue(':idP', $idPatients, PDO::PARAM_INT);

            // exécute la requête préparée
            $sth->execute();

            // traitement et envoi d ela réponse
            return $sth->fetchAll();
            
        } catch(PDOException $e){  // sinon on capture les exceptions si une exception est lancée et on affiche les informations relatives à celle-ci*/
    
            return $e->getCode();
        }
        
    }

}