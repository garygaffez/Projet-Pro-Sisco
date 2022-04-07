<?php

session_start();

$errorArrayConnection = [];

if (isset($_SESSION['id'])){
    header('location: /controllers/profil-controller.php');
}

require_once(dirname(__FILE__).'/../utils/regex.php');

require_once (dirname(__FILE__).'/../models/User.php');

$id = intval(filter_input(INPUT_GET,'id',FILTER_SANITIZE_NUMBER_INT));

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = trim(filter_input(INPUT_POST,'email',FILTER_SANITIZE_EMAIL));
    if(!empty($email)) {
        $resultEmail = filter_var($email, FILTER_VALIDATE_EMAIL);
        if ($resultEmail == false) {    
            $errorArrayConnection['errorMail'] = "$email n'est pas une adresse mail valide !";
        }
    }else{
        $errorArrayConnection['emptyInputMail'] = 'le mail est obligatoire !';  
    }

    $password = $_POST['password'];
    if (empty($password)) {
        $errorArrayConnection['emptyInputPassword'] = 'Ce champ est obligatoire !';
    }

    if (empty($errorArrayConnection)) {
        
        //nouvelle instanciation de la classe User
        $parent = new User();

        //envoie du mail
        $parent->setMail($email);

        //connexion avec la méthode login
        $user = $parent->login();

        if(!$user){
            $errorArrayConnection['noAccount'] = 'Il n\'existe pas de compte pour cette adresse mail !';

        //Si la date de validation est différent de NULL (donc si le compte est validé)...
        }else if ($user->validated_at != NULL) {

            //Si le mot de passe correspond au hachage
            if (password_verify($password, $user->password)){

                //alors on ouvre une session utilisateur
                $_SESSION['id'] = $user->id_user;
                $_SESSION['firstname'] = $user->firstname;
                $_SESSION['admin'] = $user->admin;

                //Si l'utilisateur a un rôle administrateur
                if ($_SESSION['admin'] === '1'){

                    //alors on le redirige sur son tableau de bord
                    header('location: /controllers/dashboard-controller.php'); die;
                }else{
                    //sinon on le redirige sur sa page de profil
                    header('location: /controllers/profil-controller.php'); die;
                }                    
            }else{
                $errorArrayConnection['errorPasswordValidation'] = 'Veuillez vérifier vos identifiants !';
            }
        }else { 
            $errorArrayConnection['errorValid'] = "Veuillez valider votre compte avant de vous connecter!";
        }
        }
    
}


include(dirname(__FILE__).'/../views/templates/head.php');

include(dirname(__FILE__).'/../views/templates/navbar-others-pages.php');

include(dirname(__FILE__).'/../views/pages/connexion.php');

include(dirname(__FILE__).'/../views/templates/footer.php');