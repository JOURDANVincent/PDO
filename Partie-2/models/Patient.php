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

    public function __construct($lastname, $firstname, $birthdate, $phone, $mail) {

        $this->_lastname = $lastname;
        $this->_firstname = $firstname;
        $this->_birthdate = $birthdate;
        $this->_phone = $phone;
        $this->_mail = $mail;
        $this->_pdo = Database::connect();
    }
    

    private function new_entry_check() {
        
        try{  //On essaie de se connecter

            // Préparation de la requête (prepare() et bind())
            $sql = "SELECT COUNT(`mail`) as 'exist' FROM `patients` WHERE `mail` = ? ";
            $sth = $this->_pdo->prepare($sql);

            // association des paramètres
            $sth->bindValue(1 , $this->_mail, PDO::PARAM_STR);   

            // envoie de la requête
            $sth->execute();

            // traitement de la réponse
            $entry_check_array = $sth->fetch();

            // envoi d ela réponse
            return $entry_check_array->exist;
    
        } catch(PDOException $e){  // sinon on capture les exceptions si une exception est lancée et on affiche les informations relatives à celle-ci*/
                $error = $e->getMessage().'</div>';
                echo $error;
        }

    }

    public function add_new_patient() {


        try{  //On essaie de se connecter

            // controle de doublon
            $entry_check = $this->new_entry_check();

            var_dump('check_entry : ', $entry_check);
        
            if ($entry_check == "0"){

                // insérer le nouveau patient
                $sql = "INSERT INTO `patients` 
                            (lastname, firstname, birthdate, phone, mail)
                        VALUES (?, ?, ?, ?, ?)";
            
                // préparation de la requête
                $sth = $this->_pdo->prepare($sql);

                // utilisation méthode bindvalue
                $sth->bindValue(1, $this->_lastname, PDO::PARAM_STR);
                $sth->bindValue(2, $this->_firstname, PDO::PARAM_STR);
                $sth->bindValue(3, $this->_birthdate, PDO::PARAM_STR);
                $sth->bindValue(4, $this->_phone, PDO::PARAM_STR);
                $sth->bindValue(5, $this->_mail, PDO::PARAM_STR);

                // envoi de la requête
                $sth->execute();

                echo 'données enregistrées en base';

                return true;

            } else {

                // affichage pbm de doublon
                echo 'Pbm de doublon sur adresse mail !!';

                return false;
            }
            

        } catch(PDOException $e){  // sinon on capture les exceptions si une exception est lancée et on affiche les informations relatives à celle-ci*/
                $error = $e->getMessage().'</div>';
                echo $error;
        }
        
        // on ferme la connexion (en détruisant l'objet on supprime les infos de connexion)
        Database::disconnect($this->_pdo);
        
    }


    public function get_patient_list() {

        try{  //On essaie de se connecter

            // exercice 1: afficher tous les clients de la base colyseum
            $sql = "SELECT `lastname`, `firstname` FROM `patients`";
    
            // déclare une variable qui recoit la réponse
            $result = $this->_pdo->prepare($sql);
            $result->execute();

            // traitement de la réponse
            $entry_check_array = $result->fetch();

            // envoi d ela réponse
            return $entry_check_array->exist;
            

        } catch(PDOException $e){  // sinon on capture les exceptions si une exception est lancée et on affiche les informations relatives à celle-ci*/
                $error = $e->getMessage().'</div>';
                echo $error;
        }
        
        // on ferme la connexion (en détruisant l'objet on supprime les infos de connexion)
        Database::disconnect($this->_pdo);
    }

}