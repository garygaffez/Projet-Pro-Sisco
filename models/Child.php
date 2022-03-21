<?php

require_once (dirname(__FILE__)."/../utils/database.php");

class Child {
    private $id;
    private $lastname;
    private $firstname;
    private $birthdate;
    private $registered;
    private $school;
    private $user;        
    private $connectPDO;


    public function __construct($lastname = '', $firstname ='', $birthdate = '', $school = '', $parent = '', $childInscription = ''){
        $this->connectPDO = Database::connect();
        $this->setLastname($lastname);
        $this->setFirstname($firstname);
        $this->setBirthdate($birthdate);
        $this->setSchool($school);
        $this->setParent($parent);
        $this->setChildInscription($childInscription);
    }

    public function setId($id){
        $this->id = $id;
    }
    public function getId(){
        return $this->id;
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

    public function setBirthdate($birthdate){
        $this->birthdate = $birthdate;
    }
    public function getBirthdate(){
        return $this->birthdate;
    }

    public function setSchool($school){
        $this->school = $school;
    }
    public function getSchool(){
        return $this->school;
    }

    public function setParent($parent){
        $this->user = $parent;
    }
    public function getParent(){
        return $this->user;
    }

    public function setChildInscription($childInscription){
        $this->registered = $childInscription;
    }
    public function getChildInscription(){
        return $this->registered;
    }


        /**
     * fonction permettant d'insérer dans la base de données les données récupérées avec set
     * @return true si tout va bien
     * 
     * @return string si erreur
     */
    public function new(){

        try {
            $sql = "INSERT INTO `child`(`lastname`, `firstname`, `birthdate`, `id_user`) 
                    VALUES (:lastname, :firstname, :birthdate, :id_user)";

            $query = $this->connectPDO->prepare($sql);

            $query->bindValue(":lastname", $this->getLastname(), PDO::PARAM_STR);
            $query->bindValue(":firstname", $this->getFirstname(), PDO::PARAM_STR);
            $query->bindValue(":birthdate", $this->getBirthdate(), PDO::PARAM_STR);
            $query->bindValue(":id_user", $this->getParent(), PDO::PARAM_STR);

            $query->execute();
 
            return true;
            
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }


    public static function find(int $id) {
        
        try {
            $sql = "SELECT * FROM `child` WHERE `id_child` = :id";

            $connectPDOStatic = Database::connect();

            $sth = $connectPDOStatic->prepare($sql);

            $sth->bindValue(":id", $id, PDO::PARAM_INT);

            $sth->execute();
            //on récupere les données
            $child = $sth->fetch();
            // var_dump($child);
            if (!$child) {
                // throw new PDOException(ERROR_NOT_FOUND);
            }

            return $child;

        } catch (PDOException $e) {
            return $e;
        }
    }

    public static function childrenByParent(int $id){
        try {
            //on récupére les données
            $sql = "SELECT * FROM `child` WHERE `id_user` = :id";

            $connectPDOStatic = Database::connect();

            $sth = $connectPDOStatic->prepare($sql);

            $sth->bindValue(":id", $id, PDO::PARAM_INT);

            $sth->execute();

            $users = $sth->fetchAll();
            return $users;

        } catch (PDOException $e) {
            $e = 'Error !';
            return $e;
        }
    }

    /**
     * affiche les patients de la bdd
     */
    public static function findAll() {
        
        try {
            //on récupére les données
            $sql = "SELECT * FROM `child` ORDER BY  `firstname`;";

            $connectPDOStatic = Database::connect();

            $sth = $connectPDOStatic->query($sql);

            $users = $sth->fetchAll();

            return $users;

        } catch (PDOException $e) {
            $e = 'Error !';
            return $e;
        }
    }

    //methode permettant de supprimer un enfant (et les rdv en changeant la clé étrangére de RESTRICT à CASCADE)
    public static function delete($id) {
        
        try {
            //on récupére les données
            $sql = "DELETE FROM `child` WHERE `id_child` = :id;";

            $connectPDOStatic = Database::connect();

            $sth = $connectPDOStatic->prepare($sql);

            $sth->bindValue(":id", $id, PDO::PARAM_INT);

            return $sth->execute();


        } catch (PDOException $e) {
            return $e;
        }
    }

        /**
     *  fonction permettant de vérifier si un enfant existe déjà en verifiant si le nom et le prénom sont 
     *  déjà présents dans la base de données
     * @return bool
     */
    public function isChildExists(): bool {
        $sql = ("SELECT `lastname`, `firstname`, `birthdate` FROM `child` 
                WHERE `lastname`= :lastname AND `firstname`= :firstname AND `birthdate`= :birthdate;");
        $sth = $this->connectPDO->prepare($sql);
        $sth->bindValue(":lastname", $this->getLastname(), PDO::PARAM_STR);
        $sth->bindValue(":firstname", $this->getFirstname(), PDO::PARAM_STR);
        $sth->bindValue(":birthdate", $this->getBirthdate(), PDO::PARAM_STR);
        $sth->execute();
        $result = $sth->fetch();
        // var_dump($result);
        // die;
        if ($result === false){
            return false;
        }else{
            return true;
        }        
    }

    function countFrenchBusinessDays(int $year, int $month, array $weekdays_off = [6, 7]): int{
    $holidays = [
        1  => [1],       // jour de l'an
        5  => [1, 8],    // fête du travail et armistice 39-45
        7  => [14],      // fête nationale
        8  => [15],      // Assomption
        11 => [1, 11],   // Toussaint et armistice 14-18
        12 => [25]       // noël
    ];
 
    $easter_day = (new DateTime("{$year}-03-21"))->modify('+'.easter_days($year, CAL_GREGORIAN).' days');
    $easter_month = $easter_day->format('n');
    $holidays[$easter_month][] = $easter_day->format('j');
 
    // no business days
    if ( ! empty($weekdays_off)) {
        $start = new DateTimeImmutable("{$year}-{$month}-01");
        $end   = $start->modify('first day of next month');
        $days  = new DatePeriod($start, new DateInterval('P1D'), $end);
 
        foreach ($days as $dt) {
            if (in_array($dt->format('N'), $weekdays_off)) {
                $holidays[$month][] = $dt->format('j');
            }
        }
    }
 
    return $start->format('t') - count(array_unique($holidays[$month]));
}

}