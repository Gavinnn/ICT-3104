function initializeTrainerCalendar(trainingSessions){

    
    // initialize calendar
    $('#calendar').fullCalendar({
        // define buttons at the header
        header: {
            left: 'prev,next today',	// users cycle through previous and forward months + transit to current month
            center: 'title',	// title of the header (no action)
            right: 'month,basicDay'	// toggle between month view and current day view
        },
        defaultDate: new Date(),	// default date shown when calendar first loads
        eventLimit: true, // only show events that are constrained by the calendar day height
        selectable: true,	// user can create events
        editable: true,	// user can drag and drop events to a different date

        // to select a period of time (start and end time)
        select: function(start, end) {
            $('#ModalAdd #date').val(moment(start).format('YYYY-MM-DD'));
            $('#ModalAdd').modal('show');	// inflate the modal

            // initialize timepicker
            $('#ModalAdd #startTime').timepicker({
                disableTextInput: true,
                orientation: "bl",	
                timeFormat: "H:i",
                minTime: '10:00am',
                maxTime: '10:00pm',
            });

            // add one hour to the selected time
            $('#ModalAdd #startTime').on('changeTime', function() {
                    $('#ModalAdd #endTime').val(moment.utc($(this).val(),'hh:mm').add(1,'hour').format('H:mm'));
            });
        },

        // double click event handler
        eventRender: function(event, element) {
            element.bind('dblclick', function() {
                $('#ModalEdit #sessionID').val(event.id);	// pump the id into the Edit modal
                $('#ModalEdit #title').val(event.title);
                $('#ModalEdit #traineeName').val(event.traineeName === undefined? "None" : event.traineeName);// pump the title into the Edit modal
                $('#ModalEdit #date').val(event.start._i);	// pump the date into the Edit modal
                $('#ModalEdit').modal('show'); // inflate the modal
            });
        },

        // when training is dropped event handler
        eventDrop: function(event, delta, revertFunc) {
            edit(event);	// update changes to DB
        },

        // when training is resized event handler
        eventResize: function(event,dayDelta,minuteDelta,revertFunc) {
            edit(event);	// update changes to DB
        },

        // display the trainings on the calendar
        events: 

            trainingSessions.map(function(oneTraining) {
                
                return {
                    id: oneTraining.sessionID,
                    title: oneTraining.title,
                    start: oneTraining.startSession,
                    traineeName: oneTraining.traineeName,
                    color:oneTraining.color,
                    end: oneTraining.endSession
                        }
            })
    });
}


// AJAX call to save the training changes of dates to the DB
function edit(event){

    // format the start and end dates
    start = event.start.format('YYYY-MM-DD HH:mm:ss');
    if(event.end){
        end = event.end.format('YYYY-MM-DD HH:mm:ss');
    }else{
        end = start;	// when start and end dates are the same
    }

    // package the data to be sent to the DB for update
    id =  event.id;

    Event = [];
    Event[0] = id;
    Event[1] = start;
    Event[2] = end;

    // AJAX call to DB
    $.ajax({
    url: 'editTrainingDate.php',
    type: "POST",
    data: {Event:Event},
    success: function(res) {
            if(res == 'OK'){
                alert('Saved');
            }else{
                alert(res);
                alert('Could not be saved. try again.');
            }
        }
    });
}

