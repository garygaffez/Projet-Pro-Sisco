// // Carrousel header
// var myCarousel = document.querySelector('#carouselSiscoMobile', '#carouselSiscoSm', '#carouselSiscoMd')
// var carousel = new bootstrap.Carousel(myCarousel, {
//     interval: 5000,
//     wrap: true,
//     touch: true
// })

// var myCarouselXl = document.getElementById('carouselSiscoXl',)
// var carouselXl = new bootstrap.Carousel(myCarouselXl, {
//     interval: 6000,
//     wrap: true,
//     touch: true
// })

// var myCarouselLg = document.getElementById('carouselSiscoLg',)
// var carouselLg = new bootstrap.Carousel(myCarouselLg, {
//     interval: 6000,
//     wrap: true,
//     touch: true
// })

//Envoi formulaire SI les champs mot de passe sont les mêmes
document.getElementById("suscribe").addEventListener("submit", function(e) {
    e.preventDefault();
    let mdp = document.getElementById('password');
    let confirMdp = document.getElementById('confirmPassword')

    if (mdp.value != confirMdp.value) {
        errorPassword2.innerHTML = "Le mot de passe ne correspond pas !"
    } else {
        suscribe.submit()
    }
})


// validation formulaire avec icone de verification
const inputName = document.getElementById('Name');
const allSpan = document.querySelectorAll('span');
const allIcone = document.querySelectorAll('.icone-verif');

inputName.addEventListener('input', (e) => {

    const regName = /^[a-zÀ-ÿA-Z '-]+$/;

    if (e.target.value.search(regName) === 0) {
        allIcone[0].style.display = "inline";
        allIcone[0].src = "/assets/img/check.svg";
        allSpan[0].style.display = "none";
    }else if (e.target.value.search(regName) === -1) {
        allIcone[0].style.display = "inline";
        allIcone[0].src = "/assets/img/error.svg";
        allSpan[0].style.display = "inline";
    }

})

