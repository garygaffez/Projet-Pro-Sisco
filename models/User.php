<?php

require_once (dirname(__FILE__)."/../utils/database.php");

class User {
    private $lastname;
    private $firstname;
    private $mail;
    private $phone;
    private $password;
        
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

    
    public function setMail($mail){
        $this->mail = $mail;
    }
    public function getMail(){
        return $this->mail;
    }


    public function setPhone($phone){
        $this->phone = $phone;
    }
    public function getPhone(){
        return $this->phone;
    }

    
    public function setPassword($password){
        $this->password = $password;
    }
    public function getPassword(){
        return $this->password;
    }

}