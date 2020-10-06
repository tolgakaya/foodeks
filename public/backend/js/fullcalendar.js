$(function () {

    // let mydates = [];
    // $.ajax({
    //     headers: {
    //         'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    //     },
    //     url: '/admin/bookings/cali',
    //     type: 'get',
    //     dataType: 'json',
    //     success: function (data) {

    //         mydates.push(data);
    //     },
    //     complete: function () {
    //         console.log(mydates);
    //     }
    // });

    "use strict";
    $('#calendar1').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        defaultDate: '2020-10-01',
        navLinks: true, // can click day/week names to navigate views
        selectable: true,
        selectHelper: true,
        select: function (start, end) {
            var title = prompt('Event Title:');
            var eventData;
            if (title) {
                eventData = {
                    title: title,
                    start: start,
                    end: end
                };
                $('#calendar1').fullCalendar('renderEvent', eventData, true); // stick? = true
            }
            $('#calendar1').fullCalendar('unselect');
        },
        // dayClick: function () {
        //     alert('a day has been clicked!');
        // },
        editable: true,
        eventLimit: true, // allow "more" link when too many events
        events: {
            url: 'http://foodeks/admin/bookings/cali/',
            type: 'GET',
            data: {
                custom_param1: 'something',
                custom_param2: 'somethingelse'
            },
            error: function (ex) {
                // alert(ex.message);
                console.log(ex.responseText);
            },
            color: 'yellow',   // a non-ajax option
            textColor: 'black' // a non-ajax option
        }

        // events: [{
        // 	title: 'All Day Event',
        // 	start: '2018-11-01'
        // }, {
        // 	title: 'Long Event',
        // 	start: '2018-11-07',
        // 	end: '2018-11-10'
        // }, {
        // 	id: 999,
        // 	title: 'Repeating Event',
        // 	start: '2018-11-09T16:00:00'
        // }, {
        // 	id: 999,
        // 	title: 'Repeating Event',
        // 	start: '2018-11-16T16:00:00'
        // }, {
        // 	title: 'Conference',
        // 	start: '2018-11-11',
        // 	end: '2018-11-13'
        // }, {
        // 	title: 'Meeting',
        // 	start: '2018-11-12T10:30:00',
        // 	end: '2018-11-12T12:30:00'
        // }, {
        // 	title: 'Lunch',
        // 	start: '2018-11-12T12:00:00'
        // }, {
        // 	title: 'Meeting',
        // 	start: '2018-11-12T14:30:00'
        // }, {
        // 	title: 'Happy Hour',
        // 	start: '2018-11-12T17:30:00'
        // }, {
        // 	title: 'Dinner',
        // 	start: '2018-11-12T20:00:00'
        // }, {
        // 	title: 'Birthday Party',
        // 	start: '2018-11-13T07:00:00'
        // }, {
        // 	title: 'Click for Google',
        // 	url: 'http://google.com/',
        // 	start: '2018-11-28'
        // }]
    });

    $('#external-events .fc-event').each(function () {
        // store data so the calendar knows to render an event upon drop
        $(this).data('event', {
            title: $.trim($(this).text()), // use the element's text as the event title
            stick: true // maintain when user navigates (see docs on the renderEvent method)
        });
        // make the event draggable using jQuery UI
        $(this).draggable({
            zIndex: 999,
            revert: true, // will cause the event to go back to its
            revertDuration: 0 //  original position after the drag
        });
    });

});