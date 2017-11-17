function DateDiff(date1, date2) {
    var datediff = date1 - date2; //store the getTime diff - or +
    return (datediff / (24*60*60*1000) ); //Convert values to -/+ days and return value      
}


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
        editable: false,	// user can drag and drop events to a different date

        // to select a period of time (start and end time)
        select: function(start, end) {

            // if date is valid (not a passed date), pop up model
            if(!isPassedDate(start)){

                $('#ModalAdd #date').val(moment(start).format('YYYY-MM-DD'));
                $('#ModalAdd').modal('show');	// inflate the modal
    
                // initialize timepicker
                $('#ModalAdd #startTime').timepicker({
                    disableTextInput: true,
                    orientation: "bl",	
                    timeFormat: "H:i",
                    minTime: '10:00am',
                    maxTime: '9:00pm',
                });
    
                // add one hour to the selected time
                $('#ModalAdd #startTime').on('changeTime', function() {
                        $('#ModalAdd #endTime').val(moment.utc($(this).val(),'hh:mm').add(1,'hour').format('H:mm'));
                });
            }

            // if date is not valid
            else{
                // display an alert message
                $('#alert').html("<div class='alert alert-danger' role='alert'>Invalid date: Date has already passed.</div>");
                $('#alert').show();
                $("#alert").fadeOut(5000);
            }
        },

        // double click event handler
        eventRender: function(event, element) {
            element.bind('click', function() {
				//check if date is earlier than current date
				var current = new Date();
				if(DateDiff(event.start,current.getTime())<2)
				{
					//disable edit for individual
					$('#ModalEdit #title').prop('readonly', true);
					$('#ModalEdit #description').prop('readonly', true);
					$('#ModalEdit #save').hide();
					$('#ModalEdit #dlt').hide();
				}
				else
				{
					//enable edit
					$('#ModalEdit #title').prop('readonly', false);
					$('#ModalEdit #description').prop('readonly', false);
					$('#ModalEdit #save').show();
					$('#ModalEdit #dlt').show();
				}
               if (event.color == "#008000" || event.color == "#FF0000"){
                    $('#ModalEdit #sessionID').val(event.id);	
                    $('#ModalEdit #title').val(event.title);
                    $('#ModalEdit #traineeName').val(event.traineeName === null? "None" : event.traineeName);
                    $('#ModalEdit #gym').val(event.locationName);
                    $('#ModalEdit #room').val(event.room);
                    $('#ModalEdit #startSession').val(event.start._i);
                    $('#ModalEdit #endSession').val(event.end._i);	
                    $('#ModalEdit').modal('show'); // inflate the modal
                }
            
                // if event is group training, show group training modal
                else if (event.color == "#0000B2" || event.color == "#FF0001"){
                    $('#GroupModalEdit #sessionID').val(event.id);	// pump the id into the Edit modal
                    $('#GroupModalEdit #title').val(event.title);
                    $('#GroupModalEdit #gym').val(event.locationName);
                    $('#GroupModalEdit #room').val(event.room);
                    $('#GroupModalEdit #maxCapacity').val(event.maxCapacity);
                    $('#GroupModalEdit #numberOfParticipants').val(event.numberOfParticipants);
                    $('#GroupModalEdit #startSession').val(event.start._i);
                    $('#GroupModalEdit #endSession').val(event.end._i);
                 
                    $('#GroupModalEdit').modal('show'); // inflate the modal
                }
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

                // if individual training
                if (oneTraining.hasOwnProperty('sessionID')){

                    // transform data as per individual training
                    return {
                        id: oneTraining.sessionID,
                        title: oneTraining.title,
                        trainerName: oneTraining.trainerName,
                        traineeName: oneTraining.traineeName,
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
                        maxCapacity: oneTraining.maxCapacity,
                        numberOfParticipants: oneTraining.numberOfParticipants,
                        gym: oneTraining.locationName,
                        room: oneTraining.roomName,
                        start: oneTraining.startSession,
                        end: oneTraining.endSession,
                        
                        color:oneTraining.color
                    }
                }
            }),
			timezone: 'local'
    });
}


// desc: ensures that the past dates in FullCalendar are not clickable by the user
// returns true, if date is in the past. Else, returns false
// return: (boolean)
function isPassedDate(start){
    let startDate = start.format('YYYY-MM-DD');
    let today = moment().format('YYYY-MM-DD');

    // if date is the past date, returns true
    if (startDate < today){
        return true;
    }
    // date is valid, returns false
    else{
        return false;
    }
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

