<main class="backImageForm">

    <div class="row justify-content-center backOrange">
        <div class="col-12 title order-2 order-md-1">
            <h1 class="mt-5 pt-5 ps-3 mb-1 ms-2">Admin</h1>
        </div>

        <section class="col-12 col-md-10 col-xl-7 mt-5 order-3 order-md-2 backWhite rounded-3 p-3 mb-5">
            <div class="col-12 title order-2 order-md-1 text-center mb-4">
                <h2 class="mt-2 mb-1">Mon tableau de bord</h2>
            </div>

            <div class="col-12 order-2 order-md-1 text-center">
                <h2 class="fs-4">Je choisis une période :</h2>
            </div>

            <div class="row justify-content-center">
                <form method="GET" class="d-flex justify-content-center">
                    <div class="col col-md-3 d-flex me-3">
                        <select name="month" id="month" class="my-3 form-control">
                            <?php
                                foreach ($monthsName as $key => $monthNameInSelect) {
                                    $monthValue = intval($key+1);
                                    $isSelected = ($month==$monthValue) ? 'selected' : '';
                                    echo "<option $isSelected value=\"$monthValue\">$monthNameInSelect</option>";
                                }
                            ?>
                        </select>
                    </div>    
                    
                    <div class="col col-md-3 d-flex">
                        <select name="year" id="year" class="my-3 form-control">
                            <?php
                                for($yearInSelect=date('Y');$yearInSelect<=date('Y')+1; $yearInSelect++){
                                    $isSelected = ($year==$yearInSelect) ? 'selected' : '';
                                    echo '<option value="'.$yearInSelect.'" '.$isSelected.'>'.$yearInSelect.'</option>';
                                }
                            ?>
                        </select>
                    </div>
                        
                    <div class="col col-md-2 d-flex justify-content-center align-items-center">
                        <input type="submit" class="btn btn-primary fw-bold rounded-pill w-75 h-50" value="Valider">                               
                    </div> 
                </form>
            </div>

            <div class="row">
                <div class="col-12 title text-center mt-3 mb-3">
                    <h2 class="fs-4">Nombre d'enfants inscrits :</h2>
                    <p class="text-center text-danger m-0">???</p>
                    <div class="mb-3">
                        <a href="liste-parents-controller.php" class="mb-3">Voir la liste</a>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="row justify-content-center">
                        <div class="col-10 col-sm-8 col-md-6 col-xl-4 d-flex">
                            <table class="table table table-bordered text-center mt-3">
                                <thead class="table-info">
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">Hamelet</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th scope="row">Enfants inscrits</th>
                                        <td class="text-danger">???</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="col-10 col-sm-8 col-md-6 col-xl-4 d-flex">
                            <table class="table table table-bordered text-center mt-3">
                                <thead class="table-info">
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">Vaire-sous-Corbie</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th scope="row">Enfants inscrits</th>
                                        <td class="text-danger">???</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div> 
                    
                    <div class="row justify-content-center">
                        <div class="col-10 col-sm-8 col-md-6 col-xl-4 d-flex">
                            <table class="table table table-bordered text-center mt-3">
                                <thead class="table-info">
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">Le Hamel</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th scope="row">Enfants inscrits</th>
                                        <td class="text-danger">???</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="col-10 col-sm-8 col-md-6 col-xl-4 d-flex">
                            <table class="table table table-bordered text-center mt-3">
                                <thead class="table-info">
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">Vaux-sur-Somme</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th scope="row">Enfants inscrits</th>
                                        <td class="text-danger">???</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>  
                </div>
            </div>
            
            <div class="row justify-content-center">
                <div class="col-12 col-lg-10">
                    <div class="row justify-content-center mt-4">
                        <div class="col-12 col-sm-8 col-lg-4 text-center">                        
                            <input type="submit" class="btn btn-primary fw-bold rounded-pill w-75" value="Ajouter un enfant"> 
                        </div>                              
                        <div class="col-12 col-sm-8 col-lg-4 text-center">
                            <input type="submit" class="btn btn-primary fw-bold rounded-pill w-75" value="Supprimer un enfant">
                        </div>
                    </div>                                                                             
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-12 col-lg-10">
                    <div class="row justify-content-center mt-4">
                        <div class="col-12 col-sm-8 col-lg-4 text-center">                        
                            <button type="submit" class="btn btn-danger fw-bold rounded-pill w-75 mt-2">
                                <a href="event-controller.php" class="text-white text-decoration-none">Ajouter un message d'alerte</a>
                            </button>
                        </div>                              
                    </div>                                                                             
                </div>
            </div>

        </section>
    </div>

</main>

