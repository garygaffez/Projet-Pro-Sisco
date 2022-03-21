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


// let days = document.querySelectorAll('.day');
// let canteenDays = [];

// var date = new Date();
// const formatDate = (date)=>{
// let formatted_date = date.getDate() + "-" + (date.getMonth() + 1) + "-" + date.getFullYear()
// return formatted_date;
// }

// let todayDate = formatDate(date);
// // new Date().getDay();

// alert(todayDate);


// days.forEach((day) =>{
//     day.addEventListener('click', (e) =>{
        
//         e.currentTarget.style.backgroundColor = 'green'; 
//         // canteenDays.push(e.currentTarget.id);
//         // doublons = Array.from(new Set(canteenDays));
//         // console.log(doublons);

//         if (e.currentTarget.id !== todayDate){
//             e.currentTarget.style.backgroundColor = 'orange';
//             console.error('pas bon');
//         }
//     })

// })