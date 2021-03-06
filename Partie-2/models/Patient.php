<?php

require_once dirname(__FILE__). '/../utils/Database.php';


class Patient {

    private $_id;
    private $_lastname;
    private $_firstname;
    private $_birthdate;
    private $_phone;
    private $_mail;
    static $total_patient;
    private $_pdo;


    public function __construct($lastname, $firstname, $birthdate, $phone, $mail, $id=0) {

        $this->_lastname = $lastname;
        $this->_firstname = $firstname;
        $this->_birthdate = $birthdate;
        $this->_phone = $phone;
        $this->_mail = $mail;
        $this->_id = $id;
        $this->_pdo = Database::connect();
    }
    

    private function check_new_entry() {
        
        try{  //On essaie de se connecter

            // Préparation de la requête : contrôler l'existance d'une adresse mail avant enregistrement
            $sql = "SELECT `mail`, COUNT(`mail`) as 'exist' FROM `patients` WHERE `mail` = :m;";
            $sth = $this->_pdo->prepare($sql);

            // association des paramètres
            $sth->bindValue(':m', $this->_mail, PDO::PARAM_STR);   

            // envoie de la requête
            $sth->execute();

            // traitement de la réponse
            $check_entry = $sth->fetch();

            //retourne le nombre d'entrée trouvée
            return $check_entry->exist;

        } catch(PDOException $e){  // sinon on capture les exceptions si une exception est lancée et on affiche les informations relatives à celle-ci*/
            
            return $e->getCode();
        }

    }

    public function add_new_patient() {

        try{  //On essaie de se connecter

            if (!$this->check_new_entry()){ // controle doublon    

                // insérer le nouveau patient
                $sql = "INSERT INTO `patients` 
                            (lastname, firstname, birthdate, phone, mail)
                        VALUES 
                            (:lastname, :firstname, :birthdate, :phone, :mail);";
            
                // préparation de la requête
                $sth = $this->_pdo->prepare($sql);

                // association des marqueurs nominatif via méthode bindvalue
                $sth->bindValue(':lastname', $this->_lastname, PDO::PARAM_STR);
                $sth->bindValue(':firstname', $this->_firstname, PDO::PARAM_STR);
                $sth->bindValue(':birthdate', $this->_birthdate, PDO::PARAM_STR);
                $sth->bindValue(':phone', $this->_phone, PDO::PARAM_STR);
                $sth->bindValue(':mail', $this->_mail, PDO::PARAM_STR);

                // envoi et retourne la requête préparée
                return $sth->execute();

            } else {

                return false;
            }
            
        } catch(PDOException $e){  // sinon on capture les exceptions si une exception est lancée et on affiche les informations relatives à celle-ci*/

            return false;
        }

    }

    public static function get_last_id() {

        try{  //On essaie de se connecter

            $pdo = Database::connect();

            // Préparation de la requête : demande id dernier enregistrement
            $sql = "SELECT MAX(`id`) as 'id' FROM `patients`;";

            // exécute la requête
            $sth = $pdo->query($sql);

            //retourne le dernier id enregistré
            return $sth->fetch();

        } catch(PDOException $e){  // sinon on capture les exceptions si une exception est lancée et on affiche les informations relatives à celle-ci*/
            
            return $e->getCode();
        }
    }

    public static function get_patients_list($offset = 0, $limit = 10) {

        try{  //On essaie de se connecter

            $pdo = Database::connect();

            // demande liste des patients
            $sql = "SELECT * FROM `patients` LIMIT :sql_offset, :sql_limit ;";
    
            // déclare une variable qui recoit la réponse
            $sth = $pdo->prepare($sql);

            // association des marqueurs nominatif via méthode bindvalue
            $sth->bindValue(':sql_offset', $offset, PDO::PARAM_INT);
            $sth->bindValue(':sql_limit', $limit, PDO::PARAM_INT);

            // exécute la requête préparée
            $sth->execute();

            // envoi liste des patients
            return $sth->fetchAll();
            
        } catch(PDOException $e){  // sinon on capture les exceptions si une exception est lancée et on affiche les informations relatives à celle-ci*/
            
            return $e->getCode();
        }
        
    }

    public static function get_total_patients() {

        try{  //On essaie de se connecter

            $pdo = Database::connect();

            // Préparation de la requête 
            $sql = "SELECT COUNT(`id`) FROM `patients`;";
            $sth = $pdo->query($sql);

            // envoi le nombre de patient enregistré
            return $sth->fetchColumn();
            
        } catch(PDOException $e){  // sinon on capture les exceptions si une exception est lancée et on affiche les informations relatives à celle-ci*/
            
            return $e->getCode();
        }
        
    }

    public static function get_patient_profil($id) {

        try{  //On essaie de se connecter

            $pdo = Database::connect();

            // demande liste des patients
            $sql = "SELECT * FROM `patients` WHERE `id` = :id ;";
    
            // préparation de la requête
            $sth = $pdo->prepare($sql);

            // association des marqueurs nominatif via méthode bindvalue
            $sth->bindValue(':id', $id, PDO::PARAM_INT);

            // envoi de la requête préparée
            $sth->execute();

            // envoi du profil demandé
            return $sth->fetch();
            
        } catch(PDOException $e){  // sinon on capture les exceptions si une exception est lancée et on affiche les informations relatives à celle-ci*/
            
            return $e->getCode();
        }

    }

    public function update_patient() {

        try{  //On essaie de se connecter

            // insérer le nouveau patient
            $sql = "UPDATE `patients`
                    SET 
                        `lastname` = :lastname,
                        `firstname` = :firstname,
                        `birthdate` = :birthdate,
                        `phone` = :phone,
                        `mail` = :mail
                    WHERE 
                        `id` = :id ;";
        
            // préparation de la requête
            $sth = $this->_pdo->prepare($sql);

            // association des marqueurs nominatif via méthode bindvalue
            $sth->bindValue(':lastname', $this->_lastname, PDO::PARAM_STR);
            $sth->bindValue(':firstname', $this->_firstname, PDO::PARAM_STR);
            $sth->bindValue(':birthdate', $this->_birthdate, PDO::PARAM_STR);
            $sth->bindValue(':phone', $this->_phone, PDO::PARAM_STR);
            $sth->bindValue(':mail', $this->_mail, PDO::PARAM_STR);
            $sth->bindValue(':id', $this->_id, PDO::PARAM_INT);

            // envoi et retourne la requête préparée
            return $sth->execute();
            
        } catch(PDOException $e){  // sinon on capture les exceptions si une exception est lancée et on affiche les informations relatives à celle-ci*/
            
            return false;
        }
        
    }

}