<?php

session_start();

if (isset($_SESSION['id'])){
    // header('location: /controllers/profil-controller.php');
}

//Load Composer's autoloader
require dirname(__FILE__) . '/../vendor/autoload.php';
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once(dirname(__FILE__).'/../utils/config.php');

require_once(dirname(__FILE__).'/../utils/regex.php');

require_once (dirname(__FILE__).'/../models/User.php');

$result = false;

$errorArrayCreateAccount = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    extract($_POST);

    $tokenRegister = bin2hex(random_bytes(50));

    if (!empty($firstname)) {
        $resultFirstname = preg_match("/^[a-zÀ-ÿA-Z '-]+$/", $firstname);
        if ($resultFirstname == false) {
            $errorArrayCreateAccount['errorFirstname'] = 'le prénom n\'a pas le bon format !';
        }else {
            $firstname = trim(filter_var($firstname,FILTER_SANITIZE_SPECIAL_CHARS));
        }
    } else {
        $errorArrayCreateAccount['emptyInputFirstname'] = 'le prénom est obligatoire !';
    }

    $lastname = trim(filter_input(INPUT_POST,'lastname',FILTER_SANITIZE_SPECIAL_CHARS));
    if (!empty($lastname)) {
        $resultLastname = preg_match("/^[a-zÀ-ÿA-Z '-]+$/", $lastname);
        if ($resultLastname == false) {
            $errorArrayCreateAccount['errorLastname'] = 'le nom n\'a pas le bon format !';
        } 
    }else {
        $errorArrayCreateAccount['emptyInputLastname'] = 'le nom est obligatoire !';
    }

    $email = trim(filter_input(INPUT_POST,'email',FILTER_SANITIZE_EMAIL));
    if(!empty($email)) {
        $resultEmail = filter_var($email, FILTER_VALIDATE_EMAIL);
        if ($resultEmail == false) {    
            $errorArrayCreateAccount['errorMail'] = "$email n'est pas une adresse mail valide !";
        }
    }else{
        $errorArrayCreateAccount['emptyInputMail'] = 'le mail est obligatoire !';  
    }

    $phoneNumber = trim(filter_input(INPUT_POST,'phoneNumber',FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?? '');
    if(!empty($phoneNumber)) {
        $resultphoneNumber = filter_var($phoneNumber, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/".REG_STR_PHONENUMBER."/")));
        if ($resultphoneNumber == false) {    
            $errorArrayCreateAccount['errorPhoneNumber'] = "le numéro de téléphone n'est pas valide";
        }
    }else{
        $errorArrayCreateAccount['emptyInputPhoneNumber'] = 'le numéro de téléphone est obligatoire';  
    }

    

    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    if (!empty($password)) {
        if ($password == $confirmPassword){
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        }
    }else {
        $errorArrayCreateAccount['emptyInputPassword'] = 'Ce champ est obligatoire !';
    }

    if (empty($errorArrayCreateAccount)) {
        
        $user = new User($lastname, $firstname, $email, $phoneNumber, $hashedPassword);

        $user->setTokenRegister($tokenRegister);



//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);


try {

    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );

    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();   
    // $mail->isSendmail();                                         //Send using SMTP
    $mail->Host       = SMTP_HOST;                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = MAIL_USER;                     //SMTP username
    $mail->Password   = MAIL_PASSWORD;                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = SMTP_PORT; 
    $mail->SMTPKeepAlive = true;                                   //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('noreply@rpisisco.com', 'Sisco Vaux sur Somme');
    $mail->addAddress(MAIL_USER, $lastname.' '.$firstname);     //Add a recipient

    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Validez votre compte !';
    $mail->Body    = 'Cliquez sur ce lien pour valider votre compte <a href="http://projet_pro_sisco.localhost/controllers/valid-account-controller.php?token='.$tokenRegister.'">Valider</a>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    // $mail->send();
    if($mail->Send() === true){
        // echo 'Le message a été envoyé';
    }else{
        echo "ERREUR : ".$mail->ErrorInfo;
    }

} catch (Exception $e) {
    echo "Le mail n'a pas été envoyé !{$mail->ErrorInfo}";
}

    // var_dump($user);
    $verifMail = $user->isMailExists();
    if (!$verifMail){
        $result = $user->new();
    }else {
        $errorArrayCreateAccount['errorMail'] = "l'adresse mail est déjà existante !";
    }   
}


}

include(dirname(__FILE__).'/../views/templates/head.php');

include(dirname(__FILE__).'/../views/templates/navbar-others-pages.php');

if (($_SERVER["REQUEST_METHOD"] != "POST") || !empty($errorArrayCreateAccount)) { 
    include(dirname(__FILE__).'/../views/pages/create-account.php');
} else { 
    include(dirname(__FILE__).'/../views/pages/messageConfirmation.php');
}

include(dirname(__FILE__).'/../views/templates/footer.php');