<?php

require_once (dirname(__FILE__)."/../utils/database.php");

class Schoolclass {
    private $class_name;
    private $city;

    private $pdo;

    public function __construct(){
        $this->pdo = connect();
    }

    public function setClass_name($class_name) {
        $this->class_name = $class_name;
    }
    public function getClass_name() {
        return $this->class_name;
    }

    public function setCity($city) {
        $this->city = $city;
    }
    public function getCity() {
        return $this->city;
    }


}