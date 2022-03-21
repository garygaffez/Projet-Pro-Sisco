// validation formulaire avec icone de verification
const inputlastname = document.getElementById('lastname');
const inputfirstName = document.getElementById('firstname');
const inputEmail = document.getElementById('email');
const inputPhone = document.getElementById('phoneNumber');
const inputMdp = document.getElementById('password');
const inputConfirm = document.getElementById('confirmPassword');
const allSpan = document.querySelectorAll('span');
const allIcone = document.querySelectorAll('.icone-verif');
const allLigne = document.querySelectorAll('.ligne div');

inputlastname?.addEventListener('input', (e) => {

    const reglastname = /^[a-zÀ-ÿA-Z '-]{2,30}$/;

    if (e.target.value.search(reglastname) === 0 && e.target.value.length >= 2) {
            allIcone[0].style.display = "inline";
            allIcone[0].src = "/assets/img/check.svg";
            allSpan[1].style.display = "none";
        }         
    if (e.target.value.search(reglastname) === -1 || e.target.value.length > 30 || e.target.value.length < 2) {
        allIcone[0].style.display = "inline";
        allIcone[0].src = "/assets/img/error.svg";
        allSpan[1].style.display = "inline";
        }
})

inputfirstName?.addEventListener('input', (e) => {

    const regfirstName = /^[a-zÀ-ÿA-Z '-]{2,30}$/;

    if (e.target.value.search(regfirstName) === 0 && e.target.value.length >= 2) {
            allIcone[1].style.display = "inline";
            allIcone[1].src = "/assets/img/check.svg";
            allSpan[2].style.display = "none";
        }         
    if (e.target.value.search(regfirstName) === -1 || e.target.value.length > 30 || e.target.value.length < 2){
        allIcone[1].style.display = "inline";
        allIcone[1].src = "/assets/img/error.svg";
        allSpan[2].style.display = "inline";
        }

})

inputEmail?.addEventListener('input', (e) => {

    const regEmail = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/;

    if (e.target.value.search(regEmail) === 0) {
        allIcone[2].style.display = "inline";
        allIcone[2].src = "/assets/img/check.svg";
        allSpan[3].style.display = "none";
    }else if (e.target.value.search(regEmail) === -1) {
        allIcone[2].style.display = "inline";
        allIcone[2].src = "/assets/img/error.svg";
        allSpan[3].style.display = "inline";
    }
})

inputPhone?.addEventListener('input', (e) => {

    const regPhone = /^[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}$/;

    if (e.target.value.search(regPhone) === 0) {
        allIcone[3].style.display = "inline";
        allIcone[3].src = "/assets/img/check.svg";
        allSpan[4].style.display = "none";
    }else if (e.target.value.search(regPhone) === -1) {
        allIcone[3].style.display = "inline";
        allIcone[3].src = "/assets/img/error.svg";
        allSpan[4].style.display = "inline";
    }
})

// Envoi formulaire SI les champs mot de passe sont les mêmes
document.getElementById("suscribe")?.addEventListener("submit", function(e) {
    e.preventDefault();
    let mdp = document.getElementById('password');
    let confirMdp = document.getElementById('confirmPassword')

    if (mdp.value != confirMdp.value) {
        errorPassword2.innerHTML = "Les mots de passe ne correspond pas, veuillez recommencer !"
    } else {
        suscribe.submit()
    }
})

// validation création mot de passe
let valeurInput;
const specialChar = /[^a-zA-Z0-9]/;
const alphabet = /[a-z]/i;
const numbers = /[0-9]/;

let objValidation = {
    symbole : 0,
    letter : 0,
    number : 0
}

inputMdp?.addEventListener('input', (e) => {
    valeurInput = e.target.value;

    if(valeurInput.search(specialChar) !== -1) {
        objValidation.symbole = 1;
    }
    if(valeurInput.search(alphabet) !== -1) {
        objValidation.letter = 1;
    }
    if(valeurInput.search(numbers) !== -1) {
        objValidation.number = 1;
    }
    

    if(e.inputType = 'deleteContentBackward') {
        if(valeurInput.search(specialChar) === -1) {
            objValidation.symbole = 0;
        }
        if(valeurInput.search(alphabet) === -1) {
            objValidation.letter = 0;
        }
        if(valeurInput.search(numbers) === -1) {
            objValidation.number = 0;
        }
    }

    let testAll = 0;
    for(const property in objValidation){
        if(objValidation[property] > 0){
            testAll++;
        }
    }
    if (testAll < 3){
        allSpan[5].style.display = "inline";
        allIcone[4].style.display = "inline";
        allIcone[4].src = "/assets/img/error.svg";
    }else{
        allSpan[5].style.display = "none";
        allIcone[4].src = "/assets/img/check.svg";
    }


    //force mdp
    if(valeurInput.length <= 6 && valeurInput.length > 0){
        allLigne[0].style.display = 'block';
        allLigne[1].style.display = 'none';
        allLigne[2].style.display = 'none';
    }
    else if(valeurInput.length > 6 && valeurInput.length <= 10){
        allLigne[0].style.display = 'block';
        allLigne[1].style.display = 'block';
        allLigne[2].style.display = 'none';
    }
    else if(valeurInput.length > 10){
        allLigne[0].style.display = 'block';
        allLigne[1].style.display = 'block';
        allLigne[2].style.display = 'block';
    }
    else if(valeurInput.length === 0){
        allLigne[0].style.display = 'none';
        allLigne[1].style.display = 'none';
        allLigne[2].style.display = 'none';
    }
    // console.log(objValidation);
})

//confirmation mdp

inputConfirm?.addEventListener('input', (e) => {

    if(e.target.value.length === 0){
        allIcone[5].style.display = "inline";
        allIcone[5].src = "/assets/img/error.svg";
    }
    else if(e.target.value === valeurInput) {
        allIcone[5].style.display = "inline";
        allIcone[5].src = "/assets/img/check.svg";
    }else{
        allIcone[5].style.display = "inline";
        allIcone[5].src = "/assets/img/error.svg";
    }
})