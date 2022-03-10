<?php
session_start();

require_once(dirname(__FILE__).'/../utils/regex.php');

require_once (dirname(__FILE__).'/../models/User.php');

$id = intval(filter_input(INPUT_GET,'id',FILTER_SANITIZE_NUMBER_INT));
// var_dump($id);
// die;
$page = intval(filter_input(INPUT_GET,'page',FILTER_SANITIZE_NUMBER_INT));

$search = trim(filter_input(INPUT_GET, 'search', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?? '');

$selectPatientNumber = intval(filter_input(INPUT_GET,'selectPatientNumber',FILTER_SANITIZE_NUMBER_INT) ?? 10);

$patientNumber = User::getNumber($search);

$nbPages = ceil($patientNumber / $selectPatientNumber);

if($page <= 0 || $page > $nbPages) {
    $page = 1;
}

$offset = ($page - 1) * $selectPatientNumber;


// NOUVELLE MÉTHODE A PARTIR DE PHP 8.1
// $search = htmlspecialchars(stripslashes(trim($_GET['search'])));

$parents = User::findAll($search, $selectPatientNumber, $offset);


include(dirname(__FILE__).'/../views/templates/head.php');

include(dirname(__FILE__).'/../views/templates/navbar-others-pages.php');

include(dirname(__FILE__).'/../views/pages/liste-parents.php');

include(dirname(__FILE__).'/../views/templates/footer.php');