<main class="backImageForm">
            
    <div class="col-12 title order-2 order-md-1">
        <h1 class="mt-5 pt-5 mb-1 ms-2">Mon espace</h1>                
    </div>

    <div class="container-fluid h-75 p-0 d-flex flex-column justify-content-center">
        <div class="row justify-content-center">
            <section class="col-11 col-sm-9 col-md-8 col-lg-7 col-xl-5 mt-5 order-3 order-md-2 backOrange rounded-3 p-3 mb-5">
                <div class="row justify-content-center">
                    <div class="col-12 col-sm-10">                                                    
                        <h2 class="mb-4 text-center title">Inscription</h2>
                                                            
                        <form action="<?=htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST" class=" ms-4 d-flex flex-column justify-content-center" id="suscribe"> 
                            
                            <label for="lastname" class="mb-1 fs-5 fw-bold">Nom :</label>
                            <div class="form-groupe">                                
                                <input type="text" class="mb-1 p-1 w-75" id="lastname" pattern="<?=REG_STR_NO_NUMBER?>" value="<?=$lastname ?? ''?>" name="lastname" placeholder="Entrez votre Nom" required>
                                <img src="/assets/img/check.svg" alt="icone de validation" class="icone-verif ms-3">
                                <div>
                                    <span class="alertMessage">Veuillez rentrer 2 à 30 caractéres</span>
                                </div>
                            </div>                            
                            <div class="colorRed fst-italic mb-3">
                                <?=$errorArrayCreateAccount['errorLastname'] ?? '';?>
                                <?=$errorArrayCreateAccount['emptyInputLastname'] ?? ''?>
                            </div>
                        
                            <label for="firstame" class="mb-1 fs-5 fw-bold">Prénom :</label>
                            <div class="form-groupe">
                                <input type="text" class="mb-1 p-1 w-75" id="firstname" pattern="<?=REG_STR_NO_NUMBER?>" value="<?=$firstname ?? ''?>" name="firstname" placeholder="Entrez votre Prénom" required>
                                <img src="/assets/img/check.svg" alt="icone de validation" class="icone-verif ms-3">
                                <div>
                                    <span class="alertMessage">Veuillez rentrer 2 à 30 caractéres</span>
                                </div>
                            </div>
                            <div class="colorRed fst-italic mb-3">
                                <?=$errorArrayCreateAccount['errorFirstname'] ?? '';?>
                                <?=$errorArrayCreateAccount['emptyInputFirstname'] ?? ''?>
                            </div>
                            
                            
                            <label for="email" class="mb-1 fs-5 fw-bold">E-mail :</label>
                                <div class="form-groupe">
                                <input type="email" class="mb-1 p-1 w-75" id="email" name="email" value="<?=$email ?? ''?>"  placeholder="Entrez votre e-mail" required>
                                <img src="/assets/img/check.svg" alt="icone de validation" class="icone-verif ms-3">
                                <div>
                                    <span class="alertMessage">email du type exemple@mail.com</span>
                                </div>
                                </div>                               
                            <div class="colorRed fst-italic mb-3">
                                <?=$errorArrayCreateAccount['errorMail'] ?? '';?>
                                <?=$errorArrayCreateAccount['emptyInputMail'] ?? '';?>
                            </div>

                            <label for="phoneNumber" class="mb-1 fs-5 fw-bold">Numéro de téléphone</label>
                                <div class="form-groupe">
                                <input type="tel" class="mb-1 p-1 w-75" id="phoneNumber" name="phoneNumber"
                                value="<?=$phoneNumber ?? ''?>" pattern="<?=REG_STR_PHONENUMBER?>" maxlength="10" placeholder="Entrez votre numéro de téléphone" required>
                                <img src="/assets/img/check.svg" alt="icone de validation" class="icone-verif ms-3"><br>
                                <span class="alertMessage">Veuillez rentrer un numéro de valide</span>
                                </div>
                            <div class="colorRed fst-italic mb-3">
                                <?=$errorArrayCreateAccount['errorPhoneNumber'] ?? '';?>
                                <?=$errorArrayCreateAccount['emptyInputPhoneNumber'] ?? '';?>
                            </div>
                        
                            <div class="d-flex">
                                <label for="password" class="mb-1 me-2 fs-5 fw-bold">Mot de passe :</label>
                                <p class="ps-1 pe-1 bg-secondary text-light rounded-circle" data-toggle="tooltip" data-placement="top" title="1 lettre, 1 symbole et 1 nombre">?</p>
                            </div>
                            
                                <div class="form-groupe">
                                <input type="password" class="mb-1 p-1 w-75" id="password" name="password" placeholder="Entrez un mot de passe" required>
                                <img src="/assets/img/check.svg" alt="icone de validation" class="icone-verif ms-3"><br>
                                <span class="alertMessage">Un symbole, une lettre majuscule et un chiffre</span>
                                </div>
                                <div class="colorRed fst-italic mb-3">

                                    <?=$errorArrayCreateAccount['errorPassword'] ?? '';?>                                    
                                    <?=$errorArrayCreateAccount['emptyInputPassword'] ?? '';?>
                                    <?=$errorArrayCreateAccount['errorChar'] ?? '';?>
                                </div>
                            
                            <div id="errorPassword1"></div>
                            
                            <div class="ligne d-flex justify-content-start mb-3 text-center">
                                <div class="l1"><span>Faible</span></div>
                                <div class="l2"><span>Moyen</span></div>
                                <div class="l3"><span>Fort</span></div>
                            </div>
                                                    
                            <label for="confirmPassword" class="mb-1 fs-5 fw-bold">Confirmez votre mot de passe :</label>
                                <div class="form-groupe">
                                <input type="password" class="mb-3 p-1 w-75" id="confirmPassword" name="confirmPassword" placeholder="Confirmez votre mot de passe" required>
                                <img src="/assets/img/check.svg" alt="icone de validation" class="icone-verif ms-3"><br>
                                </div>
                            <!-- <div class="colorRed fst-italic mb-3">
                                <?=$errorArrayCreateAccount['errorPasswordValidation'] ?? '';?>
                            </div> -->
                            <div id="errorPassword2" class="colorRed"></div>
                            <span class="alertMessage">Veuillez confirmer votre mot de passe</span>
                            
                            <div class="d-flex justify-content-end">
                                <input type="submit" id="" class="btn btn-primary mt-4 fw-bold rounded-pill" value="Je m'inscris"> 
                            </div>
                        </form>
                    </div>                     
                </div>
            </section>                
        </div>
    </div>
</main>