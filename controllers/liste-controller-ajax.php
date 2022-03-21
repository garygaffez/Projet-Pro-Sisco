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




$parents = User::findAllAjax($search, $selectPatientNumber, $offset);

// var_dump($parents);
if (isset($_POST['ajaxDelete'])) {
    $user = new User();
    $id = intval($_POST['id']);
    $deletedAt = date("Y-m-d H:i:s");
    $user->setId($id);
    $user->setDeletedAt($deletedAt);

    if ($user->deleteUserAjax()){
        echo json_encode(['message' => true], JSON_UNESCAPED_UNICODE);
        die;
    }
}

if (empty($_POST)){
    echo json_encode($parents, JSON_UNESCAPED_UNICODE);
    die;
}
