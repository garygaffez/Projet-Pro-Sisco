            <!-- PAGE PRINCIPALE -->
<main class="backImageForm">     
    <div class="col-12 title order-2 order-md-1 mb-3">
        <h1 class="mt-5 ms-2 pt-3 mb-1">Mon espace</h1>                
    </div>
    <!-- bloc orange Connexion -->
    <div class="container-fluid h-50 p-0 d-flex flex-column justify-content-center">
        <div class="row justify-content-center">
            <section class="col-11 col-sm-9 col-md-8 col-lg-7 col-xl-5 mt-5 order-3 order-md-2 backOrange rounded-3 p-3 mb-5">
                <div class="row justify-content-center">
                    <div class="col-12">                                                    
                        <h2 class="mb-4 text-center title">Liste de mes enfants</h2>

                        <form action="<?=htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST" class="d-flex flex-column justify-content-center" id="school"> 

                            <!-- <p class="text-center">J'ai actuellement 0 enfants d'inscrits</p> -->

                            <div class="container">
                                <div class="row">
                                    <div class="col d-flex flex-column">                                                    
                                            <?php
                                            if ($children instanceof PDOException) {?>
                                                <p class=""><?=$children->getMessage();?></p>
                                            <?php                
                                            }else {
                                                
                                            // var_dump($children);
                                                if (count($children) > 0){
                                                    foreach ($children as $child){?> 
                                                    
                                                        <div class="d-flex bd-highlight align-items-center">
                                                            <div class="p-2 bd-highlight">
                                                                <img src="/assets/img/enfants.png" alt="" class="connect">  
                                                            </div>
                                                            <div class="p-2 bd-highlight">
                                                                <a href="/controllers/update-user-controller.php?id=<?=$parent->id_user;?>" class="fs-5 text-decoration-none text-capitalize"><?=$child->firstname;?></a>                                
                                                            </div>

                                                            <div class="ms-3 mb-4 bd-highlight">
                                                                <button type="submit" class="btn btn-primary btn-sm mt-4 fw-bold rounded-pill ">Inscrire à la cantine
                                                                </button>
                                                            </div>
                                                            <div class="p-2 bd-highlight ms-auto">
                                                                <a href="/controllers/delete-child-controller.php?id=<?=$child->id_child;?>" class="delete"><img src="/assets/img/delete-1-icon.png" class="img-thumbnail" alt=""></a>
                                                            </div>
                                                            
                                                        </div>                              
                                                    <?php
                                                    }
                                                }else {?>
                                                    <p class="text-center colorRed">Veuillez ajouter un enfant pour pouvoir l'inscrire à la cantine !</p>
                                                <?php
                                                }                                                      
                                                ?>
                                                <?php
                                            }
                                            ?>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-center fs-5">
                                <p class="colorRed"><?=$errorArrayCreateChild['errorChild'] ?? '';?></p>
                            </div>

                            <h3 class="mb-4 mt-4 text-center title">Ajouter un enfant</h3>
                            
                            <div class="container p-0">
                                <div class="row ps-3">

                                
                            <label for="lastname" class="mb-1 fs-5 fw-bold">Nom :</label>
                            <div class="form-groupe">                                
                                <input type="text" class="mb-1 p-1 w-75" id="lastname" pattern="<?=REG_STR_NO_NUMBER?>" value="<?=$lastname ?? ''?>" name="lastname" placeholder="Entrez votre Nom" required>
                                <img src="/assets/img/check.svg" alt="icone de validation" class="icone-verif ms-3">
                                <span class="alertMessage">Veuillez rentrer 3 à 24 caractéres</span>
                            </div>
                            <div class="colorRed fst-italic mb-3">
                                <?=$errorArrayCreateChild['errorLastname'] ?? '';?>
                                <?=$errorArrayCreateChild['emptyInputLastname'] ?? ''?>
                            </div>
                        
                            <label for="firstname" class="mb-1 fs-5 fw-bold">Prénom :</label>
                            <div class="form-groupe">
                                <input type="text" class="mb-1 p-1 w-75" id="firstname" pattern="<?=REG_STR_NO_NUMBER?>" value="<?=$firstname ?? ''?>" name="firstname" placeholder="Entrez votre Prénom" required>
                                <img src="/assets/img/check.svg" alt="icone de validation" class="icone-verif ms-3">
                                <span class="alertMessage">Veuillez rentrer 3 à 24 caractéres</span>

                            </div>
                            <div class="colorRed fst-italic mb-3">
                                <?=$errorArrayCreateChild['errorFirstname'] ?? '';?>
                                <?=$errorArrayCreateChild['emptyInputFirstname'] ?? ''?>
                            </div>
                    
                            <label class="mb-1 fs-5 fw-bold">Date de naissance</label>
                            <div class="form-groupe">
                                <input type="date" name="birthdate" class="mb-1 p-1 w-75" id="birthdate" placeholder="Date de naissance" value="<?=htmlentities($birthdate ?? '') ?>" required>
                                <img src="/assets/img/check.svg" alt="icone de validation" class="icone-verif ms-3">
                                <span class="alertMessage">Veuillez rentrer 3 à 24 caractéres</span>            
                            </div>
                            <div class="colorRed fst-italic mb-3">
                                <?=htmlentities($errorArrayCreateChild["birthdate"] ?? '');?>
                                <?=htmlentities($errorArrayCreateChild["birthdateTime"] ?? '');?>
                                <?=htmlentities($errorArrayCreateChild["emptyInputBirthDate"] ?? '');?>
                            </div>

                            <!-- <label for="ecole" class="mb-1 fs-5 fw-bold">École :</label>
                            <div class="form-groupe">                                
                                <select class="form-select form-select-sm mb-3" aria-label=".form-select-sm example" name="idSchool" id="idSchool" required>
                                    <option selected></option>
                                    <option value="1">Vaux-sur-Somme</option>
                                    <option value="2">Hamelet</option>
                                    <option value="3">Vaire-sous-Corbie</option>
                                    <option value="4">Le Hamel</option>
                                </select>
                                <img src="/assets/img/check.svg" alt="icone de validation" class="icone-verif ms-3">
                                <span class="alertMessage">Veuillez sélectionner une école</span>
                            </div>

                            <div class="colorRed fst-italic mb-3">
                                <?=$errorArrayCreateChild['emptyIdSchool'] ?? '';?>
                            </div> -->
                            </div>           
                            </div>
        
                            <div class="d-flex justify-content-end me-5">
                                <button type="submit" class="btn btn-primary mt-2 fw-bold rounded-pill ">Ajouter !</button>                                
                            </div>                        
                        </form>
                    </div>                     
                </div>
            </section>                
        </div>
    </div>
</main>