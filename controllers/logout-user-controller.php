<?php

session_start();

if (isset($_SESSION['id'])){
    foreach ($_SESSION as $key => $value) {
        $_SESSION[$key] = NULL;
    }
    session_destroy();
    header('location: /controllers/connexion-controller.php');
}else{
    header('location: /controllers/news-controller.php');
}