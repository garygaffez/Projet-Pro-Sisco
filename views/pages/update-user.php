<?=$result ?? '';?>

<div class="row justify-content-center backOrange">
    <div class="col-12 title order-2 order-md-1">
        <h1 class="mt-5 pt-5 ps-3 mb-1 ms-2">Admin</h1>                
    </div>

            <section class="col-11 col-sm-9 col-md-8 col-lg-7 col-xl-5 mt-5 order-3 order-md-2 backWhite rounded-3 p-3 mb-5">

                <div class="row justify-content-center">
                    <div class="col-12 col-sm-10">                                                    
                        <h2 class="mb-4 text-center title">Modifier un utilisateur</h2>
                        <?php
                            if ($user instanceof PDOException){
                                echo $user->getMessage();
                            }else{?>                                                            
                                <form action="<?=htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST" class="d-flex flex-column justify-content-center" id=""> 

                                <input type="hidden" name="id" value="<?=$_GET['id'];?>">
                                    
                                    <label for="lastname" class="mb-1 fs-5 fw-bold">Nom :</label>
                                    <div class="form-groupe">                                
                                        <input type="text" class="mb-1 p-1 w-75" id="lastname" pattern="<?=REG_STR_NO_NUMBER?>" value="<?=$user->lastname ?? ''?>" name="lastname" placeholder="Entrez votre Nom" required>
                                        <img src="/assets/img/check.svg" alt="icone de validation" class="icone-verif ms-3">
                                        <span class="alertMessage">Veuillez rentrer 3 à 24 caractéres</span>
                                    </div>
                                    <div class="colorRed fst-italic mb-3">
                                        <?=$errorUpdateUser['errorLastname'] ?? '';?>
                                        <?=$errorUpdateUser['emptyInputLastname'] ?? ''?>
                                    </div>
                                
                                    <label for="firstname" class="mb-1 fs-5 fw-bold">Prénom :</label>
                                    <div class="form-groupe">
                                        <input type="text" class="mb-1 p-1 w-75" id="firstname" pattern="<?=REG_STR_NO_NUMBER?>" value="<?=$user->firstname ?? ''?>" name="firstname" placeholder="Entrez votre Prénom" required>
                                        <img src="/assets/img/check.svg" alt="icone de validation" class="icone-verif ms-3">
                                        <span class="alertMessage">Veuillez rentrer 3 à 24 caractéres</span>

                                    </div>
                                    <div class="colorRed fst-italic mb-3">
                                        <?=$errorUpdateUser['errorFirstname'] ?? '';?>
                                        <?=$errorUpdateUser['emptyInputFirstname'] ?? ''?>
                                    </div>
                                    
                                    
                                    <label for="email" class="mb-1 fs-5 fw-bold">E-mail :</label>
                                        <div class="form-groupe">
                                        <input type="email" class="mb-1 p-1 w-75" id="email" name="email" value="<?=$user->mail ?? ''?>"  placeholder="Entrez votre e-mail" required>
                                        <img src="/assets/img/check.svg" alt="icone de validation" class="icone-verif ms-3">
                                        <span class="alertMessage">email du type exemple@mail.com</span>
                                        </div>                               
                                    <div class="colorRed fst-italic mb-3">
                                        <?=$errorUpdateUser['errorMail'] ?? '';?>
                                        <?=$errorUpdateUser['emptyInputMail'] ?? '';?>
                                    </div>

                                    <label for="phoneNumber" class="mb-1 fs-5 fw-bold">Numéro de téléphone</label>
                                        <div class="form-groupe">
                                        <input type="tel" class="mb-1 p-1 w-75" id="phoneNumber" name="phoneNumber"
                                        value="<?=$user->phone ?? ''?>" pattern="<?=REG_STR_PHONENUMBER?>" maxlength="10" placeholder="Entrez votre numéro de téléphone" required>
                                        <img src="/assets/img/check.svg" alt="icone de validation" class="icone-verif ms-3"><br>

                                        <span class="alertMessage">Veuillez rentrer un numéro de valide</span>
                                        </div>
                                    <div class="colorRed fst-italic mb-3">
                                        <?=$errorUpdateUser['errorPhoneNumber'] ?? '';?>
                                        <?=$errorUpdateUser['emptyInputPhoneNumber'] ?? '';?>
                                    </div>

                                    <div class="d-flex justify-content-end">
                                        <input type="submit" class="btn btn-primary mt-4 fw-bold rounded-pill" value="Enregistrer les modifications"> 
                                    </div>

                                </form>
                        <?php
                        }
                        ?>
                    </div>                     
                </div>
            </section>                
        </div>
    </div>
