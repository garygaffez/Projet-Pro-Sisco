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
                    <div class="col-10 col-sm-8">                                                    
                        <h2 class="mb-4 text-center title">Connexion</h2> 
                        <!-- formulaire  -->
                        <form action="<?=htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST" novalidate class="d-flex flex-column">                                                                                     
                            <label for="email" class="mb-1 fw-bold">Veuillez entrez votre e-mail</label>
                            <input type="email" class="mb-3 p-1" id="email" name="email" placeholder="E-mail" value="<?=$email ?? ''?>" required>
                            <img src="/assets/img/check.svg" alt="icone de validation" class="icone-verif">
                            <span class="alertMessage">Veuillez rentrer un e-mail valide</span>
                            <div class="text-danger fst-italic mb-3">
                                <?=$errorArrayConnection['errorMail'] ?? '';?>
                                <?=$errorArrayConnection['emptyInputMail'] ?? '';?>
                            </div>
                        
                            <label for="password" class="mb-1 fw-bold">Veuillez entrez votre mot de passe</label>
                            <input type="password" class="mb-3 p-1" id="password" name="password" placeholder="Mot de passe" required>
                            <div class="text-danger fst-italic mb-3">
                                <?=$errorArrayConnection['emptyInputPassword'] ?? '';?>
                            </div>
                            <span class="alertMessage">Mot de passe incorrect !</span>

                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary mt-4 fw-bold rounded-pill w-75">Je me connecte !</button>
                            </div>

                            <div class="d-flex justify-content-center pt-4">
                                <a href="/controllers/create-account-controller.php" class="text-decoration-none linkConnection">Pas encore de compte ?</a>
                            </div>
                            
                        </form>
                    </div>                     
                </div>
            </section>                
        </div>
    </div>
</main>