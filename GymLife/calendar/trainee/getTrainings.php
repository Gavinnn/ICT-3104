<?php

    require_once('../../conn.php');

    //---------------------------------------------------------------------------------------
    // desc: retrieve all trainings that are available and the trainings that the Trainee
    // has booked and returns them
    // params: $traineeID (string)
    // returns: $record (array)
    //---------------------------------------------------------------------------------------
    function getTrainings($traineeID){

        $record = DB::query("SELECT * FROM trainersessions WHERE traineeID IS NULL OR traineeID = %s", $traineeID);

        return buildRecord($record);
    }

    //---------------------------------------------------------------------------------------
    // desc: retrieve only the trainings that the Trainee has booked and returns them
    // params: $traineeID (string)
    // returns: $record (array)
    //---------------------------------------------------------------------------------------
    function getUserTrainings($traineeID){
        
        $record = DB::query("SELECT * FROM trainersessions WHERE traineeID = %s", $traineeID);

        return buildRecord($record);
    }

    //---------------------------------------------------------------------------------------
    // desc: include the necessary information into the record to be dispalyed on the calendar
    // params: $record (array)
    // returns: $record (array)
    //---------------------------------------------------------------------------------------
    function buildRecord($record){
        // ensure that $record is an array
        $record = errorHandlingForRecords($record);
        
        // add in trainer names into the record
        $record = includeTrainerNameInRecord($record);

        // add in room names into the record
        $record = includeRoomNameInRecord($record);

        // add in location names into the record
        $record = includeGymNameInRecord($record);

        // add in training types and cost into the record
        $record = includeTrainingTypeAndCostInRecord($record); 
        
        // add in colors for the trainings based on whether it is available or not
        $record = includeColorsInRecord($record);

        return $record;
    }

    //---------------------------------------------------------------------------------------
    // desc: add room name into the record and returns it
    // params: $record (array)
    // returns: $newRecord (array)
    //---------------------------------------------------------------------------------------
    function includeRoomNameInRecord($record){
        $rooms = getRoomNames();
        $newRecord = [];

        // for each record, retreive the roomID
        foreach($record as $training){
            $roomID = $training['roomID'];
            
            // determine the roomName from the roomID
            foreach($rooms as $room){

                // match is found, append the room name into the $training array,
                // and push the $training array into $newRecord
                if ($roomID == $room['roomID']){
                    $training['roomName'] = $room['roomName'];
                    array_push($newRecord, $training);
                    break;
                }
            }
        }
        return $newRecord;
    }

    //---------------------------------------------------------------------------------------
    // desc: add gym name into the record and returns it
    // params: $record (array)
    // returns: $newRecord (array)
    //---------------------------------------------------------------------------------------
    function includeGymNameInRecord($record){

        $gyms = getGymNames();
        $newRecord = [];

        // for each record, retreive the locationID
        foreach($record as $training){
            $locationID = $training['locationID'];
            
            // determine the locationName from the locationID
            foreach($gyms as $gym){

                // match is found, append the locationName into the $training array,
                // and push the $training array into $newRecord
                if ($locationID == $gym['locationID']){
                    $training['locationName'] = $gym['locationName'];
                    array_push($newRecord, $training);
                    break;
                }
            }
        }
        return $newRecord;
    }

    //---------------------------------------------------------------------------------------
    // desc: add training type and cost into the record and returns it
    // params: $record (array)
    // returns: $newRecord (array)
    //---------------------------------------------------------------------------------------
    function includeTrainingTypeAndCostInRecord($record){

        $trainingInfos = getTrainingTypesAndCost();
        $newRecord = [];

        // for each record, retreive the trainingID
        foreach($record as $training){
            $trainingID = $training['trainingID'];
            
            // determine the trainingType and cost from the locationID
            foreach($trainingInfos as $info){

                // match is found, append the trainingType and cost into the $training array,
                // and push the $training array into $newRecord
                if ($trainingID == $info['trainingID']){
                    $training['trainingType'] = $info['trainingType'];
                    $training['cost'] = $info['cost'];
                    array_push($newRecord, $training);
                    break;
                }
            }
        }
        return $newRecord;
    }

    //---------------------------------------------------------------------------------------
    // desc: add trainer names into the record and returns it
    // params: $record (array)
    // returns: $newRecord (array)
    //---------------------------------------------------------------------------------------
    function includeTrainerNameInRecord($record){

        $trainers = getTrainersNames();

        $newRecord = [];

        // for each record, retreive the trainerID
        foreach($record as $training){
            $trainerID = $training['trainerID'];
            
            // determine the trainerName from the trainerID
            foreach($trainers as $trainer){

                // match is found, append the trainer name into the $training array,
                // and push the $training array into $newRecord
                if ($trainerID == $trainer['userID']){
                    $training['trainerName'] = $trainer['name'];
                    array_push($newRecord, $training);
                    break;
                }
            }
        }

        return $newRecord;
    }

    //---------------------------------------------------------------------------------------
    // desc: based on whether the training is available, the color of the event on the 
    // calendar is changed. For e.g. if not available, RED. Else, GREEN 
    // returns: $record (array)
    //---------------------------------------------------------------------------------------
    function includeColorsInRecord($record){

        $newRecord = [];

        // iterate through each training
        foreach($record as $training){

            // if training is available, color it GREEN
            if ($training['traineeID'] == NULL){
                $training['color'] = '#008000';
            }
            // if training is not available, color it RED
            else{
                $training['color'] = '#FF0000';
            }
            array_push($newRecord, $training);
        }

        return $newRecord;
    }

    //---------------------------------------------------------------------------------------
    // desc: retrieve all userIDs and names of Trainers in database and returns them
    // returns: $record (array)
    //---------------------------------------------------------------------------------------
    function getTrainersNames(){
        $record = DB::query("SELECT userID, name from user where roleID = 2");

        return errorHandlingForRecords($record);
    }

    //---------------------------------------------------------------------------------------
    // desc: retrieve all roomIDs and roomNames of rooms in database and returns them
    // returns: $record (array)
    //---------------------------------------------------------------------------------------
    function getRoomNames(){
        $record = DB::query("SELECT roomID, roomName from rooms");
        
        return errorHandlingForRecords($record);
    }

    //---------------------------------------------------------------------------------------
    // desc: retrieve all locationIDs and locationNames of gyms in database and returns them
    // returns: $record (array)
    //---------------------------------------------------------------------------------------
    function getGymNames(){
        $record = DB::query("SELECT locationID, locationName from gyms");
        
        return errorHandlingForRecords($record);
    }

    //---------------------------------------------------------------------------------------
    // desc: retrieve all trainingIDs, trainingTypes and costs of trainigs in database
    // and returns them
    // returns: $record (array)
    //---------------------------------------------------------------------------------------
    function getTrainingTypesAndCost(){
        $record = DB::query("SELECT trainingID, trainingType, cost from trainings");
        
        return errorHandlingForRecords($record);
    }

    //---------------------------------------------------------------------------------------
    // desc: check for null records and sets the record to an array instead of null
    // params: $record (array or NULL)
    // returns: $record (array)
    //---------------------------------------------------------------------------------------
    function errorHandlingForRecords($record){

        // error handling
        if (!$record){
            $record = [];  
        }
        else {
            // if there are no trainings, return empty array instead of null
            if ($record == null){
                $record = [];
            }
        }

        return $record;
    }
?>