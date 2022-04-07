//calendrier
// let selectMonth = document.getElementById('month');
// let selectYear = document.getElementById('year');
// let formCalendar = document.getElementById('formCalendar');

// selectYear.onchange = () => {
//     formCalendar.submit();
// }
// // console.log(formCalendar);
// selectMonth.onchange = () => {
//     formCalendar.submit();
// }



// function formatDate(date) {
//     var myDate = date;
//     myDate = myDate.split("-");
//     console.log(myDate);dateToTimeStamp
//     var newDate = new Date( myDate[0], myDate[1] - 1, myDate[2]);
//     return newDate.getTime();
    
// }

let days = document.querySelectorAll('.day');
// let ts = Date.now();
// console.log(ts, 'js');
let canteenDays = [];

var date = new Date();

function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) 
        month = '0' + month;
    if (day.length < 2) 
        day = '0' + day;

    return [year, month, day].join('-');
}
console.log(formatDate(date));

// let todayDate = formatDate(date);
// let todayDateTimeStamp = new Date();
// console.log(todayDate);



// days.forEach((day) =>{
//     day.addEventListener('click', (e) =>{
        
//         e.currentTarget.style.backgroundColor = 'green'; 
//         // canteenDays.push(e.currentTarget.id);
//         // doublons = Array.from(new Set(canteenDays));
//         // console.log(doublons);
//         // let dateSelected = new Date(e.currentTarget.id);

//         console.log(formatDate(e.currentTarget.id));
//         if (e.currentTarget.id > '2022-7-15'){
//             e.currentTarget.style.backgroundColor = 'green';
//             console.error('ok');
//         }else{
//             e.currentTarget.style.backgroundColor = 'orange';
//             console.error('pas bon');
//         }
//     })

// })


// let days = document.querySelectorAll('.day');
    const queryString = window.location.search;
    const urlParams = new URLSearchParams (queryString);
    let id = urlParams.get('id');
    console.log();


fetch(`/controllers/cantine-controller-ajax.php?id=${id}`,{
    headers : {
        'Content-Type' : 'application/json',
    },
    method : 'GET',
}).then((response) => {
    return response.json();
}).then((data) => {
    console.log(data);
    // on boucles sur les jours du mois
    days.forEach((item) => {
    

        data.map((test) => {
            if (formatDate(test.date) == formatDate(item.id)) {
                console.log(test);
                item.style.backgroundColor = "green";
                item.classList ='disabled'
            }
        })

        item.addEventListener('click', (e) => {
            let d1 = Date.parse(e.target.id);
            let d2 = Date.parse(formatDate(date));

            if (d1 > d2) {
                e.target.classList.toggle("greenCanteen");
            }else {
                e.target.classList.toggle("redCanteen");
            }
            
        })
    })
})