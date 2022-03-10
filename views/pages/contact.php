<main class="backImageForm">
            
    <div class="col-12 title order-2 order-md-1 d-flex">
        <h1 class="mt-5 pt-3 mb-1 ms-2">Contact</h1>                
    </div>

    <div class="container-fluid h-75 p-0 d-flex flex-column justify-content-center">
        <div class="row justify-content-evenly">
            <section class="col-11 col-sm-9 col-md-8 col-lg-7 col-xl-5 mt-5 order-3 order-md-2 backOrange rounded-3 p-3 mb-5">
                <div class="row justify-content-center">
                    <div class="col-10 col-sm-8">                                                    
                        <h2 class="mb-4 text-center title">Vous souhaitez nous contacter ?</h2>
                                                            
                        <form action="<?=htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST" novalidate class="d-flex flex-column justify-content-center">                               
                            <label for="Name" class="mb-1 fw-bold">Nom :</label>
                            <input type="text" class="mb-3 p-1" id="Name" pattern="<?=REG_STR_NO_NUMBER?>" value="<?=$lastname ?? ''?>" name="lastname" placeholder="Entrez votre Nom" required>
                            <div class="colorRed fst-italic mb-3">
                                <?=$errorArrayContact['errorLastname'] ?? '';?>
                                <?=$errorArrayContact['emptyInputLastname'] ?? ''?>
                            </div>                                    
                        
                            <label for="firstName" class="mb-1 fw-bold">Prénom :</label>
                            <input type="text" class="mb-3 p-1" id="firstName" pattern="<?=REG_STR_NO_NUMBER?>" value="<?=$firstname ?? ''?>" name="firstname" placeholder="Entrez votre Prénom" required>
                            <div class="colorRed fst-italic mb-3">
                                <?=$errorArrayContact['errorFirstname'] ?? '';?>
                                <?=$errorArrayContact['emptyInputFirstname'] ?? ''?>
                            </div>
                                                    
                            <label for="email" class="mb-1 fw-bold">E-mail :</label>
                            <input type="email" class="mb-3 p-1" id="email" name="email" value="<?=$email ?? ''?>"  placeholder="Entrez votre e-mail" required>
                            <span class="alertMessage">Veuillez rentrer un e-mail valide</span>
                            <div class="colorRed fst-italic mb-3">
                                <?=$errorArrayContact['errorMail'] ?? '';?>
                                <?=$errorArrayContact['emptyInputMail'] ?? '';?>
                            </div>
                        
                            <label for="phoneNumber" class="mb-1 fw-bold">Numéro de téléphone</label>
                                    <input type="tel" class="mb-3 p-1" id="phoneNumber" name="phoneNumber"
                                    value="<?=$phoneNumber ?? ''?>" pattern="<?=REG_STR_PHONENUMBER?>" minlength="10">

                            <label for="textareaContact" class="mb-1 text-center fs-6 fw-bold">Saisissez un message :</label>
                            <textarea id="story" name="textareaContact" rows="5" cols="33" class="mb-1 p-1" maxlength="250" required></textarea>
                            <div class="colorRed fst-italic mb-3">
                                <?=$errorArrayContact['errortextareaContact'] ?? '';?>
                            </div>
                            
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary mt-4 fw-bold rounded-pill w-75">Envoyer !</button>
                            </div>
                        </form>
                    </div>                     
                </div>
            </section>   
            
            <aside class="col-11 col-sm-8 col-md-7 col-lg-3 col-xl-3  mt-5 h-100 order-2 order-md-1">
                <div class="row">
                    <div class="text-center">
                        <p class="fs-5 m-0 mt-2">1 rue du Calvaire</p>
                        <p class="fs-5 m-0">80800 Vaux sur Somme</p>
                    </div>
                </div>
                                
                <div class="row">
                    <div class="col d-flex justify-content-center m-3">
                        <iframe class="embed-reponsive-item" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3632.6642099907117!2d2.546735537297281!3d49.923552601627925!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e78b4ced546061%3A0xe41c8d19f142f49c!2s1%20Rue%20du%20Calvaire%2C%2080340%20Vaux-sur-Somme!5e0!3m2!1sfr!2sfr!4v1642153059394!5m2!1sfr!2sfr" width="300" height="200" style="border: 1px solid black;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
                            
                <div class="contenu mt-2">
                    <h5 class="text-decoration-underline text-center fs-4">Secrétariat du SISCO</h5>
                    <p class="m-0 text-center">Mr PARENT Christophe :</p>
                    <p class="text-center"><a href="tel:0322565656" class="text-decoration-none">03 22 56 56 56</a></p>               
                </div>
                <div class="contenu mt-2">
                    <h5 class="text-decoration-underline text-center fs-4">Président du SISCO</h5>
                    <p class="m-0 text-center">Mr PARENT Christophe :</p>
                    <p class="text-center"><a href="tel:0322565656" class="text-decoration-none text">03 22 56 56 56</a></p>               
                </div>
                <div class="contenu mt-2">
                    <h5 class="text-decoration-underline text-center fs-4">Directrice périscolaire</h5>
                    <p class="m-0 text-center">Mme DEROLLEZ Natacha :</p>
                    <p class="text-center"><a href="tel:0322565656" class="text-decoration-none">03 22 56 56 56</a></p>               
                </div>                
            </aside> 
        </div>
    </div>