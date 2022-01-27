<main class="backImageForm">
            
    <div class="col-12 title order-2 order-md-1">
        <h1 class="mt-5 pt-3 mb-1 ms-2">Mon espace</h1>                
    </div>

    <div class="container-fluid h-75 p-0 d-flex flex-column justify-content-center">
        <div class="row justify-content-center">
            <section class="col-11 col-sm-9 col-md-8 col-lg-7 col-xl-5 mt-5 order-3 order-md-2 backOrange rounded-3 p-3 mb-5">
                <div class="row justify-content-center">
                    <div class="col-10 col-sm-8">                                                    
                        <h2 class="mb-4 text-center title">Inscription</h2>
                                                            
                        <form action="<?=htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST" class="d-flex flex-column justify-content-center" id="suscribe">  
                        
                            <label for="Name" class="mb-1 fw-bold">Nom :</label>

                        <div class="pstrlt">
                            <input type="text" class="mb-3 p-1" id="Name" pattern="<?=REG_STR_NO_NUMBER?>" value="<?=$lastname ?? ''?>" name="lastname" placeholder="Entrez votre Nom" required>
                            <img src="/assets/img/check.svg" alt="icone de validation" class="icone-verif">
                        </div>
                            <div class="text-danger fst-italic mb-3">
                                <?=$errorArrayCreateAccount['errorLastname'] ?? '';?>
                                <?=$errorArrayCreateAccount['emptyInputLastname'] ?? ''?>
                            </div>
                        
                            <label for="firstName" class="mb-1 fw-bold">Prénom :</label>
                            <input type="text" class="mb-3 p-1" id="firstName" pattern="<?=REG_STR_NO_NUMBER?>" value="<?=$firstname ?? ''?>" name="firstname" placeholder="Entrez votre Prénom" required>
                            <img src="/assets/img/check.svg" alt="icone de validation" class="icone-verif">
                            <div class="text-danger fst-italic mb-3">
                                <?=$errorArrayCreateAccount['errorFirstname'] ?? '';?>
                                <?=$errorArrayCreateAccount['emptyInputFirstname'] ?? ''?>
                            </div>
                                                    
                            <label for="email" class="mb-1 fw-bold">E-mail :</label>
                            <input type="email" class="mb-3 p-1" id="email" name="email" value="<?=$email ?? ''?>"  placeholder="Entrez votre e-mail" required>
                            <img src="/assets/img/check.svg" alt="icone de validation" class="icone-verif">
                            <span class="alertMessage">Veuillez rentrer un e-mail valide</span>
                            <div class="text-danger fst-italic mb-3">
                                <?=$errorArrayCreateAccount['errorMail'] ?? '';?>
                                <?=$errorArrayCreateAccount['emptyInputMail'] ?? '';?>
                            </div>

                            <label for="phoneNumber" class="mb-1 fw-bold">Numéro de téléphone</label>
                            <input type="tel" class="mb-1 p-1" id="phoneNumber" name="phoneNumber"
                            value="<?=$phoneNumber ?? ''?>" pattern="<?=REG_STR_PHONENUMBER?>" maxlength="10" placeholder="Entrez votre numéro de téléphone" required>
                            <img src="/assets/img/check.svg" alt="icone de validation" class="icone-verif">
                            <div class="text-danger fst-italic mb-3">
                                <?=$errorArrayCreateAccount['errorPhoneNumber'] ?? '';?>
                                <?=$errorArrayCreateAccount['emptyInputPhoneNumber'] ?? '';?>
                            </div>
                        
                            <label for="password" class="mb-1 fw-bold">Mot de passe :</label>
                            <input type="password" class="mb-3 p-1" id="password" name="password" placeholder="Entrez un mot de passe">
                            <div class="text-danger fst-italic mb-3" required>
                            <img src="/assets/img/check.svg" alt="icone de validation" class="icone-verif">
                                <?=$errorArrayCreateAccount['emptyInputPassword'] ?? '';?>
                            </div>
                            <div  id="errorPassword1"></div>
                            <span class="alertMessage">Un symbole, une lettre majuscule et un chiffre</span>
                            <div class="ligne d-flex justify-content-around mb-3 text-center">
                                <div class="l1"><span>Faible</span></div>
                                <div class="l2"><span>Moyen</span></div>
                                <div class="l3"><span>Fort</span></div>
                            </div>
                                                    
                            <label for="confirmPassword" class="mb-1 fw-bold">Confirmez votre mot de passe :</label>
                            <input type="password" class="mb-3 p-1" id="confirmPassword" name="confirmPassword" placeholder="Confirmez votre mot de passe" required>
                            <img src="/assets/img/check.svg" alt="icone de validation" class="icone-verif">
                            <div class="text-danger fst-italic mb-3">
                                <?=$errorArrayCreateAccount['invalidConfirmation'] ?? '';?>
                            </div>
                            <div  id="errorPassword2"></div>
                            <span class="alertMessage">Veuillez rentrer un e-mail valide</span>
                            
                            <div class="d-flex justify-content-center">
                                <input type="submit" id="validInscription" class="btn btn-primary mt-4 fw-bold rounded-pill w-75" value="Je m'inscris"> 
                            </div>
                        </form>
                    </div>                     
                </div>
            </section>                
        </div>
    </div>