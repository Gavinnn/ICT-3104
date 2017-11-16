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
                    $('#ModalIndivConfirm #sessionID').val(event.id);	// sessionID
                    $('#ModalIndivConfirm #title').val(event.title);	// training title
                    $('#ModalIndivConfirm #trainerName').val(event.trainerName);	// trainer name
                    $('#ModalIndivConfirm #trainingType').val(event.trainingType);	// training category
                    $('#ModalIndivConfirm #cost').val(event.cost);	// cost of training
                    $('#ModalIndivConfirm #startTime').val(event.start._i);	// start datetime
                    $('#ModalIndivConfirm #endTime').val(event.end._i);	// end datetime
                    $('#ModalIndivConfirm #gym').val(event.locationName);	// locationName i.e. gym
                    $('#ModalIndivConfirm #room').val(event.room);	// room name
                    $('#ModalIndivConfirm #trainingDesc').val(event.description);	// training description
                    $('#ModalIndivConfirm #confirmedTraineeID').val(event.traineeID);	// traineeID if training is already booked. Else, null
                    $('#ModalIndivConfirm').modal('show'); // inflate the modal
                }

                // if event is group training, show group training modal
                else if (event.color == "#0000B2" || event.color == "#FF0001"){
                    $('#ModalGroupConfirm #groupSessionID').val(event.id);	// sessionID
                    $('#ModalGroupConfirm #title').val(event.title);	// training title
                    $('#ModalGroupConfirm #trainerName').val(event.trainerName);	// trainer name
                    $('#ModalGroupConfirm #trainingType').val(event.trainingType);	// training category
                    $('#ModalGroupConfirm #cost').val(event.cost);	// cost of training
                    $('#ModalGroupConfirm #startTime').val(event.start._i);	// start datetime
                    $('#ModalGroupConfirm #endTime').val(event.end._i);	// end datetime
                    $('#ModalGroupConfirm #room').val(event.room);	// room name
                    $('#ModalGroupConfirm #gym').val(event.locationName);	// locationName i.e. gym
                    $('#ModalGroupConfirm #numberOfParticipants').val(event.numberOfParticipants);	// current number of participants in group training
                    $('#ModalGroupConfirm #maxCapacity').val(event.maxCapacity);	// max capacity of group training
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
                        locationName: oneTraining.locationName,
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
