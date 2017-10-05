<?php
    // to retrieve all the trainings based on trainerID

    function getTrainings($trainerID){

        require_once('../conn.php');

        $record = DB::query("SELECT * FROM trainersessions WHERE trainerID = %d", $trainerID);

        // error handling
        if (!$record){
            print_r("Error in query");
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