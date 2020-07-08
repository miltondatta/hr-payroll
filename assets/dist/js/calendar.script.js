(function ($) {
    "use strict";


    /****************************** App Calendar ****************************/
// Sidebar calendar
    $('#calendar-month').datepicker({
        showOtherMonths: true,
        selectOtherMonths: true,
        beforeShowDay: function (date) {

            // add leading zero to single digit date
            var day = date.getDate();
            console.log(day);
            return [true, (day < 10 ? 'zero' : '')];
        },
        dateFormat: 'yy-mm-dd'
    });

    $('#calendar-month-two').datepicker({
        showOtherMonths: true,
        selectOtherMonths: true,
        beforeShowDay: function (date) {

            // add leading zero to single digit date
            var day = date.getDate();
            console.log(day);
            return [true, (day < 10 ? 'zero' : '')];
        },
        dateFormat: 'yy-mm-dd'
    });

    $('#calendar-month-three').datepicker({
        showOtherMonths: true,
        selectOtherMonths: true,
        beforeShowDay: function (date) {

            // add leading zero to single digit date
            var day = date.getDate();
            console.log(day);
            return [true, (day < 10 ? 'zero' : '')];
        },
        dateFormat: 'yy-mm-dd'
    });

    $('#calendar-month-four').datepicker({
        showOtherMonths: true,
        selectOtherMonths: true,
        beforeShowDay: function (date) {

            // add leading zero to single digit date
            var day = date.getDate();
            console.log(day);
            return [true, (day < 10 ? 'zero' : '')];
        },
        dateFormat: 'yy-mm-dd'
    });

    $('#calendar-month-five').datepicker({
        showOtherMonths: true,
        selectOtherMonths: true,
        beforeShowDay: function (date) {

            // add leading zero to single digit date
            var day = date.getDate();
            console.log(day);
            return [true, (day < 10 ? 'zero' : '')];
        },
        dateFormat: 'yy-mm-dd'
    });

    $('#calendar-month-six').datepicker({
        showOtherMonths: true,
        selectOtherMonths: true,
        beforeShowDay: function (date) {

            // add leading zero to single digit date
            var day = date.getDate();
            console.log(day);
            return [true, (day < 10 ? 'zero' : '')];
        },
        dateFormat: 'yy-mm-dd'
    });

    $('#calendar-month-seven').datepicker({
        showOtherMonths: true,
        selectOtherMonths: true,
        beforeShowDay: function (date) {

            // add leading zero to single digit date
            var day = date.getDate();
            console.log(day);
            return [true, (day < 10 ? 'zero' : '')];
        },
        dateFormat: 'yy-mm-dd'
    });

    $('#calendar-month-only').datepicker({
        showOtherMonths: true,
        selectOtherMonths: true,
        dateFormat: 'yy-mm'
    });

    function getRndInteger(min, max) {
        return Math.floor(Math.random() * (max - min + 1) ) + min;
    }

    let base = $("#base").val();
    let events_array = [];
    $.ajax({
        url: base + 'PlannedLeave/getPlannedLeaveByEmployeeId',
        method: 'GET',
        data: {}
    }).done(function (response) {
        let result = JSON.parse(response);
        $.each(result.planned_leave, function (index, item) {
            let random_number = getRndInteger(100000,999999);
            events_array.push(
                {
                    title: item.leave_type_name,
                    start: item.leave_from,
                    end: moment(item.leave_to).add(1, 'days').format('YYYY-MM-DD'),
                    color: '#'+random_number,
                    description: item.remarks
                }
            );
        });

        let calendarEl = document.getElementById('calendar');
        if (calendarEl) {
            var calendar = new FullCalendar.Calendar(calendarEl, {
                plugins: ['interaction', 'dayGrid', 'timeGrid', 'list'],
                height: 'parent',
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                },
                defaultView: 'dayGridMonth',
                defaultDate: new Date(),
                navLinks: true, // can click day/week names to navigate views
                editable: true,
                eventLimit: true, // allow "more" link when too many events
                eventRender: function (info) {
                    $(info.el).tooltip({
                        title: info.event.title
                    });
                },
                events: events_array
            });
            calendar.render();
        }
    });
})(jQuery);
