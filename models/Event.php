<?php

require_once (dirname(__FILE__)."/../utils/database.php");

class Event {
    private $id;
    private $description;
    private $created_at;
    private $deleted_at;      
    private $connectPDO;


    public function __construct($description =''){
        $this->connectPDO = Database::connect();
        $this->setDescriptionEvent($description);
    }

    public function setId($id){
        $this->id = $id;
    }
    public function getId(){
        return $this->id;
    }

    public function setDescriptionEvent($description){
        $this->description = $description;
    }
    public function getDescriptionEvent(){
        return $this->description;
    }

    public function setcreatedAt($created_at){
        $this->created_at = $created_at;
    }
    public function getcreatedAt(){
        return $this->created_at;
    }

    public function setDeletedAt($deleted_at){
        $this->deleted_at = $deleted_at;
    }
    public function getDeletedAt(){
        return $this->deleted_at;
    }



    public function new(){

        try {
            $sql = "INSERT INTO `event`(`description`) 
                    VALUES (:description)";

            $sth = $this->connectPDO->prepare($sql);

            $sth->bindValue(":description", $this->getDescriptionEvent(), PDO::PARAM_STR);


            $sth->execute();
 
            return true;
            
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public static function find() {
        
        try {
            //on récupére les données
            $sql = "SELECT * FROM `event`;";

            $connectPDOStatic = Database::connect();

            $sth = $connectPDOStatic->query($sql);

            $users = $sth->fetch();
            // var_dump($users);
            return $users;

        } catch (PDOException $e) {
            $e = 'Error !';
            return $e;
        }
    }


    /**
     * Mettre à jour le message d'alerte 
     */
    public function update($id) {

        try {
            $sql = "UPDATE `event` SET `description` = :description";

            $sth = $this->connectPDO->prepare($sql);

            $sth->bindValue(":description", $this->getDescriptionEvent(), PDO::PARAM_STR);

            return $sth->execute();
            } catch (PDOException $e) {
                return  $e->getMessage();
            }
    }


    /**
     * Supprimer le message d'alerte 
     */
    public static function delete() {
        
        try {
            //on récupére les données
            $sql = "DELETE FROM `event`;";

            $connectPDOStatic = Database::connect();

            $sth = $connectPDOStatic->prepare($sql);

            

            return $sth->execute();


        } catch (PDOException $e) {
            return $e;
        }
    }

    public function isMessageExists(): bool {
        $sql = "SELECT `description` FROM `event`;";
        $sth = $this->connectPDO->prepare($sql);
        $sth->execute();
        $result = $sth->fetchColumn();
        // var_dump($result);
        
        if ($result === false){
            return false;
        }else{
            return true;
        }        
    }

}