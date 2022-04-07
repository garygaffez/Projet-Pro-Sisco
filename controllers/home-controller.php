<?php


require_once (dirname(__FILE__).'/../models/Event.php');

$alert = Event::find();

$messageAlert = false;

if ($alert) {
    $messageAlert = true;
}


include(dirname(__FILE__).'/../views/templates/head.php');

include(dirname(__FILE__).'/../views/templates/navbar-first-time.php');

include(dirname(__FILE__).'/../views/templates/first-time-page.php');

include(dirname(__FILE__).'/../views/templates/carroussel.php');

include(dirname(__FILE__).'/../views/pages/news.php');

include(dirname(__FILE__).'/../views/templates/footer.php');