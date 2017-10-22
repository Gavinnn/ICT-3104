function initializeTraineeCalendar(trainingSessions){
    
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
        selectable: false,	// user cannot create events
        editable: false,	// user cannot drag and drop events to a different date

        // double click event handler
        eventRender: function(event, element) {
            element.bind('dblclick', function() {
                $('#ModalConfirm #sessionID').val(event.id);	// pump the id into the Confirm Training modal
                $('#ModalConfirm #title').val(event.title);	// pump the title into the Confirm Training modal
                $('#ModalConfirm #trainerName').val(event.trainerName);	// pump the title into the Confirm Training modal
                $('#ModalConfirm #startTime').val(event.start._i);	// pump the start time into the Confirm Training modal
                $('#ModalConfirm #endTime').val(event.end._i);	// pump the end time into the Confirm Training modal
                $('#ModalConfirm #confirmedTraineeID').val(event.traineeID);	// pump the confirmed traineeID into the Confirm Training modal, if any
                $('#ModalConfirm').modal('show'); // inflate the modal
            });
        },

        // display the trainings on the calendar
        events: 

            trainingSessions.map(function(oneTraining) {
                return {
                    id: oneTraining.sessionID,
                    title: oneTraining.trainerName + " - \n" + oneTraining.title,
                    start: oneTraining.startSession,
                    end: oneTraining.endSession,
                    trainerName: oneTraining.trainerName,
                    color:oneTraining.color,
                    traineeID: oneTraining.traineeID
                    }
            })
    });
}
