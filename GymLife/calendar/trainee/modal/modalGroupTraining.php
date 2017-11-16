<div class="modal fade" id="ModalGroupConfirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
    <form class="form-horizontal" method="POST" action="confirmTraining.php">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Confirm Group Training</h4>
        </div>
        <div class="modal-body" id="modal-body">

            <div class="form-group">
            <label for="trainingTitle" class="col-sm-2 control-label">Training Title</label>
            <div class="col-sm-10">
                <input type="text" name="title" class="form-control" id="title" placeholder="Title" readonly>
            </div>
            </div>

            <div class="form-group">
            <label for="trainerName" class="col-sm-2 control-label">Trainer Name</label>
            <div class="col-sm-4">
                <input type="text" name="trainerName" class="form-control" id="trainerName" readonly>
            </div>
            </div>

            <div class="form-group">
            <label for="trainingType" class="col-sm-2 control-label">Training Category</label>
            <div class="col-sm-4">
                <input type="text" name="trainingType" class="form-control" id="trainingType" readonly>
            </div>
            </div>

            <div class="form-group">
            <label for="cost" class="col-sm-2 control-label">Cost</label>
            <div class="col-sm-4">
                <input type="text" name="cost" class="form-control" id="cost" readonly>
            </div>
            </div>

            <div class="form-group">
            <label for="startTime" class="col-sm-2 control-label">Start Time</label>
            <div class="col-sm-4">
                <input type="text" name="startTime" class="form-control" id="startTime" readonly>
            </div>
            </div>

            <div class="form-group">
            <label for="endTime" class="col-sm-2 control-label">End Time</label>
            <div class="col-sm-4">
                <input type="text" name="endTime" class="form-control" id="endTime" readonly>
            </div>
            </div>

            <div class="form-group">
            <label for="gym" class="col-sm-2 control-label">Gym</label>
            <div class="col-sm-4">
                <input type="text" name="gym" class="form-control" id="gym" readonly>
            </div>
            </div>

            <div class="form-group">
            <label for="room" class="col-sm-2 control-label">Room</label>
            <div class="col-sm-4">
                <input type="text" name="room" class="form-control" id="room" readonly>
            </div>
            </div>

            <div class="form-group">
            <label for="numberOfParticipants" class="col-sm-2 control-label">Number of Participants</label>
            <div class="col-sm-4">
                <input type="text" name="numberOfParticipants" class="form-control" id="numberOfParticipants" readonly>
            </div>
            </div>

            <div class="form-group">
            <label for="maxCapacity" class="col-sm-2 control-label">Max Capacity</label>
            <div class="col-sm-4">
                <input type="text" name="maxCapacity" class="form-control" id="maxCapacity" readonly>
            </div>
            </div>

            <input type="hidden" name="groupSessionID" class="form-control" id="groupSessionID">
            <input type="hidden" name="traineeID" class="form-control" id="traineeID" value=<?php echo $traineeID ?>>


        </div>
        <div class="modal-footer">
        <button type="button" id="closeButton" class="btn btn-default" data-dismiss="modal">Close</button>
        <button id="confirmButtonGroup" type="submit" class="btn btn-success">Confirm</button>
        </div>
    </form>                    
    </div>
    </div>
</div>