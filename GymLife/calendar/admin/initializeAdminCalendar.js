function initializeAdminCalendar(trainingSessions){

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
        editable: false,	// user cannot drag and drop events to a different date

        // double click event handler
        // bind the data from the event into the modal
        eventRender: function(event, element) {
            element.bind('click', function() {
				//check if date is earlier than current date
				var current = new Date();
				if(event.start<current.getTime())
				{
					//disable edit
					$('#ModalEditIndivTraining #title').prop('readonly', true);
					$('#ModalEditIndivTraining #description').prop('readonly', true);
					$('#ModalEditIndivTraining #save').hide();
					$('#ModalEditIndivTraining #dlt').hide();
				}
				else
				{
					//enable edit
					$('#ModalEditIndivTraining #title').prop('readonly', false);
					$('#ModalEditIndivTraining #description').prop('readonly', false);
					$('#ModalEditIndivTraining #save').show();
					$('#ModalEditIndivTraining #dlt').show();
				}
                // if event is individual training, show individual training modal
                if (event.color == "#008000" || event.color == "#FF0000"){
                    $('#ModalEditIndivTraining #sessionID').val(event.id);	
                    $('#ModalEditIndivTraining #title').val(event.title);
                    $('#ModalEditIndivTraining #trainerName').val(event.trainerName);
                    $('#ModalEditIndivTraining #traineeName').val(event.traineeName === null? "None" : event.traineeName);
                    $('#ModalEditIndivTraining #trainingCategory').val(event.trainingCategory);
                    $('#ModalEditIndivTraining #cost').val(event.cost);
                    $('#ModalEditIndivTraining #gym').val(event.gym);
                    $('#ModalEditIndivTraining #room').val(event.room);
                    $('#ModalEditIndivTraining #startSession').val(event.start._i);
                    $('#ModalEditIndivTraining #endSession').val(event.end._i);	
                    $('#ModalEditIndivTraining #description').val(event.description);	
                    $('#ModalEditIndivTraining').modal('show'); // inflate the modal
                }

                // if event is group training, show group training modal
                else if (event.color == "#0000B2" || event.color == "#FF0001"){
                    // TODO: pump data in group training modal and show modal
					 $('#ModalEditGroupTraining #groupSessionID').val(event.id);	
                    $('#ModalEditGroupTraining #title').val(event.title);
                    $('#ModalEditGroupTraining #trainerName').val(event.trainerName);
                    $('#ModalEditGroupTraining #traineeName').val(event.traineeName === null? "None" : event.traineeName);
                    $('#ModalEditGroupTraining #trainingCategory').val(event.trainingCategory);
                    $('#ModalEditGroupTraining #numberOfParticipants').val(event.numberOfParticipants);
                    $('#ModalEditGroupTraining #room').val(event.room);
                    $('#ModalEditGroupTraining #startSession').val(event.start._i);
                    $('#ModalEditGroupTraining #endSession').val(event.end._i);	
                    $('#ModalEditGroupTraining').modal('show'); // inflate the modal
                }
            });
        },

        // display the trainings on the calendar
        events: 

            trainingSessions.map(function(oneTraining) {

                // if individual training
                if (oneTraining.hasOwnProperty('sessionID')){

                    // transform data as per individual training
                    return {
                        id: oneTraining.sessionID,
                        title: oneTraining.title,
                        trainerName: oneTraining.trainerName,
                        traineeName: oneTraining.traineeName,
                        trainingCategory: oneTraining.trainingType,
                        cost: oneTraining.cost,
                        start: oneTraining.startSession,
                        end: oneTraining.endSession,
                        gym: oneTraining.locationName,
                        room: oneTraining.roomName,
                        description: oneTraining.description,
                        color:oneTraining.color
                        }
                }

                // if group training
                else if (oneTraining.hasOwnProperty('groupSessionID')){

                    return {
                        id: oneTraining.groupSessionID,
                        title: oneTraining.title,
                        trainerName: oneTraining.name,
                        trainingCategory: oneTraining.trainingType,
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
