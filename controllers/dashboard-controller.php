<?php

session_start();

if(!isset($_SESSION['id'])) {
    // header('location: /controllers/ajout-cantine-controller.php');
}

require_once(dirname(__FILE__).'/../utils/regex.php');

require_once (dirname(__FILE__).'/../models/Child.php');

require_once (dirname(__FILE__).'/../models/User.php');

require_once (dirname(__FILE__).'/../models/Canteen.php');

// var_dump($_GET, $_POST);

$id = intval($_SESSION['id']);

$idChild = intval(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));

$result = false;

$errorArrayCreateChild = [];
//Calendrier
$month = $_POST['month'] ?? date('n');

$year = $_POST['year'] ?? date('Y');

$monthsName = ['Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Décembre'];
$daysName = [
    1 => 'Lundi',
    2 => 'Mardi',
    3 => 'Mercredi',
    4 => 'Jeudi',
    5 => 'Vendredi',
    6 => 'Samedi',
    7 => 'Dimanche'
];

$nbDaysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
$firstDayInMonth = date('N', strtotime("$year/$month/01"));
$lastDayInMonth = date('N', strtotime("$year/$month/$nbDaysInMonth"));

$daysInMonth = [];

for($i=1;$i<$firstDayInMonth;$i++){
    array_push($daysInMonth, '');
}

for($i=1;$i<=$nbDaysInMonth;$i++){
    array_push($daysInMonth, $i);
}

for($i=$lastDayInMonth;$i<7;$i++){
    array_push($daysInMonth, '');
}

$nbWeeks = count($daysInMonth) / 7;

//fin CAlendrier

$dateActuel = strtotime(date('Y-m-d'));



include(dirname(__FILE__).'/../views/templates/head.php');

include(dirname(__FILE__).'/../views/templates/navbar-others-pages.php');

include(dirname(__FILE__).'/../views/pages/dashboard.php');

include(dirname(__FILE__).'/../views/templates/footer.php');