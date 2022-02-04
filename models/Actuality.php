<?php

require_once (dirname(__FILE__)."/../utils/database.php");

class Actuality {
    private $link;
    private $label;
    private $description;
        
    private $pdo;

    public function __construct(){
        $this->pdo = connect();
    }


    public function setLink($link){
        $this->link = $link;
    }
    public function getLink(){
        return $this->link;
    }

    
    public function setLabel($label){
        $this->label = $label;
    }
    public function getLabel(){
        return $this->label;
    }

    
    public function setDescription($description){
        $this->description = $description;
    }
    public function getDescription(){
        return $this->description;
    }

}