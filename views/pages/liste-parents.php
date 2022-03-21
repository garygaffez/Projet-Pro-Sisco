<main class="backImageForm">

    <div class="row justify-content-center backOrange">
        <div class="col-12 title order-2 order-md-1">
            <h1 class="mt-5 pt-5 ps-3 mb-1 ms-2">Admin</h1>
        </div>

        <section class="col-12 col-md-8 col-xl-6 mt-5 order-3 order-md-2 backWhite rounded-3 p-3 mb-5">
            <div class="col-12 title order-2 order-md-1 text-center">
                <h2 class="mt-2 ps-3 mb-1 ms-2">Liste des utilisateurs</h2>
            </div>

            <div class="row justify-content-center">
                <div class="col-12 col-sm-10 d-flex justify-content-between">
                    <form action="<?=htmlspecialchars($_SERVER['PHP_SELF'])?>" method="GET" class="mt-3" id="form">
                        <!-- <p class="has-text-link has-text-weight-bold mb-1">Je recherche un enfant :</p> -->
                        <input type="search" class="" name="search" id="search" placeholder="rechercher"
                            pattern="<?=REG_STR_NO_NUMBER?>" value="<?=$search ?? ''?>">
                        <!-- <button type="submit" class="btn btn-secondary btn-sm">Rechercher</button> -->

                        <div class="text-center">
                            <?=$errorSearch['errorsearch'] ?? '';?>
                        </div>
                    </form>

                    <form method="GET" class="mt-3">
                        <!-- <p class="">Nombre de résultats par page</p> -->
                        <div class="d-flex justify-content-center">
                            <select name="selectPatientNumber" class="form-select me-2">
                                <option value="5" <?=($selectPatientNumber === 5) ? 'selected' : '';?>>5</option>
                                <option value="10" <?=($selectPatientNumber === 10) ? 'selected' : '';?>>10</option>
                                <option value="15" <?=($selectPatientNumber === 15) ? 'selected' : '';?>>15</option>
                                <option value="20" <?=($selectPatientNumber === 20) ? 'selected' : '';?>>20</option>
                            </select>

                            <button type="submit" class="btn btn-secondary btn-sm">Filtrer</button>
                        </div>
                    </form>

                </div>
            </div>


            <!-- <nav aria-label="pagination">

                <ul class="pagination d-flex justify-content-center mt-3">

                    <li class="page-item ">
                        <?php
                        if ($page > 1) {?>
                        <a href="?page=<?php echo $page - 1;?>&selectPatientNumber=<?=$selectPatientNumber;?>&search=<?=$search;?>"
                            class="page-link">Page précédente</a>
                        <?php
                        }
                        ?>
                    </li>

                    <li class="page-item">
                        <?php
                            for ($i = $page - 2; $i <= $page - 1; $i++) {                    
                                if ($i > 0 && $i < $nbPages) {?>
                        <a href="?page=<?php echo $i;?>&selectPatientNumber=<?=$selectPatientNumber;?>&search=<?=$search;?>"
                            class="page-link"><?php echo $i;?></a>
                        <?php
                                }
                            }
                        ?>
                    </li>

                    <li class="page-item active">
                        <a href="?page=<?php echo $page;?>&selectPatientNumber=<?=$selectPatientNumber;?>&search=<?=$search;?>"
                            class="page-link"><?php echo $page;?></a>
                    </li>

                    <li class="page-item">
                        <?php
                            for ($i = $page + 1; $i <= $page + 2; $i++) {
                                if ($i <= $nbPages) {?>
                        <a href="?page=<?php echo $i;?>&selectPatientNumber=<?=$selectPatientNumber;?>&search=<?=$search;?>"
                            class="page-link"><?php echo $i;?></a>
                        <?php
                                }
                            }
                        ?>
                    </li>

                    <li class="page-item">
                        <?php
                        if ($page < $nbPages) {?>
                        <a href="?page=<?php echo $page + 1;?>&selectPatientNumber=<?=$selectPatientNumber;?>&search=<?=$search;?>"
                            class="page-link">Page suivante</a>
                        <?php
                        }
                        ?>
                    </li>

                </ul>

            </nav> -->



            <nav aria-label="pagination">

                <ul class="pagination d-flex justify-content-center mt-3">

                <li class="page-item ">
                    <?php
                    if ($page > 1) {?>
                    <a href="?page=<?php echo $page - 1;?>&selectPatientNumber=<?=$selectPatientNumber;?>&search=<?=$search;?>"
                        class="page-link">Page précédente</a>
                    <?php
                    }
                    ?>
                </li>

                <li class="page-item">
                    <?php
                        for ($i = $page - 2; $i <= $page - 1; $i++) {                    
                            if ($i > 0 && $i < $nbPages) {?>
                    <a href="?page=<?php echo $i;?>&selectPatientNumber=<?=$selectPatientNumber;?>&search=<?=$search;?>"
                        class="page-link"><?php echo $i;?></a>
                    <?php
                            }
                        }
                    ?>
                </li>

                <li class="page-item active">
                    <a href="?page=<?php echo $page;?>&selectPatientNumber=<?=$selectPatientNumber;?>&search=<?=$search;?>"
                        class="page-link"><?php echo $page;?></a>
                </li>

                <li class="page-item">
                    <?php
                        for ($i = $page + 1; $i <= $page + 2; $i++) {
                            if ($i <= $nbPages) {?>
                    <a href="?page=<?php echo $i;?>&selectPatientNumber=<?=$selectPatientNumber;?>&search=<?=$search;?>"
                        class="page-link"><?php echo $i;?></a>
                    <?php
                            }
                        }
                    ?>
                </li>

                <li class="page-item">
                    <?php
                    if ($page < $nbPages) {?>
                    <a href="?page=<?php echo $page + 1;?>&selectPatientNumber=<?=$selectPatientNumber;?>&search=<?=$search;?>"
                        class="page-link">Page suivante</a>
                    <?php
                    }
                    ?>
                </li>

                </ul>

            </nav>


            <div class="table-responsive">
                <table class="table">
                    <?php
                    // var_dump($parents);
                        if ($parents instanceof PDOException) {?>

                            <p class=""><?=$parents->getMessage();?></p>
                        <?php                
                    }else { ?>
                    <thead>
                        <tr>

                            <th scope="col">Nom</th>
                            <th scope="col">Prénom</th>
                            <th scope="col">mail</th>
                            <th scope="col">Téléphone</th>

                        </tr>
                    </thead>

                    <tbody id="userslist">

                    </tbody>
                    
                    <?php
                    }
                    ?>
                </table>
            </div>

        </section>
    </div>

</main>