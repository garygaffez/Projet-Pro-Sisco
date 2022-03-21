// // Carrousel header
var myCarousel = document.querySelector('#carouselSiscoMobile', '#carouselSiscoSm', '#carouselSiscoMd')
var carousel = new bootstrap.Carousel(myCarousel, {
    interval: 5000,
    wrap: true,
    touch: true
})

var myCarouselXl = document.getElementById('carouselSiscoXl',)
var carouselXl = new bootstrap.Carousel(myCarouselXl, {
    interval: 6000,
    wrap: true,
    touch: true
})

var myCarouselLg = document.getElementById('carouselSiscoLg',)
var carouselLg = new bootstrap.Carousel(myCarouselLg, {
    interval: 6000,
    wrap: true,
    touch: true
})













//boite de confirmation de suppression
// $(document).ready(function(){
//     let del = $('a.delete');
    

//     $(del).each(function(){
//         $(this).on('click', function(e){
//             e.preventDefault();
//             alert('You clicked the button!');
//             Swal.fire({
//                 title: 'Confirmez vous la suppression ?',
//                 text: 'Cette action est irreversible !',
//                 type: 'warning',
//                 showCancelButton: true,
//                 confirmButtonText: 'Oui',
//                 cancelButtonText: 'non',
//             });
//         });
//     });
// })

// const btnSuppression = document.querySelector('.btn-suppression');

// btnSuppression.addEventListener('click', () => {
//     alert ('etes vous sur ?');
// })
