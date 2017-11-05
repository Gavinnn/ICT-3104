<?php
    
    require_once('../../conn.php');
    
    //---------------------------------------------------------------------------------------
    // desc: merge individual and group trainings into a single record and returns to 
    // calendar
    // returns: $record (array)
    //---------------------------------------------------------------------------------------
    function getTrainings(){
        return array_merge(getIndividualTrainings(), getGroupTrainings());
    }

    //---------------------------------------------------------------------------------------
    // desc: retrieve all individual trainings in the system
    // returns: $record (array)
    //---------------------------------------------------------------------------------------
    function getIndividualTrainings(){

        $record = DB::query(
        "SELECT U1.name AS trainerName, U2.name AS traineeName, R.roomName, G.locationName,TR.trainingType, TR.cost, T.* 
        FROM trainersessions T 
        INNER JOIN user U1 ON T.trainerID = U1.userID 
        LEFT JOIN user U2 ON T.traineeID = U2.userID
        INNER JOIN rooms R ON T.roomID = R.roomID
        INNER JOIN gyms G ON T.locationID = g.locationID
        INNER JOIN trainings TR on T.trainingID = TR.trainingID");
        
        return buildRecord($record);
    }

    //---------------------------------------------------------------------------------------
    // desc: retrieve all group trainings in the system that are approved
    // returns: $record (array)
    //---------------------------------------------------------------------------------------
    function getGroupTrainings(){

        $record = DB::query(
        "SELECT U.name, TR.trainingType, R.roomName, G.*
        FROM groupsessions G
        INNER JOIN USER U ON G.trainerID = U.userID
        INNER JOIN rooms R ON G.roomID = R.roomID
        INNER JOIN trainings TR ON G.trainingID = TR.trainingID
        WHERE G.sessionStatus = 2");

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
    // desc: assign color based on individual or group training or completed training
    // returns: $record (array)
    //---------------------------------------------------------------------------------------
    function includeColorsInRecord($record){

        $newRecord = [];

        // iterate through each training
        foreach($record as $training){

            // check is training individual training
            if (isTrainingIndividual($training)){

                // if indiv. training is available, color it GREEN
                if ($training['traineeID'] == NULL){
                    $training['color'] = '#008000';
                }

                // if indiv. training is not available, color it RED
                else{
                    $training['color'] = '#FF0000';
                }

                array_push($newRecord, $training);
            }

            // training is a group training instead
            else{

                // if group training is available, color it BLUE
                if ((int) $training['numberOfParticipants'] < (int) $training['maxCapacity']){
                    $training['color'] = '#0000B2';
                }

                // if group training is full, color it RED
                else{
                    $training['color'] = '#FF0001';
                }

                array_push($newRecord, $training);
            }
            
        }
        return $newRecord;
    }

    //---------------------------------------------------------------------------------------
    // desc: determine if training is individual training. If indiv, returns true. Else, false
    // params: $training (Object)
    // returns: (boolean)
    //---------------------------------------------------------------------------------------
    function isTrainingIndividual($training){
        if (array_key_exists('sessionID', $training)) {
            return true;
        }
        else{
            return false;
        }
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