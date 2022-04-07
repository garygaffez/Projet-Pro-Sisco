<?php
session_start();

require_once(dirname(__FILE__).'/../utils/regex.php');

require_once (dirname(__FILE__).'/../models/canteen.php');

$id = intval(filter_input(INPUT_GET,'id',FILTER_SANITIZE_NUMBER_INT));

$dayCanteenChild = Canteen::findDate($id);

echo json_encode($dayCanteenChild, JSON_UNESCAPED_UNICODE);