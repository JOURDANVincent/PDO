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

    public static function get_last_id() {

        try{  //On essaie de se connecter

            $pdo = Database::connect();

            // Préparation de la requête : demande id dernier enregistrement
            $sql = "SELECT MAX(`id`) as 'id' FROM `appointments`;";

            // exécute la requête
            $sth = $pdo->query($sql);

            //retourne le dernier id enregistré
            return $sth->fetch();

        } catch(PDOException $e){  // sinon on capture les exceptions si une exception est lancée et on affiche les informations relatives à celle-ci*/
            
            return $e->getCode();
        }
    }

    public static function get_appointments_list($offset = 0, $limit = 10) {
        
        try{  //On essaie de se connecter

            $pdo = Database::connect();

            // demande liste des patients
            $sql = "SELECT 
                        `appointments`.`id` AS `id`, `dateHour`, `lastname`, `firstname`, `mail`, `idPatients`
                    FROM 
                        `appointments` 
                    INNER JOIN 
                        `patients` 
                    ON 
                        `appointments`.`idPatients` = `patients`.`id` 
                    LIMIT 
                        :sql_offset, :sql_limit;";
    
            // déclare une variable qui recoit la réponse
            $sth = $pdo->prepare($sql);

            // association des marqueurs nominatif via méthode bindvalue
            $sth->bindValue(':sql_offset', $offset, PDO::PARAM_INT);
            $sth->bindValue(':sql_limit', $limit, PDO::PARAM_INT);

            // envoi et retourne de la requête préparée
            $sth->execute();

            // traitement et envoi réponse
            return $sth->fetchAll();
            
        } catch(PDOException $e){  // sinon on capture les exceptions si une exception est lancée et on affiche les informations relatives à celle-ci*/
            
            return $e->getCode();
        }
        
    }

    public static function get_appointment_data($id, $idPatients) {
        
        try{  //On essaie de se connecter

            $pdo = Database::connect();

            // demande liste des patients
            $sql = "SELECT 
                        `appointments`.`id` AS `id`, `dateHour`, `lastname`, `firstname`, `phone`, `mail`, `idPatients`
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
            return $sth->fetch();
            
        } catch(PDOException $e){  // sinon on capture les exceptions si une exception est lancée et on affiche les informations relatives à celle-ci*/
    
            return $e->getCode();
        }
        
    }

    public static function get_patients_appointments($id, $idPatients) { // à adapter en fonction tousles rdv d'un patient ...
        
        try{  //On essaie de se connecter

            $pdo = Database::connect();

            // demande liste des patients
            $sql = "SELECT 
                        `appointments`.`id` AS `id`, `dateHour`, `lastname`, `firstname`, `phone`, `mail`, `idPatients`
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
            return $sth->fetch();
            
        } catch(PDOException $e){  // sinon on capture les exceptions si une exception est lancée et on affiche les informations relatives à celle-ci*/
    
            return $e->getCode();
        }
        
    }

    public static function get_total_appointments() {

        try{  //On essaie de se connecter

            $pdo = Database::connect();

            // Préparation de la requête 
            $sql = "SELECT COUNT(`id`) FROM `appointments`;";
            $sth = $pdo->query($sql);

            // envoi le nombre de rendez-vous enregistrés
            return $sth->fetchColumn();
            
        } catch(PDOException $e){  // sinon on capture les exceptions si une exception est lancée et on affiche les informations relatives à celle-ci*/
            
            return $e->getCode();
        }
        
    }
}