<?php

session_start();

    require_once(dirname(__FILE__).'/../utils/regex.php');

    include(dirname(__FILE__).'/../views/templates/head.php');

    include(dirname(__FILE__).'/../views/templates/navbar-others-pages.php');

    

$errorArrayContact = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $firstname = trim(filter_input(INPUT_POST,'firstname',FILTER_SANITIZE_STRING));
    if (!empty($firstname)) {
        $resultFirstname = filter_var($firstname, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/".REG_STR_NO_NUMBER."/")));
        if ($resultFirstname == false) {
            $errorArrayContact['errorFirstname'] = 'le prénom n\'a pas le bon format !';
        }
    } else {
        $errorArrayContact['emptyInputFirstname'] = 'le prénom est obligatoire !';
    }

    $lastname = trim(filter_input(INPUT_POST,'lastname',FILTER_SANITIZE_STRING));
    if (!empty($lastname)) {
        $resultLastname = filter_var($lastname, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/".REG_STR_NO_NUMBER."/")));
        if ($resultLastname == false) {
            $errorArrayContact['errorLastname'] = 'le nom n\'a pas le bon format !';
        }
    }else {
        $errorArrayContact['emptyInputLastname'] = 'le nom est obligatoire !';
    }

    $email = trim(filter_input(INPUT_POST,'email',FILTER_SANITIZE_EMAIL));
    if(!empty($email)) {
        $resultEmail = filter_var($email, FILTER_VALIDATE_EMAIL);
        if ($resultEmail == false) {    
            $errorArrayContact['errorMail'] = "$email n'est pas une adresse mail valide !";
        }
    }else{
        $errorArrayContact['emptyInputMail'] = 'le mail est obligatoire !';  
    }

    $phoneNumber = trim(filter_input(INPUT_POST,'phoneNumber',FILTER_SANITIZE_STRING));
    if(!empty($phoneNumber)) {
        $resultphoneNumber = filter_var($phoneNumber, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/".REG_STR_PHONENUMBER."/")));
        if ($resultphoneNumber == false) {    
            $errorArrayContact['errorPhoneNumber'] = "le numéro de téléphone n'est pas valide";
        }
    }else{
        $errorArrayContact['emptyInputPhoneNumber'] = 'le numéro de téléphone est obligatoire';  
    }

    $textareaContact = trim(filter_input(INPUT_POST,'textareaContact',FILTER_SANITIZE_STRING));
    if (empty($story)) {
        $errorArrayContact['errortextareaContact'] = 'Ce champ est obligatoire';
    }
}


    include(dirname(__FILE__).'/../views/pages/contact.php');

    include(dirname(__FILE__).'/../views/templates/footer.php');