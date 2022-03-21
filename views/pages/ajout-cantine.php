            <!-- PAGE PRINCIPALE -->
<!-- <?php var_dump($idSchool);?> -->
<main class="backImageForm">     
    <div class="col-12 title order-2 order-md-1 mb-3">
        <h1 class="mt-5 pt-5 ms-3 pt-3 mb-1">Mon espace</h1>                
    </div>
    <!-- bloc orange Connexion -->
    <div class="container-fluid h-50 p-0 d-flex flex-column justify-content-center">
        <div class="row justify-content-center">
            <section class="col-11 col-sm-9 col-md-8 col-lg-7 mt-5 order-3 order-md-2 backOrange rounded-3 p-3 mb-5">
                <h3 class="mb-4 text-center title">J'inscris <span class="text-capitalize fw-bold"><?=$child->firstname;?></span>  à la cantine</h3>
                <form action="<?=htmlspecialchars($_SERVER['PHP_SELF'])?>?id=<?=$idChild?>" method="POST" id='formCalendar' class="" novalidate>
                    <div class="d-flex justify-content-center flex-column">
                        <div class="form-groupe col-8 col-md-6 col-xl-4 mb-3">                                
                            <select class="form-select mb-3" aria-label=".form-select-sm example" name="idSchool" id="idSchool" required>
                                <option selected>Choisissez une école</option>
                                <option value="1" <?=($idSchool === 1) ? 'selected' : '';?>>Vaux-sur-Somme</option>
                                <option value="2" <?=($idSchool === 2) ? 'selected' : '';?>>Hamelet</option>
                                <option value="3" <?=($idSchool === 3) ? 'selected' : '';?>>Vaire-sous-Corbie</option>
                                <option value="4" <?=($idSchool === 4) ? 'selected' : '';?>>Le Hamel</option>
                            </select>                                
                            <span class="alertMessage">Veuillez sélectionner une école</span>
                            <div class="colorRed fst-italic mb-3">
                                <?=$errorArrayCreateChild['emptyIdSchool'] ?? '';?>
                            </div>
                                    
                            <select name="month" id="month" class="my-3 form-control">
                                <?php
                                    foreach ($monthsName as $key => $monthNameInSelect) {
                                        $monthValue = intval($key+1);
                                        $isSelected = ($month==$monthValue) ? 'selected' : '';
                                        echo "<option $isSelected value=\"$monthValue\">$monthNameInSelect</option>";
                                    }
                                ?>
                            </select>

                            <select name="year" id="year" class="form-control">
                                <?php
                                    for($yearInSelect=date('Y');$yearInSelect<=date('Y')+1; $yearInSelect++){
                                        $isSelected = ($year==$yearInSelect) ? 'selected' : '';
                                        echo '<option value="'.$yearInSelect.'" '.$isSelected.'>'.$yearInSelect.'</option>';
                                    }
                                ?>
                            </select>

                            <div class="d-flex justify-content-end me-5">
                                <input type="submit" class="btn btn-primary mt-2 fw-bold rounded-pill " value="Valider">                               
                            </div> 
                        </div>
                        </div>

                
                        <div class="table-responsive">
                                    <table class="mt-3 table table-rpi table-bordered border-white text-center">
                                    <thead>
                                        <tr>
                                            <th scope="col">Lundi</th>
                                            <th scope="col">Mardi</th>
                                            <th scope="col">Mercredi</th>
                                            <th scope="col">Jeudi</th>
                                            <th scope="col">Vendredi</th>
                                            <th scope="col">Samedi</th>
                                            <th scope="col">Dimanche</th>
                                        </tr>

                                    </thead>
                                    <tbody>
                                        <?php
                                            $index = 0;
                                            for($j=1;$j<=$nbWeeks;$j++){
                                        ?>
                                        <tr>
                                            <?php
                                                for($i=1;$i<=7;$i++){
                                                    $color = (date("j-n-Y")=="$daysInMonth[$index]-$month-$year") ? 'bg-danger bg-gradient' : '';
                                                    $canteenColor = $registrationCanteen;
                                                    foreach ($canteenColor as $date){
                                                    
                                                        var_dump($date);
                                                        ?>
                                                        <td class="bg-success"></td>
                                                    <?php
                                                    }
                                                    die;
                                                    $day = "$daysInMonth[$index]-$month-$year";
                                                    ?>
                                                        <td class="<?=$color;?> day" id="<?=$day;?>"><?=$daysInMonth[$index];?></td>
                                                    <?php
                                                    $index++;

                                                    
                                                }

                                                
                                            
                                            ?>
                                        </tr>

                                        <?php } ?>

                                    </tbody>
                                </table>
                                </form>

                                </div>
                        
                        </div> 
                    </form>                    
               
            </section>                
        </div>
    </div>
</main>