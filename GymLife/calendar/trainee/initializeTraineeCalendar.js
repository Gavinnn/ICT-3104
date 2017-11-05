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
            element.bind('click', function() {

                // if event is individual training, show individual training modal
                if (event.color == "#008000" || event.color == "#FF0000"){
                    $('#ModalIndivConfirm #sessionID').val(event.id);	// pump the id into the Confirm Training modal
                    $('#ModalIndivConfirm #title').val(event.title);	// pump the title into the Confirm Training modal
                    $('#ModalIndivConfirm #trainerName').val(event.trainerName);	// pump the trainerName into the Confirm Training modal
                    $('#ModalIndivConfirm #trainingType').val(event.trainingType);	// pump the trainingName into the Confirm Training modal
                    $('#ModalIndivConfirm #cost').val(event.cost);	// pump the cost into the Confirm Training modal
                    $('#ModalIndivConfirm #startTime').val(event.start._i);	// pump the start time into the Confirm Training modal
                    $('#ModalIndivConfirm #endTime').val(event.end._i);	// pump the end time into the Confir
                    $('#ModalIndivConfirm #gym').val(event.locationName);	// pump the locationName into the Confirm Training modal
                    $('#ModalIndivConfirm #room').val(event.room);	// pump the roomName into the Confirm Training modal
                    $('#ModalIndivConfirm #trainingDesc').val(event.description);	// pump the description into the Confirm Training modal
                    $('#ModalIndivConfirm #confirmedTraineeID').val(event.traineeID);	// pump the confirmed traineeID into the Confirm Training modal, if any
                    $('#ModalIndivConfirm').modal('show'); // inflate the modal
                }

                // if event is group training, show group training modal
                else if (event.color == "#0000B2" || event.color == "#FF0001"){
                    $('#ModalGroupConfirm #sessionID').val(event.id);	// pump the id into the Confirm Training modal
                    $('#ModalGroupConfirm #title').val(event.title);	// pump the title into the Confirm Training modal
                    $('#ModalGroupConfirm #trainerName').val(event.trainerName);	// pump the trainerName into the Confirm Training modal
                    $('#ModalGroupConfirm #trainingType').val(event.trainingType);	// pump the trainingName into the Confirm Training modal
                    $('#ModalGroupConfirm #cost').val(event.cost);	// pump the cost into the Confirm Training modal
                    $('#ModalGroupConfirm #startTime').val(event.start._i);	// pump the start time into the Confirm Training modal
                    $('#ModalGroupConfirm #endTime').val(event.end._i);	// pump the end time into the Confir
                    $('#ModalGroupConfirm #room').val(event.room);	// pump the roomName into the Confirm Training modal
                    $('#ModalGroupConfirm #numberOfParticipants').val(event.numberOfParticipants);	// pump the roomName into the Confirm Training modal
                    $('#ModalGroupConfirm #maxCapacity').val(event.maxCapacity);	// pump the roomName into the Confirm Training modal
                    $('#ModalGroupConfirm').modal('show'); // inflate the modal
                }
            });
        },

        // display the trainings on the calendar by transforming the data from the database
        events: 

            trainingSessions.map(function(oneTraining) {

                // if individual training...
                if (oneTraining.hasOwnProperty('sessionID')){
                    return {
                        id: oneTraining.sessionID,
                        title: oneTraining.title,
                        trainerName: oneTraining.name,
                        trainingType: oneTraining.trainingType,
                        cost: oneTraining.cost,
                        start: oneTraining.startSession,
                        end: oneTraining.endSession,
                        locationName: oneTraining.locationName,
                        room: oneTraining.roomName,
                        description: oneTraining.description,
                        color:oneTraining.color,
                        traineeID: oneTraining.traineeID
                        }
                }

                // if group training...
                else if (oneTraining.hasOwnProperty('groupSessionID')){
                    
                    return {
                        id: oneTraining.groupSessionID,
                        title: oneTraining.title,
                        trainerName: oneTraining.trainerName,
                        trainingType: oneTraining.trainingType,
                        cost: oneTraining.cost,
                        room: oneTraining.roomName,
                        numberOfParticipants: oneTraining.numberOfParticipants,
                        start: oneTraining.startSession,
                        end: oneTraining.endSession,
                        maxCapacity: oneTraining.maxCapacity,
                        color:oneTraining.color
                    }
                }
            })
    });
}
