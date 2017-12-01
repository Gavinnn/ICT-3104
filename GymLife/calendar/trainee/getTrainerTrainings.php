<?php

    require_once('../../conn.php');

    //---------------------------------------------------------------------------------------
    // desc: merge individual and group trainings into a single record and returns to 
    // calendar
    // returns: $record (array)
    //---------------------------------------------------------------------------------------
    function getTrainings($trainerID){
        return array_merge(getIndividualTrainings($trainerID), getGroupTrainings($trainerID));
    }

    //---------------------------------------------------------------------------------------
    // desc: retrieve all INDIVIDUAL trainings that are (available AND are equal to 
    // or beyond the current date) OR the individual trainings that the Trainer has created.
    // params: $trainerID (string)
    // returns: $record (array)
    //---------------------------------------------------------------------------------------
    function getIndividualTrainings($trainerID){

        $record = DB::query(
        "SELECT U.name, R.roomName, G.locationName,TR.trainingType, TR.cost, T.* 
        FROM trainersessions T 
        INNER JOIN user U ON T.trainerID = U.userID
        INNER JOIN rooms R ON T.roomID = R.roomID
        INNER JOIN gyms G ON T.locationID = g.locationID
        INNER JOIN trainings TR on T.trainingID = TR.trainingID
        WHERE trainerID = %s AND startSession >= %s" 
        ,$trainerID,  date("Y/m/d"));
        
        return buildRecord($record);
    }

    //---------------------------------------------------------------------------------------
    // desc: retrieve all the Trainer's GROUP trainings that are (available AND are equal to 
    // or beyond the current date) 
    // returns: $record (array)
    //--------------------------------------------------------------------------------------
    function getGroupTrainings($trainerID){
	
        $record = DB::query(
        "SELECT DISTINCT U.name AS trainerName, TR.trainingType, TR.cost, R.roomName, GY.locationName, U2.name AS traineeName, G.*
        FROM groupsessions G
        INNER JOIN USER U ON G.trainerID = U.userID
        INNER JOIN rooms R ON G.roomID = R.roomID
        INNER JOIN gyms GY ON G.locationID = GY.locationID
        INNER JOIN trainings TR ON G.trainingID = TR.trainingID
        LEFT JOIN traineegroupsession TGR ON G.groupSessionID = TGR.groupSessionID
        LEFT JOIN user U2 ON TGR.traineeID = U2.userID
        WHERE (G.trainerID = %d AND G.startSession >= %s AND G.numberOfParticipants < G.maxCapacity)
		GROUP BY G.groupSessionID", $trainerID, date("Y/m/d")
        );
        return buildRecord($record);
    }

    //---------------------------------------------------------------------------------------
    // desc: retrieve only the trainee's individual trainings
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
    // desc: retrieve only the Trainee's group trainings
    // params: $traineeID (string)
    // returns: $record (array)
    //---------------------------------------------------------------------------------------
    function getGroupUserTrainings($traineeID){
        
        $record = DB::query(
        "SELECT U.name AS traineeName,R.roomName,G.locationName,T.trainingType,T.cost,U1.name AS trainerName, GS.* 
         FROM groupsessions GS
         INNER JOIN traineegroupsession TG ON GS.groupsessionID = TG.groupsessionID
         INNER JOIN user U on U.userID = TG.traineeID
         INNER JOIN rooms R ON GS.roomID = R.roomID
         INNER JOIN gyms G ON GS.locationID = G.locationID
         INNER JOIN trainings T ON GS.trainingID = T.trainingID
         INNER JOIN user U1 on GS.trainerID = U1.userID
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
    // desc: assign color based on individual or group training or completed training
    // returns: $record (array)
    //---------------------------------------------------------------------------------------
    function includeColorsInRecord($record){

        $newRecord = [];

        // iterate through each training
        foreach($record as $training){

            // check is training individual training
            if (array_key_exists('sessionID', $training)){
                
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
            else if (array_key_exists('groupSessionID', $training)){

                // if group training is not booked yet by the trainee, color it BLUE
                if ($training['traineeName'] == NULL){
                    $training['color'] = '#0000B2';
                }

                // if group training is booked by the trainee, color it RED
                else{
                    $training['color'] = '#FF0001';
                }

                array_push($newRecord, $training);
            }
        }

        return $newRecord;
    }

    //---------------------------------------------------------------------------------------
    // desc: check for null records and sets the record to an array instead of null
    // params: $record (array or NULL)
    // returns: $record (array)
    //---------------------------------------------------------------------------------------
    function errorHandlingForRecords($record){

        if (!$record || $record == null){
            $record = [];  
        }
        return $record;
    }
?>

