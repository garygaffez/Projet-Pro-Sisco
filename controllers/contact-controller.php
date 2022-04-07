<?php

session_start();

//Load Composer's autoloader
require dirname(__FILE__) . '/../vendor/autoload.php';
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once(dirname(__FILE__).'/../utils/regex.php');

require_once (dirname(__FILE__).'/../models/User.php');

$form = new User();

$errorArrayContact = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $firstname = trim(filter_input(INPUT_POST,'firstname',FILTER_SANITIZE_STRING));
    if (!empty($firstname)) {
        $resultFirstname = filter_var($firstname, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/".REG_STR_NO_NUMBER."/")));
        if ($resultFirstname == false) {
            $errorArrayContact['errorFirstname'] = 'le prénom n\'a pas le bon format !';
        }
    } else {
        $errorArrayContact['emptyInputFirstname'] = 'le prénom est obligatoire !';
    }

    $lastname = trim(filter_input(INPUT_POST,'lastname',FILTER_SANITIZE_STRING));
    if (!empty($lastname)) {
        $resultLastname = filter_var($lastname, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/".REG_STR_NO_NUMBER."/")));
        if ($resultLastname == false) {
            $errorArrayContact['errorLastname'] = 'le nom n\'a pas le bon format !';
        }
    }else {
        $errorArrayContact['emptyInputLastname'] = 'le nom est obligatoire !';
    }

    $email = trim(filter_input(INPUT_POST,'email',FILTER_SANITIZE_EMAIL));
    if(!empty($email)) {
        $resultEmail = filter_var($email, FILTER_VALIDATE_EMAIL);
        if ($resultEmail == false) {    
            $errorArrayContact['errorMail'] = "$email n'est pas une adresse mail valide !";
        }
    }else{
        $errorArrayContact['emptyInputMail'] = 'le mail est obligatoire !';  
    }

    $phoneNumber = trim(filter_input(INPUT_POST,'phoneNumber',FILTER_SANITIZE_STRING));
    if(!empty($phoneNumber)) {
        $resultphoneNumber = filter_var($phoneNumber, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/".REG_STR_PHONENUMBER."/")));
        if ($resultphoneNumber == false) {    
            $errorArrayContact['errorPhoneNumber'] = "le numéro de téléphone n'est pas valide";
        }
    }else{
        $errorArrayContact['emptyInputPhoneNumber'] = 'le numéro de téléphone est obligatoire';  
    }

    $textareaContact = trim(filter_input(INPUT_POST,'textareaContact',FILTER_SANITIZE_STRING));
    if (empty($textareaContact)) {
        $errorArrayContact['errortextareaContact'] = 'Ce champ est obligatoire';
    }

    if (empty($errorArrayContact)) {

        

        $form->setMessageFormContact($textareaContact);



        var_dump($form);

        //Et création d'une nouvelle instance de la classe PHPMailer
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
            $mail->setFrom("$email");
            $mail->addAddress(MAIL_USER, 'Natacha');     //Add a recipient

            //Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Un nouveau message est disponible !';
            $mail->Body    ="$textareaContact";
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

    }
}

include(dirname(__FILE__).'/../views/templates/head.php');

include(dirname(__FILE__).'/../views/templates/navbar-others-pages.php');

include(dirname(__FILE__).'/../views/pages/contact.php');

include(dirname(__FILE__).'/../views/templates/footer.php');