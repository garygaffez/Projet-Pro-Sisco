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



        </section>
    </div>

</main>