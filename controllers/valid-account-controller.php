<?php

session_start();

require_once (dirname(__FILE__).'/../models/User.php');

$user = new User();
$validated_at = date("Y-m-d H:i:s");


if (isset($_SESSION['id'])){
    header('location: /controllers/profil-controller.php');
}

if (isset($_GET['token']) && !isset($_SESSION['id'])) {

    $user->setTokenRegister($_GET['token']);
    $user->setValidatedAt($validated_at);

    if ($user->AccountIsVerify($_GET['token'])) {
        include(dirname(__FILE__).'/../views/templates/head.php');
        include(dirname(__FILE__).'/../views/templates/navbar-others-pages.php');
        include(dirname(__FILE__).'/../views/templates/messages/accountExists.php');
        header('refresh:5 /controllers/connexion-controller.php');
    }else if($user->validateAccount()){
        include(dirname(__FILE__).'/../views/templates/head.php');
        include(dirname(__FILE__).'/../views/templates/navbar-others-pages.php');
        include(dirname(__FILE__).'/../views/templates/messages/confirmValidAccount.php');
        header('refresh:5 /controllers/connexion-controller.php');
    }else{
        echo 'une erreur est survenue !';
    }
    
    }

else {
    header('location: /controllers/news-controller.php');    
}

