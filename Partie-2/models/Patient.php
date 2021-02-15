<?php

require dirname(__FILE__). '/../utils/Database.php';


class Patient {

    private $_id;
    private $_lastname;
    private $_firstname;
    private $_birthdate;
    private $_phone;
    private $_mail;
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
    

    private function new_entry_check() {
        
        try{  //On essaie de se connecter

            // Préparation de la requête : contrôler l'existance d'une adresse mail avant enregistrement
            $sql = "SELECT COUNT(`mail`) as 'exist' FROM `patients` WHERE `mail` = :m;";
            $sth = $this->_pdo->prepare($sql);

            // association des paramètres
            $sth->bindValue(':m', $this->_mail, PDO::PARAM_STR);   

            // envoie de la requête
            $sth->execute();

            // traitement de la réponse
            $entry_check_array = $sth->fetch();

            // envoi d ela réponse
            return $entry_check_array->exist;
    
        } catch(PDOException $e){  // sinon on capture les exceptions si une exception est lancée et on affiche les informations relatives à celle-ci*/
            
            array_push($error_log, $e->getMessage());
            echo $e->getMessage();

            return false;
        }

    }

    public function add_new_patient() {

        try{  //On essaie de se connecter

            if (!$this->new_entry_check()){ // controle doublon    

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

                // envoi et retourne de la requête préparée
                return $sth->execute();

            } else {

                // affichage pbm de doublon
                //$bdd_alert = 'Pbm de doublon sur adresse mail !!';

                return false;
            }
            
        } catch(PDOException $e){  // sinon on capture les exceptions si une exception est lancée et on affiche les informations relatives à celle-ci*/
            //array_push($error_log, $e->getMessage());
            echo $e->getMessage();

            return false;
        }

        // récupère ler dernier id inséré
        $this->_id = $this->_pdo->lastInsertId();
        
        // on ferme la connexion (en détruisant l'objet on supprime les infos de connexion)
        $this->_pdo = null;

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

            // envoi et retourne de la requête préparée
            return $sth->execute();
            
        } catch(PDOException $e){  // sinon on capture les exceptions si une exception est lancée et on affiche les informations relatives à celle-ci*/
            
            //array_push($error_log, $e->getMessage());
            echo $e->getMessage();

            return false;
        }

        // récupère ler dernier id inséré
        $this->_id = $this->_pdo->lastInsertId();
        //echo $this->_id;
        
        // on ferme la connexion (en détruisant l'objet on supprime les infos de connexion)
        $this->_pdo = null;
        
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

            // envoi et retourne de la requête préparée
            $sth->execute();

            // traitement de la réponse
            $list = $sth->fetchAll();

            // envoi d ela réponse
            return $list;
            
        } catch(PDOException $e){  // sinon on capture les exceptions si une exception est lancée et on affiche les informations relatives à celle-ci*/
            
            array_push($error_log, $e->getMessage());
            echo $e->getMessage();
            return false;
        }
        
        // on ferme la connexion (en détruisant l'objet on supprime les infos de connexion)
        $pdo = null;
    }

    public static function get_total_patients() {

        try{  //On essaie de se connecter

            $pdo = Database::connect();

            // Préparation de la requête : contrôler l'existance d'une adresse mail avant enregistrement
            $sql = "SELECT COUNT(`id`) as 'total' FROM `patients`;";
            $sth = $pdo->prepare($sql);

            // envoie de la requête
            $sth->execute();

            // traitement de la réponse
            $req_total = $sth->fetch();

            // envoi d ela réponse
            return $req_total->total;
            
        } catch(PDOException $e){  // sinon on capture les exceptions si une exception est lancée et on affiche les informations relatives à celle-ci*/
            
            array_push($error_log, $e->getMessage());
            echo $e->getMessage();
            return false;
        }
        
        // on ferme la connexion (en détruisant l'objet on supprime les infos de connexion)
        $pdo = null;
    }

    public static function get_patient_profil($i) {

        try{  //On essaie de se connecter

            $pdo = Database::connect();

            // demande liste des patients
            $sql = "SELECT * FROM `patients` WHERE `id` = :id ;";
    
            // préparation de la requête
            $sth = $pdo->prepare($sql);

            // association des marqueurs nominatif via méthode bindvalue
            $sth->bindValue(':id', $i, PDO::PARAM_INT);

            // envoi et retourne de la requête préparée
            $sth->execute();

            // traitement de la réponse
            $profil = $sth->fetch();

            // envoi de la réponse
            return $profil;
            
        } catch(PDOException $e){  // sinon on capture les exceptions si une exception est lancée et on affiche les informations relatives à celle-ci*/
            
            //array_push($error_log, $e->getMessage());
            echo $e->getMessage();
            return false;
        }
        
        // on ferme la connexion (en détruisant l'objet on supprime les infos de connexion)
        $pdo = null;
    }
}