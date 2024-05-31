$(document).ready(function() {

    const attendance = timesheets.map(timesheet => {
        const startTime = moment(timesheet.time_in).format('YYYY-MM-DD'); // Assuming appointment_time is a separate field
        const formattedTime = moment(startTime).format('h:mm A');
        return {
            title: 'Present',
            start: timesheet.time_in,
            end: timesheet.time_out,
            description: formattedTime
        };
    });

    

    $('#timesheet-canvas').fullCalendar({
        events: attendance,
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        editable: false,
        eventLimit: true,
        eventRender: function(event, element) {
            element.find('.fc-title').html(
                `<div class="event-details">
                    <div><h6>${event.title}</h6></div>
                    ${event.status}<br>
                    ${event.description}<br>
                    ${event.patient}
                 </div>`
            );
            if (event.status === 'Approved') {
                element.find('.event-details').addClass('completed-note');
            }
            else {
                element.find('.event-details').addClass('pending-note');
            }
        },
        // eventAfterAllRender: function(view) {
        //     // Modify the "more" links
        //     $('.fc-more').each(function() {
        //         const numberOfAppointments = $(this).text().match(/\d+/)[0];
        //         $(this).html(`+${numberOfAppointments} appointments more`);
        //     });
        // }
    });
});