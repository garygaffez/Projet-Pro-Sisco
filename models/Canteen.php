<?php

require_once (dirname(__FILE__)."/../utils/database.php");

class Canteen {
    private $date;
    private $id_child;
    private $connectPDO;

    public function __construct($date = ''){
        $this->connectPDO = Database::connect();
        $this->setDate($date);
    }

    public function setIdChild($id_child) {
        $this->id = $id_child;
    }
    public function getIdChild() {
        return $this->id;
    }

    public function setDate($date) {
        $this->date = $date;
    }
    public function getDate() {
        return $this->date;
    }

    

    public function new(){

        try {
            $sql = "INSERT INTO `canteen`(`date`, `id_child`) 
                    VALUES (:date, :id_child);";

            $sth = $this->connectPDO->prepare($sql);

            $sth->bindValue(":date", $this->getDate(), PDO::PARAM_STR);
            $sth->bindValue(":id_child", $this->getIdChild(), PDO::PARAM_INT);

            $sth->execute();

            return true;
            
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }


    public static function findDateAll() {
        
        try {
            //on récupére les données
            $sql = "SELECT `date` FROM `canteen`;";

            $connectPDOStatic = Database::connect();

            $sth = $connectPDOStatic->prepare($sql);

            $sth->execute();

            $users = $sth->fetchAll();

            //var_dump($users);

            return $users;

        } catch (PDOException $e) {
            $e = 'Error !';
            return $e;
        }
    }


public static function findDate(int $id) {
        
    try {
        $sql = "SELECT `date` FROM `canteen` WHERE `id_child` = :id";

        $connectPDOStatic = Database::connect();

        $sth = $connectPDOStatic->prepare($sql);

        $sth->bindValue(":id", $id, PDO::PARAM_INT);

        $sth->execute();
        //on récupere les données
        $child = $sth->fetchAll();
        // var_dump($child);
        if (!$child) {
            // throw new PDOException(ERROR_NOT_FOUND);
        }

        return $child;

    } catch (PDOException $e) {
        return $e;
    }
    }

    public function findDateByChild(){
        
    }

}