<?php

require dirname(__FILE__). '/../utils/Database.php';


class Patient {

    protected $_id;
    private $_lastname;
    private $_firstname;
    private $_birthdate;
    private $_phone;
    private $_mail;
    protected $_pdo;
    

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

            // Préparation de la requête : compte le nombre d'enregistrement pour une adresse mail donnée
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

            // controle doublon / préésence adresse email     
            if (!$this->new_entry_check()){

                // insérer le nouveau patient
                $sql = "INSERT INTO `patients` 
                            (lastname, firstname, birthdate, phone, mail)
                        VALUES (:lastname, :firstname, :birthdate, :phone, :mail);";
            
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
                echo 'Pbm de doublon sur adresse mail !!';

                return false;
            }
            
        } catch(PDOException $e){  // sinon on capture les exceptions si une exception est lancée et on affiche les informations relatives à celle-ci*/
            //array_push($error_log, $e->getMessage());
            echo $e->getMessage();

            return false;
        }

        // récupère ler dernier id inséré
        $this->_id = $this->_pdo->lastInsertId();
        echo $this->_id;
        
        // on ferme la connexion (en détruisant l'objet on supprime les infos de connexion)
        $this->_pdo = null;
        
    }

    public function update_patient() {

        echo 'date'.$this->_birthdate;
        echo 'id'.$this->_id;
        echo 'id'.$this->_lastname;
        echo 'id'.$this->_firstname;

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
        echo $this->_id;
        
        // on ferme la connexion (en détruisant l'objet on supprime les infos de connexion)
        $this->_pdo = null;
        
    }

    public static function get_patients_list() {

        try{  //On essaie de se connecter

            $pdo = Database::connect();

            // demande liste des patients
            $sql = "SELECT `id`, `lastname`, `firstname` FROM `patients`;";
    
            // déclare une variable qui recoit la réponse
            $result = $pdo->query($sql);

            // traitement de la réponse
            $list = $result->fetchAll();

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

    public static function get_patient_profil($i) {

        try{  //On essaie de se connecter

            $pdo = Database::connect();

            // demande liste des patients
            $sql = "SELECT * FROM `patients` WHERE `id` = ? ;";
    
            // préparation de la requête
            $sth = $pdo->prepare($sql);

            // association des marqueurs nominatif via méthode bindvalue
            $sth->bindValue(1, $i, PDO::PARAM_INT);

            // envoi et retourne de la requête préparée
            $sth->execute();

            // traitement de la réponse
            $profil = $sth->fetch();
            
            $profil->birthdate = implode('/', array_reverse(explode('-', $profil->birthdate)));

            // envoi de la réponse
            return $profil;
            
        } catch(PDOException $e){  // sinon on capture les exceptions si une exception est lancée et on affiche les informations relatives à celle-ci*/
            
            array_push($error_log, $e->getMessage());
            echo $e->getMessage();
            return false;
        }
        
        // on ferme la connexion (en détruisant l'objet on supprime les infos de connexion)
        $pdo = null;
    }
}