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

require_once (dirname(__FILE__).'/../models/Event.php');

// $id = intval(filter_input(INPUT_GET,'id',FILTER_SANITIZE_NUMBER_INT));
$sending = false;

$event = new Event();

$eventMessage = Event::find();

$id = intval($_SESSION['id']);

$errorArrayAlert = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $textareaContact = trim(filter_input(INPUT_POST,'alert',FILTER_SANITIZE_SPECIAL_CHARS));
    if (empty($textareaContact)) {
        $errorArrayAlert['errortextareaContact'] = 'Ce champ est obligatoire';
    }

    $selectDays = intval(filter_input(INPUT_GET,'days',FILTER_SANITIZE_NUMBER_INT));

    if (empty($errorArrayAlert)) {

        $event->setDescriptionEvent($textareaContact);

        var_dump($event);
        die;

        $verifAlert = $event->isMessageExists();

        if ($verifAlert){
            $errorArrayAlert['errorAlert'] = "un message d'alerte existe déjà, supprimer celui existant !";
        }else {
            if($event->new()){
                $users = User::findAllMail();
                $sending = true;
                    foreach ($users as $user){

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
                            $mail->setFrom('noreply@rpisisco.com', 'Sisco Vaux sur Somme');
                            $mail->addAddress(MAIL_USER, $user->lastname.' '.$user->firstname);     //Add a recipient

                            //Attachments
                            // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
                            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

                            //Content
                            $mail->isHTML(true);                                  //Set email format to HTML
                            $mail->Subject = 'Un nouveau message est disponible !';
                            $mail->Body    ="Bonjour $user->lastname $user->firstname ! Il y a du nouveau :<br> $textareaContact";
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
                    $sending = false;
            }
            $errorArrayAlert['okAlert'] = "Votre message a bien été enregistré !";
        }

    }
    

}






include(dirname(__FILE__).'/../views/templates/head.php');

include(dirname(__FILE__).'/../views/templates/navbar-others-pages.php');

include(dirname(__FILE__).'/../views/pages/event.php');

include(dirname(__FILE__).'/../views/templates/footer.php');