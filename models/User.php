<?php

require_once (dirname(__FILE__)."/../utils/database.php");

class User {
    private $id;
    private $lastname;
    private $firstname;
    private $mail;
    private $phone;
    private $password;
    private $registered_at;
    private $validated_at;
    private $deleted_at;
    private $tokenRegister;     
    private $connectPDO;

    public function __construct($lastname = '', $firstname ='', $email = '', $phoneNumber = '', $password = '', $accountDate = ''){
        $this->connectPDO = Database::connect();
        $this->setLastname($lastname);
        $this->setFirstname($firstname);
        $this->setMail($email);
        $this->setPhone($phoneNumber);
        $this->setPassword($password);
        $this->setRegistered_at($accountDate);
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

    public function setRegistered_at($registered_at){
        $this->registered_at = $registered_at;
    }
    public function getRegistered_at(){
        return $this->registered_at;
    }

    public function setValidatedAt($validated_at){
        $this->validated_at = $validated_at;
    }
    public function getValidatedAt(){
        return $this->validated_at;
    }

    public function setDeletedAt($deleted_at){
        $this->deleted_at = $deleted_at;
    }
    public function getDeletedAt(){
        return $this->deleted_at;
    }

    public function setTokenRegister($tokenRegister){
        $this->tokenRegister = $tokenRegister;
    }
    public function getTokenRegister(){
        return $this->tokenRegister;
    }


        /**
     * fonction permettant d'insérer dans la base de données les données récupérées avec set
     * @return true si tout va bien
     * 
     * @return string si erreur
     */
    public function new(){

        try {
            $sql = "INSERT INTO `user`(`lastname`, `firstname`, `mail`, `phone`, `password`, `tokenRegister`) 
                    VALUES (:lastname, :firstname, :mail, :phone, :password, :token)";

            $query = $this->connectPDO->prepare($sql);

            $query->bindValue(":lastname", $this->getLastname(), PDO::PARAM_STR);
            $query->bindValue(":firstname", $this->getFirstname(), PDO::PARAM_STR);
            $query->bindValue(":mail", $this->getMail(), PDO::PARAM_STR);
            $query->bindValue(":phone", $this->getPhone(), PDO::PARAM_STR);
            $query->bindValue(":password", $this->getPassword(), PDO::PARAM_STR);
            $query->bindValue(":token", $this->getTokenRegister(), PDO::PARAM_STR);

            $query->execute();
 
            return true;
            
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }


    /**
     * Permet de rechercher tous les patients
     * @param string $search la chaine à rechercher
     * @param string $limite
     * @param string $offset
     * 
     * @return array un tableau de la liste des patients
     * @return PDOException 
     */
    public static function findAll(string $search = '',string $selectpatientNumber = '',string $offset = '') {
        
        try {
            $connectPDOStatic = Database::connect();
            if ( $selectpatientNumber == '' && $offset == '') {
                $sql = "SELECT * FROM `user` ORDER BY `lastname`;";
                $sth = $connectPDOStatic->prepare($sql);
            } else {
                $sql = "SELECT * FROM `user` WHERE `lastname` LIKE :search OR `firstname` LIKE :search ORDER BY `lastname` LIMIT :selectpatientNumber OFFSET :offset;";
                //!!!! prepare sécurise la requête pour éviter les injections SQL : TRES IMPORTANT POUR LA SECURITE !!!!
                $sth = $connectPDOStatic->prepare($sql);

                $sth->bindValue(":search", '%'.$search.'%', PDO::PARAM_STR);

                $sth->bindValue(":selectpatientNumber", $selectpatientNumber, PDO::PARAM_INT);

                $sth->bindValue(":offset", $offset, PDO::PARAM_INT);
            }
        

            $sth->execute();

            $users = $sth->fetchAll();

            if (!$users) {
                throw new PDOException(EMPTY_USERS);
            }else if(empty($users)) {
                throw new PDOException(ERROR_NOT_FOUND);
            }else {
                return $users;            
            }

        } catch (PDOException $e) {
            return $e;
        }
    }


        /**
     * affiche un parent de la bdd
     */
    public static function find(int $id) {
        
        try {
            $sql = "SELECT * FROM `user` WHERE `id_user` = :id";

            $connectPDOStatic = Database::connect();

            $sth = $connectPDOStatic->prepare($sql);

            $sth->bindValue(":id", $id, PDO::PARAM_INT);

            $sth->execute();
            //on récupere les données
            $parent = $sth->fetch();
            // var_dump($parent);
            if (!$parent) {
                throw new PDOException(ERROR_NOT_FOUND);
            }

            return $parent;

        } catch (PDOException $e) {
            return $e;
        }
    }
    
    /**
     * Mettre à jour un patient de la bdd
     */
    public function update($id) {

        try {
            $sql = "UPDATE `user` SET `lastname` = :lastname, `firstname` = :firstname, `phone` = :phone, `mail` = :mail WHERE `id_user` = :id";

            $sth = $this->connectPDO->prepare($sql);
            
            $sth->bindValue(":id", $id, PDO::PARAM_INT);
            $sth->bindValue(":lastname", $this->getLastname(), PDO::PARAM_STR);
            $sth->bindValue(":firstname", $this->getFirstname(), PDO::PARAM_STR);
            $sth->bindValue(":phone", $this->getPhone(), PDO::PARAM_STR);
            $sth->bindValue(":mail", $this->getMail(), PDO::PARAM_STR);
            return $sth->execute();
            } catch (PDOException $e) {
                return  $e->getMessage();
            }
    }


//methode permettant de supprimer un patient (et les rdv en changeant la clé étrangére de RESTRICT à CASCADE)
    public static function delete($id) {
        
        try {
            //on récupére les données
            $sql = "DELETE FROM `user` WHERE `id_user` = :id;";

            $connectPDOStatic = Database::connect();

            $sth = $connectPDOStatic->prepare($sql);

            $sth->bindValue(":id", $id, PDO::PARAM_INT);

            return $sth->execute();


        } catch (PDOException $e) {
            return $e;
        }
    }


    public static function search(string $search = '') {
        
        try {
            $sql = "SELECT * FROM `user` WHERE `lastname` LIKE :search OR `firstname` LIKE :search ORDER BY `lastname`;";
            //!!!! prepare sécurise la requête pour éviter les injections SQL : TRES IMPORTANT POUR LA SECURITE !!!!

            $connectPDOStatic = Database::connect();
            
            $sth = $connectPDOStatic->prepare($sql);

            $sth->bindValue(":search", '%'.$search.'%', PDO::PARAM_STR);

            $sth->execute();
            //on récupere les données
            $search = $sth->fetchAll();

            if (!$search) {
                throw new PDOException(ERROR_NOT_FOUND);
            }

            return $search;

        } catch (PDOException $e) {
            return $e;
        }
    }

    
    /**
     * @return int nombre de patients
     */
    public static function getNumber(string $search = '') {
        
        try {
            $sql = "SELECT count(`id_user`) AS `countPatient` FROM `user` WHERE `lastname` LIKE :resultSearch OR `firstname` LIKE :resultSearch ORDER BY `lastname`;";

            $connectPDOStatic = Database::connect();

            $sth = $connectPDOStatic->prepare($sql);

            $sth->bindValue(":resultSearch", '%'.$search.'%', PDO::PARAM_STR);

            $sth->execute();

            return $sth->fetchColumn();

        } catch (PDOException $e) {
            return $e;
        }
    }



    /**
     *  fonction permettant de vérifier si un utilisateur existe déjà en verifiant si l'adresse mail est 
     *  déjà présente dans la base de données
     * @return bool
     */
    public function isMailExists(): bool {
        $sql = ("SELECT `mail` FROM `user` WHERE `mail`= :mail;");
        $sth = $this->connectPDO->prepare($sql);
        $sth->bindValue(":mail", $this->getMail(), PDO::PARAM_STR);
        $sth->execute();
        $result = $sth->fetchColumn();
        if ($result === false){
            return false;
        }else{
            return true;
        }        
    }

    public function login() {

        try{
            $sql = "SELECT `id_user`, `password`, `firstname`, `validated_at`, `admin` FROM `user` WHERE `mail`= :mail";

            $sth = $this->connectPDO->prepare($sql);
            
            $sth->bindValue(":mail", $this->mail, PDO::PARAM_STR);

            if ($sth->execute()){
                return $user = $sth->fetch();
                $this->password = $user->password;
                $this->id = $user->id_user;
                $this->firstname = $user->firstname;
                $this->validated_at = $user->validated_at;
            }else{
                return false;
            }

            return $this;

        }catch (PDOException $e) {
            return $e;
        }        
    }

    public function FindUserById() {
        try {
            $sql = "SELECT `id_user`, `lastname`, `firstname`, `mail`, `phone`  FROM `user` WHERE `id_user`= :id";
        $sth = $this->connectPDO->prepare($sql);
        $sth->bindValue(":id", $this->getID(), PDO::PARAM_INT);
        
        
        if ($sth->execute()){
            return $sth->fetch();
        }
        
        }catch (PDOException $e) {
            return $e;
        }     
    }

    public function getUserByToken(string $token){
        $sql = 'SELECT `id_user` FROM `user` WHERE `tokenRegister` = :token;';
        $sth = $this->connectPDO->prepare($sql);
        $sth->bindValue(':token', $token, PDO::PARAM_STR);
        if ($sth->execute()) {
            if ($sth->fetch()) {
                return true;
            }
            return false;
        }
    }

    public function ValidateAccount(){
        try {
            if ($this->getUserByToken($this->tokenRegister)) {
                $sql = 'UPDATE `user` SET `validated_at`= :validated_at WHERE `tokenRegister` = :token;';
                
                $sth = $this->connectPDO->prepare($sql);
                
                $sth->bindValue(':validated_at', $this->validated_at, PDO::PARAM_STR);
                $sth->bindValue(':token', $this->tokenRegister, PDO::PARAM_STR);
                
                if ($sth->execute()) {
                    return true;
                }
            }
            return false;
        } catch (\PDOException $th) {
            echo $th->getMessage();
        }
    }

    public function AccountIsVerify(string $token){
        $sql = 'SELECT `id_user` FROM `user` WHERE `tokenRegister` = :token and `validated_at` IS NOT NULL;';
        $sth = $this->connectPDO->prepare($sql);
        $sth->bindValue(':token', $token, PDO::PARAM_STR);
        if ($sth->execute()) {
            if ($sth->fetch()) {
                return true;
            }
            return false;
        }
    }

    public function forgotPassword(){
        $sql = 'SELECT `tokenRegister` FROM `user` WHERE mail = :mail;';
        $sth = $this->connectPDO->prepare($sql);
        $sth->bindValue(":mail", $this->mail, PDO::PARAM_STR);
        $sth->execute();
        $result = $sth->fetchColumn();
        if ($result === false){
            return false;
        }else{
            return true;
        }  
    }


    public static function findAllAjax(string $search = '',string $selectpatientNumber = '',string $offset = '') {
        
        try {
            $connectPDOStatic = Database::connect();
            if ( $selectpatientNumber == '' && $offset == '') {
                $sql = "SELECT * FROM `user` ORDER BY `lastname`;";
                $sth = $connectPDOStatic->prepare($sql);
            } else {
                $sql = "SELECT * FROM `user` WHERE `lastname` LIKE :search OR `firstname` LIKE :search AND `deleted_at` IS NULL  ORDER BY `lastname` LIMIT :selectpatientNumber OFFSET :offset;";
                $sth = $connectPDOStatic->prepare($sql);

            $sth->bindValue(":search", '%'.$search.'%', PDO::PARAM_STR);

            $sth->bindValue(":selectpatientNumber", $selectpatientNumber, PDO::PARAM_INT);

            $sth->bindValue(":offset", $offset, PDO::PARAM_INT);
            }

            $sth->execute();

            $users = $sth->fetchAll();

            if (!$users) {
                throw new PDOException(EMPTY_USERS);
            }else if(empty($users)) {
                throw new PDOException(ERROR_NOT_FOUND);
            }else {
                return $users;            
            }
        } catch (PDOException $e) {
            return $e;
        }
    }


    public function deleteUserAjax() {
        
        try {
            $sql = "UPDATE `user` SET `deleted_at` = :deletedDate WHERE `id_user` = :id;";

            $sth = $this->connectPDO->prepare($sql);

            $sth->bindValue(":deletedDate", $this->getDeletedAt(), PDO::PARAM_STR);

            $sth->bindValue(":id", $this->getId(), PDO::PARAM_INT);

            if ($sth->execute()){
                return true;
            }
            return false;

        } catch (PDOException $e) {
            return $e;
        }
    }


}