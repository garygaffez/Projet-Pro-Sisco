<?php

    require_once(dirname(__FILE__).'/../utils/regex.php');

    include(dirname(__FILE__).'/../views/templates/head.php');

    include(dirname(__FILE__).'/../views/templates/navbar-others-pages.php');

    

$errorArrayConnection = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = trim(filter_input(INPUT_POST,'email',FILTER_SANITIZE_EMAIL));
    if(!empty($email)) {
        $resultEmail = filter_var($email, FILTER_VALIDATE_EMAIL);
        if ($resultEmail == false) {    
            $errorArrayConnection['errorMail'] = "$email n'est pas une adresse mail valide !";
        }
    }else{
        $errorArrayConnection['emptyInputMail'] = 'le mail est obligatoire !';  
    }

    $password = trim(filter_input(INPUT_POST,'password',FILTER_SANITIZE_STRING));
    if (empty($password)) {
        $errorArrayConnection['emptyInputPassword'] = 'Ce champ est obligatoire !';
    }
//var_dump($errorArrayConnection)
}


    include(dirname(__FILE__).'/../views/pages/connexion.php');

    include(dirname(__FILE__).'/../views/templates/footer.php');