<?php

require_once (dirname(__FILE__)."/../utils/database.php");

class Canteen {
    private $date;

    private $pdo;

    public function __construct(){
        $this->pdo = connect();
    }

    public function setDate($date) {
        $this->date = $date;
    }

    public function getDate() {
        return $this->date;
    }
}