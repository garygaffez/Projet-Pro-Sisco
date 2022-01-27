<?php

    require_once(dirname(__FILE__).'/../utils/regex.php');

    include(dirname(__FILE__).'/../views/templates/head.php');

    include(dirname(__FILE__).'/../views/templates/navbar-others-pages.php');

    

$errorArrayCreateAccount = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $firstname = trim(filter_input(INPUT_POST,'firstname',FILTER_SANITIZE_STRING));
    if (!empty($firstname)) {
        $resultFirstname = filter_var($firstname, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/".REG_STR_NO_NUMBER."/")));
        if ($resultFirstname == false) {
            $errorArrayCreateAccount['errorFirstname'] = 'le prénom n\'a pas le bon format !';
        }
    } else {
        $errorArrayCreateAccount['emptyInputFirstname'] = 'le prénom est obligatoire !';
    }

    $lastname = trim(filter_input(INPUT_POST,'lastname',FILTER_SANITIZE_STRING));
    if (!empty($lastname)) {
        $resultLastname = filter_var($lastname, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/".REG_STR_NO_NUMBER."/")));
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

    $phoneNumber = trim(filter_input(INPUT_POST,'phoneNumber',FILTER_SANITIZE_STRING));
    if(!empty($phoneNumber)) {
        $resultphoneNumber = filter_var($phoneNumber, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/".REG_STR_PHONENUMBER."/")));
        if ($resultphoneNumber == false) {    
            $errorArrayCreateAccount['errorPhoneNumber'] = "le numéro de téléphone n'est pas valide";
        }
    }else{
        $errorArrayCreateAccount['emptyInputPhoneNumber'] = 'le numéro de téléphone est obligatoire';  
    }

    $password = $_POST['password'];
    if (empty($password)) {
        $errorArrayCreateAccount['emptyInputPassword'] = 'Ce champ est obligatoire !';
    }
    $confirmPassword = trim(filter_input(INPUT_POST,'confirmPassword',FILTER_SANITIZE_STRING));
    if (!empty($hack)) {
        $errorArrayCreateAccount['emptyInputPassword'] = 'Ce champ est obligatoire !';
    } if ($confirmPassword !== $password) {
        $errorArrayCreateAccount['invalidConfirmation'] = 'le mot de passe ne correspond pas !';
    }

}


    if (($_SERVER["REQUEST_METHOD"] != "POST") || !empty($errorArrayCreateAccount)) { 
        include(dirname(__FILE__).'/../views/pages/create-account.php');
    } else { 
        include(dirname(__FILE__).'/../views/pages/messageConfirmation.php');
    }

    include(dirname(__FILE__).'/../views/templates/footer.php');