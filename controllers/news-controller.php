<?php

session_start();

$messageAlert = false;

    include(dirname(__FILE__).'/../views/templates/head.php');

    // include(dirname(__FILE__).'/../views/templates/first-time-page.php');

    include(dirname(__FILE__).'/../views/templates/navbar-others-pages.php'); 

    include(dirname(__FILE__).'/../views/templates/logo-actuality-second-time.php'); 

    include(dirname(__FILE__).'/../views/templates/carroussel.php');

    include(dirname(__FILE__).'/../views/pages/news.php');

    include(dirname(__FILE__).'/../views/templates/footer.php');
