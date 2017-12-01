<div class="modal fade" id="GroupModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="grpTrainingForm" class="form-horizontal" method="POST" action="addTraining.php" onsubmit = "return validateDateTime(this.id);">
            
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Send Group Training Proposal</h4>
                </div>

                <div class="modal-body">

                    <div class="form-group">
                    <label for="title" class="col-sm-2 control-label">Training Title</label>
                        <div class="col-sm-10">
                            <input type="text" name="titleAG" class="form-control" id="titleAG" placeholder="Title" required>
                        </div>
                    </div>

                    <div class="form-group">
                    <label for="title" class="col-sm-2 control-label">Training Category</label>
                        <div class="dropdown col-sm-6" style="padding-top:10px;">
                            <select id="categoryAG" name="categoryAG" class="dropdown category" onchange="setCostValueGroup()" required>
                            <option selected disabled hidden>Select a Training</option>
                                <?php
                                $record = DB::query("SELECT * FROM trainings");

                                foreach ($record as $row) {
                                    echo "<option value='" . $row['trainingID'] . "' data-cost='" . $row['cost'] . "'>" . $row['trainingType'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>  

                    <div class="form-group">
                    <label for="title" class="col-sm-2 control-label">Cost</label>
                        <div class="col-sm-3">
                            <input type="text" id="costAG" class="form-control cost" name="costAG" readonly required>
                        </div>
                    </div>

                    <div class="form-group">
                    <label for="gym" class="col-sm-2 control-label">Gym</label>
                        <div class="dropdown col-sm-6" style="padding-top:10px;">
                            <!--  Since each Gym has their own unique rooms, once gym is selected, show only those rooms  -->
                            <select id="gymAG" name="gymAG" class="dropdown" onchange="setRoomsValueGroup()" required>
                                <option selected disabled hidden>Select a gym</option>
                                <?php
                                $record = DB::query("SELECT * FROM gyms");

                                foreach ($record as $row) {
                                    echo "<option value='" . $row['locationID'] . "' data-locationid='" . $row['locationID'] . "'>" . $row['locationName'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                    <label for="room" class="col-sm-2 control-label">Room</label>
                        <div class="dropdown col-sm-6" style="padding-top:10px;">
                            <select id="roomDropdownAG" name="roomAG" class="dropdown" onchange="setMaxParticipantsOfRoom()" required>
                                <option selected disabled>Select a gym first</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                    <label for="date" class="col-sm-2 control-label">Date</label>
                        <div class="col-sm-3">
                            <input type="text" name="dateAG" class="form-control" id="datepickerAG" required>
                        </div>
                    </div>

                    <div class="form-group">
                    <label for="startSession" class="col-sm-2 control-label">Start Time</label>
                        <div class="col-sm-4">
                            <input type="text" name="startSessionAG" class="form-control timepicker" id="startSessionAG" required>
                        </div>
                    </div>

                    <div class="form-group">
                    <label for="endSession" class="col-sm-2 control-label">End Time</label>
                        <div class="col-sm-4">
                            <input type="text" name="endSessionAG" class="form-control" id="endSessionAG" readonly required>
                        </div>
                    </div>


                    <div class="form-group">
                    <label for="maxCapacity" class="col-sm-2 control-label">Maximum Capacity</label>
                        <div class="dropdown col-sm-6" style="padding-top:10px;">
                            <input type="number" name="maxCapacityAG" min="2" class="form-control" id="maxCapacityAG" placeholder="Select a room first" readonly required>
                        </div>
                    </div>
                    
                        
                    <input type="hidden" name="trainerIdAG" class="form-control" id="trainerIdAG" value=<?php echo $trainerID ?>>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Send Proposal</button>
                    </div>
                </form> 
            </div>
        </div>
    </div>
</div>


<script>

    intializeModalJQuery();

    //---------------------------------------------------------------------------------------
    // desc: initialize jquery libraries on modal
    //---------------------------------------------------------------------------------------
    function intializeModalJQuery(){
        initializeTimePicker();
        initializeDatePicker();
    }

    //---------------------------------------------------------------------------------------
    // desc: initialize datepicker on modal
    //---------------------------------------------------------------------------------------
    function initializeDatePicker(){
        $( function() {
            $( "#datepickerAG" ).datepicker({
                 minDate: 0,    // prevent Trainer from selecting dates that has passed
                 dateFormat: "yy-mm-dd"
            });
        });
    }

    //---------------------------------------------------------------------------------------
    // desc: initialize timepicker on modal
    //---------------------------------------------------------------------------------------
    function initializeTimePicker(){

        // initialize timepicker
        $('#GroupModalAdd #startSessionAG').timepicker({
            disableTextInput: true,
            orientation: "bl",	
            timeFormat: "H:i",
            minTime: '10:00am',
            maxTime: '9:00pm',
        });

        // add one hour to the selected time
        $('#GroupModalAdd #startSessionAG').on('changeTime', function() {
                $('#GroupModalAdd #endSessionAG').val(moment.utc($(this).val(),'hh:mm').add(1,'hour').format('H:mm'));
        });
    }

    //---------------------------------------------------------------------------------------
    // desc: dynamically add costs to the dropdown based on the selected training category
    //---------------------------------------------------------------------------------------
    function setCostValueGroup() {
        var cost = $("#categoryAG").children('option:selected').data('cost');
        $("#costAG").val(cost);
    }

    //---------------------------------------------------------------------------------------
    // desc: dynamically add rooms to the dropdown based on the selected gym
    //---------------------------------------------------------------------------------------
    function setRoomsValueGroup(){

        $("#roomDropdownAG").empty();

        var gymID = $("#gymAG").children('option:selected').data('locationid');
            
        // ajax call to retrive all the rooms of the gym
        $.ajax({
            url: "getGymRooms.php",
            data: {'locationID' : gymID},
            type: 'POST',
            async: false,
            success: function (results) {

                // if there are rooms
                if (results){   
                    $("#roomDropdownAG").append(results);
                }
            }
        });
    }

    //---------------------------------------------------------------------------------------
    // desc: dynamically display max number of participants for a given room
    //---------------------------------------------------------------------------------------
    function setMaxParticipantsOfRoom(){

        $("#maxCapacityAG").val("");    // clear the input box first

        var maxNumber = $("#roomDropdownAG").children('option:selected').data('roomcapacity');

        $("#maxCapacityAG").attr("placeholder", "Max number of participants for this room: " + maxNumber);
        $("#maxCapacityAG").attr("max", maxNumber); // set cap for maximum value based on room max capacity
        $("#maxCapacityAG").removeAttr( "readonly" )    // allow Trainer to key in capacity once room is selected
    }
</script>