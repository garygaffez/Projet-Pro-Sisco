<?php

require_once (dirname(__FILE__)."/../utils/database.php");

class Child {
    private $lastname;
    private $firstname;

    private $pdo;

    public function __construct(){
        $this->pdo = connect();
    }


    public function setLastname($lastname){
        $this->lastname = $lastname;
    }
    public function getLastname(){
        return $this->lastname;
    }

    
    public function setFirstname($firstname){
        $this->firstname = $firstname;
    }
    public function getFirstname(){
        return $this->firstname;
    }
}