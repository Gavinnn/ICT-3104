<?php

    require_once('../../conn.php');

    //---------------------------------------------------------------------------------------
    // desc: retrieve all trainings that are available and returns them
    // params: $traineeID (string)
    // returns: $record (array)
    //---------------------------------------------------------------------------------------
    function getTrainings($traineeID){

        $record = DB::query("SELECT * FROM trainersessions WHERE traineeID IS NULL OR traineeID = %s", $traineeID);

        // ensure that $record is an array
        $record = errorHandlingForRecords($record);

        // add in trainer names into the record
        $record = includeTrainerNameInRecord($record);
        
        // add in colors for the trainings based on whether it is available or not
        $record = includeColorsInRecord($record);

        return $record;
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