<?php

session_start();

if(!isset($_SESSION['id'])) {
    // header('location: /controllers/ajout-cantine-controller.php');
}

require_once(dirname(__FILE__).'/../utils/regex.php');

require_once (dirname(__FILE__).'/../models/Child.php');

require_once (dirname(__FILE__).'/../models/User.php');

$id = intval($_SESSION['id']);

$result = false;
    
$errorArrayCreateChild = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // var_dump($_POST);
    
    $firstname = trim(filter_input(INPUT_POST,'firstname',FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?? '');
    if (!empty($firstname)) {
        $resultFirstname = filter_var($firstname, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/".REG_STR_NO_NUMBER."/")));
        if ($resultFirstname == false) {
            $errorArrayCreateChild['errorFirstname'] = 'le prénom n\'a pas le bon format !';
        }
    } else {
        $errorArrayCreateChild['emptyInputFirstname'] = 'le prénom est obligatoire !';
    }

    $lastname = trim(filter_input(INPUT_POST,'lastname',FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?? '');
    if (!empty($lastname)) {
        $resultLastname = filter_var($lastname, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/".REG_STR_NO_NUMBER."/")));
        if ($resultLastname == false) {
            $errorArrayCreateChild['errorLastname'] = 'le nom n\'a pas le bon format !';
        } 
    }else {
        $errorArrayCreateChild['emptyInputLastname'] = 'le nom est obligatoire !';
    }

    $birthdate = trim(filter_input(INPUT_POST, 'birthdate', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?? '');
    if(!empty($birthdate)){
        $month = date('m', strtotime($birthdate));
        $day = date('d', strtotime($birthdate));
        $year = date('Y', strtotime($birthdate));
        $testDate = checkdate($month,$day,$year);
        $dateActuel = strtotime(date('Y-m-d'));
        $dateCompare = strtotime($birthdate);
        if(!$testDate){
            $errorArrayCreateChild["birthdate"] = "La date entrée n'est pas valide!"; 
        }
        if ($dateCompare > $dateActuel){
            $errorArrayCreateChild["birthdateTime"] = "c'est impossible !";
        }
    }else {
        $errorArrayCreateChild['emptyInputBirthDate'] = 'le date de naissance est obligatoire !';
        // $birthdate = NULL;
    }

    // $school = intval(filter_input(INPUT_POST, 'idSchool', FILTER_SANITIZE_NUMBER_INT));
    // if($school <= 0){
    //     $errorArrayCreateChild['emptyIdSchool'] = "Le champ est obligatoire";
    // }

    if (empty($errorArrayCreateChild)) {
        
        $child = new Child();
        $child->setParent($id);
        $child->setLastname($lastname);
        $child->setFirstname($firstname);
        $child->setBirthdate($birthdate);

        $verifChild = $child->isChildExists();

        if (!$verifChild){
            $result = $child->new();
        }else {
            $errorArrayCreateChild['errorChild'] = "Cet enfant est déjà enregistré !";
        }   
    }

}

try{
    $childrenByParent = Child::childrenByParent($id);
}catch(Exception $e){
    die($e->getMessage());
}


try{
    $user = new User();
    $user->setId($id);
    $userInfos = $user->FindUserById();
}catch(Exception $e){
    die($e->getMessage());
}



include(dirname(__FILE__).'/../views/templates/head.php');

include(dirname(__FILE__).'/../views/templates/navbar-others-pages.php');

if (($_SERVER["REQUEST_METHOD"] != "POST") || !empty($errorArrayCreateChild)) { 
    include(dirname(__FILE__).'/../views/pages/profil.php');
} else { 
    header('location: '.$_SERVER['HTTP_REFERER']);
}

include(dirname(__FILE__).'/../views/templates/footer.php');