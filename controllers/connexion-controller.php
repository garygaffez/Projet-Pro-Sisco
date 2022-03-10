<?php

session_start();

if (isset($_SESSION['id'])){
    header('location: /controllers/profil-controller.php');
}

// var_dump($_SESSION);

require_once(dirname(__FILE__).'/../utils/regex.php');

require_once (dirname(__FILE__).'/../models/User.php');

$id = intval(filter_input(INPUT_GET,'id',FILTER_SANITIZE_NUMBER_INT));

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

    $password = $_POST['password'];
    if (empty($password)) {
        $errorArrayConnection['emptyInputPassword'] = 'Ce champ est obligatoire !';
    }

    if (empty($errorArrayConnection)) {
        
        $parent = new User();
        $parent->setMail($email);

        $user = $parent->login();

        if (password_verify($password, $user->getPassword())){
            $_SESSION['id'] = $user->getId();
            $_SESSION['firstname'] = $user->getFirstname();
            header('location: /controllers/profil-controller.php');
        }else {
            // $errorArrayConnection['errorMail'] = "l'adresse mail est déjà existante !";
            $errorArrayConnection['errorPasswordValidation'] = 'Veuillez vérifier votre adresse e-mail et votre mot de passe !';
        }   
    }



}




include(dirname(__FILE__).'/../views/templates/head.php');

include(dirname(__FILE__).'/../views/templates/navbar-others-pages.php');

include(dirname(__FILE__).'/../views/pages/connexion.php');

include(dirname(__FILE__).'/../views/templates/footer.php');