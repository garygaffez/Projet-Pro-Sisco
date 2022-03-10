<!-- Menu de navigation -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-light fondBlue">       
        <!-- <a class="navbar-brand" href="#">Navbar</a> -->
            <button class="navbar-toggler p-0 ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">

                <ul class="navbar-nav ms-3">
                    <li class="nav-item">
                    <a class="nav-link active text-dark fs-5" aria-current="page" href="/controllers/news-controller.php">Actualités</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link text-dark fs-5" href="#">Le RPI</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link text-dark fs-5" href="#">Les écoles</a> 
                    </li>
                    <li class="nav-item">
                    <a class="nav-link text-dark fs-5" href="#">Documents</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link text-dark fs-5" href="/controllers/contact-controller.php">Contact</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link text-dark fs-5" href="/controllers/connexion-controller.php">Mon espace</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link text-dark fs-5" href="/controllers/liste-parents-controller.php">Admin</a>
                    </li>
                </ul>
            
            <?php if(isset($_SESSION['firstname'])) :?>
                <ul class="navbar-nav ms-md-auto me-3ms-3">
                    <li class="nav-item">
                        <div class="col d-flex justify-content-end align-items-center me-5">
                            <img src="/assets/img/connect.png" class="connect me-2" alt="">
                            <p class="fs-5 mb-0 pt-2 text-decoration-none text-capitalize">Bonjour <?=$_SESSION['firstname'];?> !</p>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-danger fs-5 me-3" href="/controllers/logout-user-controller.php">Deconnexion</a>
                    </li>
                </ul>
            <?php endif;?>
        </div>
    </nav>
