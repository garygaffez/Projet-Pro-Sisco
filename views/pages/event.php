<main class="backImageForm">
    <div class="container h-75 p-0 d-flex flex-column justify-content-center">
        <div class="row justify-content-center backOrange">
            <div class="col-12 title order-2 order-md-1">
                <h1 class="mt-5 pt-5 ps-3 mb-1 ms-2">Admin</h1>
            </div>

            <section class="col-12 col-md-8 col-xl-6 mt-5 order-3 order-md-2 backWhite rounded-3 p-3 mb-5">

                <div class="col-12 text-start mt-3 mb-3">
                    <a href="dashboard-controller.php" class="pb-3"><- Retourner à mon tableau de bord</a>
                </div>

                <div class="col-12 title order-2 order-md-1 text-center">
                    <h2 class="mt-2 ps-3 mb-1 ms-2">Message d'alerte</h2>
                </div>

                <div class="row justify-content-center">
                    <div class="col-12 col-sm-6 d-flex justify-content-center">
                        <form action="<?=htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST" class="mt-3" id="form">

                            <div class="row">
                                <div class="col mb-3">
                                    <?php 
                                        if ($sending == false){?>
                                            <textarea name="alert" id="alert" cols="50" rows="10">
                                                <?=isset($eventMessage->description) ? $eventMessage->description : null?>
                                        </textarea>
                                        <?php
                                        }else {?>
                                            <div class="alert alert-info">Envoie de mail en cours !</div>
                                        <?php
                                        }
                                        ?>
                                    
                                </div>

                            </div>

                            <div class="text-center mb-2">
                                <?=$errorArrayAlert['errorAlert'] ?? '';?>
                                <?=$errorArrayAlert['okAlert'] ?? '';?>
                                <?=$errorArrayAlert['okDelete'] ?? '';?>
                            
                            </div>

                            <div class="row justify-content-center">
                                <!-- <div class="col-12 text-center mb-2">
                                    <label for="">Combien de jours voulez-vous conserver le message ?</label>
                                </div>

                            <div class="row justify-content-center">
                                <div class="col-12 col-xl-5">
                                    <select name="days" class="form-select me-2">
                                        <option value="3">3</option>
                                        <option value="7">7</option>
                                        <option value="15">15</option>
                                        <option value="30">30</option>
                                    </select>
                                </div>
                            </div> -->

                                <div class="col-3 col-xl-4 d-flex justify-content-center">
                                    <button type="submit" class="btn btn-success btn-sm">Modifier</button>
                                </div>

                                <div class="col-3 col-xl-4 d-flex justify-content-center">
                                    <button type="submit" class="btn btn-primary">Valider</button>
                                </div>

                                <div class="col-3 col-xl-4 d-flex justify-content-center">
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <a href="delete-alert-controller.php?id=<?=$id;?>" class="text-white text-decoration-none">Supprimer</a>
                                    </button>
                                </div>
                                                            
                            </div>         
                        </form>

                    </div>
                </div>

            </section>
        </div>
    </div>
</main>