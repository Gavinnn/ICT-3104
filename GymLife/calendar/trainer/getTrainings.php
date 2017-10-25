<?php

     require_once('../../conn.php');

    // to retrieve all the trainings based on trainerID

    function getTrainings($trainerID){

        $record = DB::query("SELECT * FROM trainersessions WHERE trainerID = %d", $trainerID);
        
          // ensure that $record is an array
        $record = errorHandlingForRecords($record);
        
          // add in colors for the trainings based on whether it is available or not
        $record = includeColorsInRecord($record);
        
           // add in trainee names into the record
        $record = includeTraineeNameInRecord($record);

        return $record;

    }
    
      //---------------------------------------------------------------------------------------
    // desc: add trainee names into the record and returns it
    // params: $record (array)
    // returns: $newRecord (array)
    //---------------------------------------------------------------------------------------
    function includeTraineeNameInRecord($record){

        $trainees = getTraineesNames();

        $newRecord = [];

        // for each record, retreive the traineeID
        foreach($record as $training){
            $traineeID = $training['traineeID'];
            
            // If event has no trainee, push $training into $newRecord
            if ($traineeID == NULL){
                array_push($newRecord, $training);
            }
            
            // If event has a trainee, find trainee's name
            else{
                
                // determine the traineeName from the traineeID
               foreach($trainees as $trainee){

                   // match is found, append the Trainee name into the $training array,
                   // and push the $training array into $newRecord
                   if ($traineeID == $trainee['userID'] ){
                       $training['traineeName'] = $trainee['name'];
                      array_push($newRecord, $training);
                      break;
                   }
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
    // desc: retrieve all userIDs and names of Trainees' in database and returns them
    // returns: $record (array)
    //---------------------------------------------------------------------------------------
    function getTraineesNames(){
        $record = DB::query("SELECT userID, name from user where roleID = 3");

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