<!-- partie centrale avec logo Sisco -->
    <div class="modal fade" id="exampleModalLive" tabindex="-1" aria-labelledby="exampleModalLiveLabel" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border border-light">
            <div class="modal-header bg-danger">
                <h4 class="modal-title text-white" id="exampleModalLiveLabel">Important !</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bg-secondary">
                <p class="text-white fs-5 text-center"><?=$alert->description;?></p>
            </div>
            <div class="modal-footer bg-secondary">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fermer</button>
            </div>
            </div>
        </div>
    </div>

    <div class="container-fluid p-0 h-100">
        <div class="d-flex h-100 align-items-center">
            <div class="d-flex align-items-center justify-content-center middleCenter w-100 h-50"> 
                <img src="/assets/img/logo_sisco.jpg" class="col-10 col-sm-7 col-md-6 col-lg-5 col-xl-4">
            </div>
        </div>
    </div> 

</header>

<?php
    if ($messageAlert){
?>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            var myModal = new bootstrap.Modal(document.getElementById('exampleModalLive'), {
            keyboard: false
            })
            myModal.show();
        })

    </script>

<?php } ?>