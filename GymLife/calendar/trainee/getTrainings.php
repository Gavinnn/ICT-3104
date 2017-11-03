<?php

    require_once('../../conn.php');

    //---------------------------------------------------------------------------------------
    // desc: retrieve all trainings that are (available AND are equal to or beyond the current date) OR
    // the trainings that the Trainee has booked.
    // params: $traineeID (string)
    // returns: $record (array)
    //---------------------------------------------------------------------------------------
    function getTrainings($traineeID){

        $record = DB::query(
        "SELECT U.name, R.roomName, G.locationName,TR.trainingType, TR.cost, T.* 
        FROM trainersessions T 
        INNER JOIN user U ON T.trainerID = U.userID
        INNER JOIN rooms R ON T.roomID = R.roomID
        INNER JOIN gyms G ON T.locationID = g.locationID
        INNER JOIN trainings TR on T.trainingID = TR.trainingID
        WHERE (traineeID IS NULL AND startSession >= %s) OR traineeID = %s" 
        , date("Y/m/d"), $traineeID);
        
        return buildRecord($record);
    }

    //---------------------------------------------------------------------------------------
    // desc: retrieve only the trainings that the Trainee has booked and returns them
    // params: $traineeID (string)
    // returns: $record (array)
    //---------------------------------------------------------------------------------------
    function getUserTrainings($traineeID){
        
        $record = DB::query(
        "SELECT U.name, R.roomName, G.locationName,TR.trainingType, TR.cost, T.*  
        FROM trainersessions T
        INNER JOIN user U ON T.trainerID = U.userID
        INNER JOIN rooms R ON T.roomID = R.roomID
        INNER JOIN gyms G ON T.locationID = g.locationID
        INNER JOIN trainings TR on T.trainingID = TR.trainingID
        WHERE traineeID = %s", $traineeID);

        return buildRecord($record);
    }

    //---------------------------------------------------------------------------------------
    // desc: process the trainings in the record so that they are ready to be displayed 
    // in calendar
    // params: $record (array)
    // returns: $record (array)
    //---------------------------------------------------------------------------------------
    function buildRecord($record){
        // ensure that $record is an array
        $record = errorHandlingForRecords($record);
        
        // add in colors for the trainings based on whether it is available or not
        $record = includeColorsInRecord($record);

        return $record;
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