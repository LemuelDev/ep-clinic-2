import './bootstrap';


// import { Calendar } from '@fullcalendar/core';
// import dayGridPlugin from '@fullcalendar/daygrid';
// import interactionPlugin from '@fullcalendar/interaction'; 
// import timeGridPlugin from '@fullcalendar/timegrid';

// document.addEventListener('DOMContentLoaded', function() {
//     var calendarEl = document.getElementById('calendar');
    
//     var today = new Date();
//     var maxDate = new Date(today.getFullYear(), today.getMonth() + 2, today.getDate());

//     var calendar = new Calendar(calendarEl, {
//         plugins: [ dayGridPlugin, interactionPlugin, timeGridPlugin ],
//         initialView: 'dayGridMonth', 
//         headerToolbar: {
//             left: 'prev,next today',
//             center: 'title',
//             right: 'dayGridMonth,timeGridWeek,timeGridDay'
//         },
//         minTime: '08:00:00', // Minimum time (8 AM)
//         maxTime: '16:00:00', // Maximum time (4 PM)
//         validRange: {
//             start: today,
//             end: maxDate
//         },
//         datesSet: function(dateInfo) {
//             var currentDate = new Date();
//             if (dateInfo.start <= new Date(currentDate.getFullYear(), currentDate.getMonth(), 1)) {
//                 calendar.el.querySelector('.fc-prev-button').disabled = true;
//             } else {
//                 calendar.el.querySelector('.fc-prev-button').disabled = false;
//             }

//             if (dateInfo.end >= maxDate) {
//                 calendar.el.querySelector('.fc-next-button').disabled = true;
//             } else {
//                 calendar.el.querySelector('.fc-next-button').disabled = false;
//             }
//         },
//         events: [
//             {
//                 title: 'Appointment with Dr. Smith',
//                 start: '2024-09-24T10:00:00',
//                 end: '2024-09-24T11:00:00',
//                 description: 'Regular check-up'
//             },
//             {
//                 title: 'Dental Cleaning',
//                 start: '2024-09-24T14:00:00',
//                 end: '2024-09-24T17:00:00',
//                 description: 'Teeth cleaning'
//             }
//         ]
//     });

//     calendar.render();
// });
