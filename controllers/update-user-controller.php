<?php

require_once(dirname(__FILE__).'/../utils/regex.php');

require_once (dirname(__FILE__).'/../models/User.php');

// require_once (dirname(__FILE__).'/../models/Appointment.php');

// $allAppointments = false;

$id = intval(filter_input(INPUT_GET,'id',FILTER_SANITIZE_NUMBER_INT));


$errorUpdateUser = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = intval(filter_input(INPUT_POST,'id',FILTER_SANITIZE_NUMBER_INT));

    $firstname = trim(filter_input(INPUT_POST,'firstname',FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?? '');
    if (!empty($firstname)) {
        $resultFirstname = filter_var($firstname, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/".REG_STR_NO_NUMBER."/")));
        if ($resultFirstname == false) {
            $errorUpdateUser['errorFirstname'] = 'le prénom n\'a pas le bon format !';
        }
    } else {
        $errorUpdateUser['emptyInputFirstname'] = 'le prénom est obligatoire !';
    }

    $lastname = trim(filter_input(INPUT_POST,'lastname',FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?? '');
    if (!empty($lastname)) {
        $resultLastname = filter_var($lastname, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/".REG_STR_NO_NUMBER."/")));
        if ($resultLastname == false) {
            $errorUpdateUser['errorLastname'] = 'le nom n\'a pas le bon format !';
        } 
    }else {
        $errorUpdateUser['emptyInputLastname'] = 'le nom est obligatoire !';
    }

    $email = trim(filter_input(INPUT_POST,'email',FILTER_SANITIZE_EMAIL));
    if(!empty($email)) {
        $resultEmail = filter_var($email, FILTER_VALIDATE_EMAIL);
        if ($resultEmail == false) {    
            $errorUpdateUser['errorMail'] = "$email n'est pas une adresse mail valide !";
        }
    }else{
        $errorUpdateUser['emptyInputMail'] = 'le mail est obligatoire !';  
    }

    $phoneNumber = trim(filter_input(INPUT_POST,'phoneNumber',FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?? '');
    if(!empty($phoneNumber)) {
        $resultphoneNumber = filter_var($phoneNumber, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/".REG_STR_PHONENUMBER."/")));
        if ($resultphoneNumber == false) {    
            $errorUpdateUser['errorPhoneNumber'] = "le numéro de téléphone n'est pas valide";
        }
    }else{
        $errorUpdateUser['emptyInputPhoneNumber'] = 'le numéro de téléphone est obligatoire';  
    }

    $registered = null;

    if (empty($errorUpdateUser)) {
        
        $updateUser = new User();
            $updateUser->setLastname($lastname);
            $updateUser->setFirstname($firstname);
            $updateUser->setMail($email);
            $updateUser->setPhone($phoneNumber);

        $user = User::find($id);
        $result = false;
        if (!$updateUser->isMailExists() || $email === $user->mail) {
            $result = $updateUser->update($id);
        }else {
            $errorUpdateUser['errorMail'] = "L'e-mail existe déjà";
        }
        if ($result === true){
            $result = "Tout est OK !";
        }else {
            $result = "Ce n'est pas bon !!";
        }   
    }

    
}

// $listRdvPatients = Appointment::joinPatientRdv($id);

$user = User::find($id);

include(dirname(__FILE__).'/../views/templates/head.php');

include(dirname(__FILE__).'/../views/templates/navbar-others-pages.php');

if (($_SERVER["REQUEST_METHOD"] != "POST") || !empty($errorUpdateUser)) { 
    include(dirname(__FILE__).'/../views/pages/update-user.php');
    // include(dirname(__FILE__).'/../views/liste-rendezvous.php');
} else { 
    include(dirname(__FILE__).'/../views/templates/messages/confirmUpdate.php');
}


include(dirname(__FILE__).'/../views/templates/footer.php');