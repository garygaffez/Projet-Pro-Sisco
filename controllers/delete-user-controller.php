<?php

// require_once (dirname(__FILE__).'/../models/Appointment.php');

require_once (dirname(__FILE__).'/../models/User.php');


$id = intval(filter_input(INPUT_GET,'id',FILTER_SANITIZE_NUMBER_INT));



if ($id > 0){
    $deletePatients = User::delete($id);
}
header('location: '.$_SERVER['HTTP_REFERER']);
die;