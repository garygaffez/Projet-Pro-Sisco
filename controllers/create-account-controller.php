<?php

session_start();

if (isset($_SESSION['id'])){
    // header('location: /controllers/profil-controller.php');
}

require_once(dirname(__FILE__).'/../utils/regex.php');

require_once (dirname(__FILE__).'/../models/User.php');

$result = false;

$errorArrayCreateAccount = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    extract($_POST);

    $tokenRegister = bin2hex(random_bytes(50));

    if (!empty($firstname)) {
        $resultFirstname = preg_match("/^[a-zÀ-ÿA-Z '-]+$/", $firstname);
        if ($resultFirstname == false) {
            $errorArrayCreateAccount['errorFirstname'] = 'le prénom n\'a pas le bon format !';
        }else {
            $firstname = trim(filter_var($firstname,FILTER_SANITIZE_SPECIAL_CHARS));
        }
    } else {
        $errorArrayCreateAccount['emptyInputFirstname'] = 'le prénom est obligatoire !';
    }

    $lastname = trim(filter_input(INPUT_POST,'lastname',FILTER_SANITIZE_SPECIAL_CHARS));
    var_dump($lastname);
    if (!empty($lastname)) {
        $resultLastname = preg_match("/^[a-zÀ-ÿA-Z '-]+$/", $lastname);
        if ($resultLastname == false) {
            $errorArrayCreateAccount['errorLastname'] = 'le nom n\'a pas le bon format !';
        } 
    }else {
        $errorArrayCreateAccount['emptyInputLastname'] = 'le nom est obligatoire !';
    }

    $email = trim(filter_input(INPUT_POST,'email',FILTER_SANITIZE_EMAIL));
    if(!empty($email)) {
        $resultEmail = filter_var($email, FILTER_VALIDATE_EMAIL);
        if ($resultEmail == false) {    
            $errorArrayCreateAccount['errorMail'] = "$email n'est pas une adresse mail valide !";
        }
    }else{
        $errorArrayCreateAccount['emptyInputMail'] = 'le mail est obligatoire !';  
    }

    $phoneNumber = trim(filter_input(INPUT_POST,'phoneNumber',FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?? '');
    if(!empty($phoneNumber)) {
        $resultphoneNumber = filter_var($phoneNumber, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/".REG_STR_PHONENUMBER."/")));
        if ($resultphoneNumber == false) {    
            $errorArrayCreateAccount['errorPhoneNumber'] = "le numéro de téléphone n'est pas valide";
        }
    }else{
        $errorArrayCreateAccount['emptyInputPhoneNumber'] = 'le numéro de téléphone est obligatoire';  
    }

    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    
    // var_dump($password);
    
    if (!empty($password)) {
        if ($password == $confirmPassword){
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        }
    }else {
        $errorArrayCreateAccount['emptyInputPassword'] = 'Ce champ est obligatoire !';
    }

    if (empty($errorArrayCreateAccount)) {
        
        $user = new User($lastname, $firstname, $email, $phoneNumber, $hashedPassword);

        $user->setTokenRegister($tokenRegister);
        
        // var_dump($user);
        $verifMail = $user->isMailExists();
        if (!$verifMail){
            $result = $user->new();
        }else {
            $errorArrayCreateAccount['errorMail'] = "l'adresse mail est déjà existante !";
        }   
    }

}

include(dirname(__FILE__).'/../views/templates/head.php');

include(dirname(__FILE__).'/../views/templates/navbar-others-pages.php');

if (($_SERVER["REQUEST_METHOD"] != "POST") || !empty($errorArrayCreateAccount)) { 
    include(dirname(__FILE__).'/../views/pages/create-account.php');
} else { 
    include(dirname(__FILE__).'/../views/pages/messageConfirmation.php');
}

include(dirname(__FILE__).'/../views/templates/footer.php');