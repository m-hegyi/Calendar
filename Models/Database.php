<?php

Class Db {

	function AddmeetingNoDb ($conn, $date, $time_start, $time_end, $comment) {
	    $error = false;

	    if ($date) {
	        if (strlen($time_start) == 5) {
	            if (strlen($time_end) == 5) {
	                if ($comment) {
	                    $comment = ClearString($comment, $conn);
	                    $time_start = date ("H:i:s", strtotime($time_start));                        
	                    $time_end = date ("H:i:s", strtotime($time_end));

	                    if ($time_start < $time_end) {

	                        $query = $this->FakeDb(rand(1, 1000000), $date, $time_start, $time_end, 'Kiss Béla', $comment);

	                    }
	                    else // hiba történt az időpont bevitel során

	                        $error[] = "A befejezés időpontja nem lehet korábban a kezdés időpontjától.";

	                }
	                else    //nincs komment 
	                    $error[] = "A megjegyzés rész nem lehet üres!";
	            }
	            else    // nem megfelelő az idő
	                $error[] = "A befejezés időpontja nem megfelelő.";
	        }
	        else // nem megfelelől a start idő
	            $error[] = "A kezdés időpontja nem megfelelő.";
	    }
	    else
	        $error[] = "A dátum nincs kitöltve.";    

	    if ($error)
	        return $error;
	    //print_r($error);
	}

	/*function Addmeeting ($conn, $date, $time_start, $time_end, $comment) {
	    $error = false;

	    if ($date) {
	        if (strlen($time_start) == 5) {
	            if (strlen($time_end) == 5) {
	                if ($comment) {
	                    $comment = ClearString($comment, $conn);
	                    $time_start = date ("H:i:s", strtotime($time_start));                        
	                    $time_end = date ("H:i:s", strtotime($time_end));

	                    if ($time_start < $time_end) {
	                        $query = "INSERT INTO `meetings` (`id`, `date`, `time_start`, `time_end`, `creator`, `create_id`, `description`) VALUES (NULL, '{$date}', '{$time_start}', '{$time_end}', 'Kiss Béla', '1', '{$comment}');";
	                        $result = mysqli_query($conn, $query);

	                        if (!$result)
	                            $error[] = "Hiba történt az adatbázisban.";
	                        else
	                            return false;
	                    }
	                    else // hiba történt az időpont bevitel során
	                        $error[] = "A befejezés időpontja nem lehet korábban a kezdés időpontjától.";

	                }
	                else    //nincs komment 
	                    $error[] = "A megjegyzés rész nem lehet üres!";
	            }
	            else    // nem megfelelő az idő
	                $error[] = "A befejezés időpontja nem megfelelő.";
	        }
	        else // nem megfelelől a start idő
	            $error[] = "A kezdés időpontja nem megfelelő.";
	    }
	    else
	        $error[] = "A dátum nincs kitöltve.";    

	    if ($error)
	        return $error;
	    //print_r($error);
	}*/

	function LoadMeetings ($year, $month) {
        $query = "SELECT * FROM meetings WHERE date LIKE '%" . $year . "-" . $month . "%'";
        $result = mysqli_query($this->conn, $query);
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $returnArray[] = $row;
            }
            return $returnArray;
        }
        else
            return false;
    }

  	function FakeDb($id, $date, $time_start, $time_end, $creator, $comment) 
  	{

    	//id, date, time_start, time_end, creator, comment

    	$meetings = [
    		'id' => $id,
    		'date' => $date,
    		'time_start' => $time_start,
    		'time_end' => $time_end,
    		'creator' => $creator,
    		'comment' => $comment
    	];

    	$_SESSION['meetings'][] = $meetings;

    }
	
	/*function AddMeeting ($date, $time_start, $time_end, $comment) {
        $error = array();

        if ($date) {
            if (strlen($time_start) == 4) {
                if (strlen($time_end) == 4) {
                    if ($comment) {

                        $comment = ClearString($comment);
                        $time_start = time ("H:i:s", strtotime($time_start));
                        $time_end = time ("H:i:s", strtotime($time_end));

                        if ($time_start < $time_end) {

                        }
                        else // hiba történt az időpont bevitel során
                            $error[] = "A befejezés időpontja nem lehet korábban a kezdés időpontjától";

                    }
                    else    //nincs komment 
                        $error[] = "A megjegyzés rész nem lehet üres!";
                }
                else    // nem megfelelő az idő
                    $error[] = "A befejezés időpontja nem megfelelő";
            }
            else // nem megfelelől a start idő
                $error[] = "A kezdés időpontja nem megfelelő";
        }
        else
            $error[] = "A dátum nincs kitöltve";


        $query = "";
        $result = mysqli_query($query, $this->conn);
    }

    private function ClearString($string) {
        $string = strip_tags($string);
        $string = stripslashes($string);
        $string = htmlentities($string);
        $string = mysqli_real_escape_string($string, $this->conn);
    }*/

}