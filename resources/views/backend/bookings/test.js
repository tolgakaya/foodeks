$(document).ready(function () {
    // page is now ready, initialize the calendar...
    $('#calendar').fullCalendar({
        // put your options and callbacks here
        defaultView: 'agendaDay',
        eventBorderColor: "#de1f1f",

        header:
        {
            left: 'prev,next,today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },

        editable: true,
        selectable: true,

        //When u select some space in the calendar do the following:
        select: function (start, end, allDay) {
            //do something when space selected
            //Show 'add event' modal
            $('#createEventModal').modal('show');
        },

        //When u drop an event in the calendar do the following:
        eventDrop: function (event, delta, revertFunc) {
            //do something when event is dropped at a new location
        },

        //When u resize an event in the calendar do the following:
        eventResize: function (event, delta, revertFunc) {
            //do something when event is resized
        },

        eventRender: function (event, element) {
            $(element).tooltip({ title: event.title });
        },

        //Activating modal for 'when an event is clicked'
        eventClick: function (event) {
            $('#modalTitle').html(event.title);
            $('#modalBody').html(event.description);
            $('#fullCalModal').modal();
        },
    })

    $('#submitButton').on('click', function (e) {
        // We don't want this to act as a link so cancel the link action
        e.preventDefault();

        doSubmit();
    });

    function doSubmit() {
        $("#createEventModal").modal('hide');
        $("#calendar").fullCalendar('renderEvent',
            {
                title: $('#eventName').val(),
                start: new Date($('#eventDueDate').val()),

            },
            true);
    }
});


});