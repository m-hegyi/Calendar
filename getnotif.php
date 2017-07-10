<?php

include_once 'initialize.php';


if(is_ajax()) {

    $year = $_POST["year"];
    $month = $_POST["month"];

    /*if ($month < 10) {
        $month = "0" . $month;
    }*/

    MeetingsToArrayNoDb($year, $month);

    //MeetingsToArray($connection, $year, $month);

}



function MeetingsToArrayNoDb($year, $month) {
    $array =  LoadMeetingsNoDb($year, $month);

    $newarray = array_fill(0, 31, 0);

    for($j = 0; $j < count($array); $j++) {
            
        $date = $array[$j]["date"];
        $date = substr($date, -2);  //az utolsó két számjegyet visszadja
        $date = (int)$date;
      	$date--;                    //eggyel csökentve mivel a tömb 0. eleme jelenti az elsejét

        foreach ($newarray as $key => $value) {
            if ($key == $date) {
                $newarray[$key]++;
            }
        }
     }
     $json["date"] = json_encode($newarray);

     //print_r($json);

     echo json_encode($newarray);
}

function LoadMeetingsNoDb($year, $month) 
{
    $meetings = $_SESSION['meetings'];

    if ($month > 9) 
        $date = $year . '-' . $month;
    else 
        $date = $year . '-' . $month . '-';
    
    foreach ($meetings as $meeting) {

        if(substr($meeting['date'], 0, 7) == $date) {

           $returnArray[] = $meeting;

        }

    }

    if (isset($returnArray)) 
        return $returnArray;
    else
        return false;

}

function MeetingsToArray($con, $year, $month) {
    $array =  LoadMeetings($con, $year, $month);

    $newarray = array_fill(0, 31, 0);

    for($j = 0; $j < count($array); $j++) {
            
        $date = $array[$j]["date"];
        $date = substr($date, -2);  //az utolsó két számjegyet visszadja
        $date = (int)$date;
        $date--;                    //eggyel csökentve mivel a tömb 0. eleme jelenti az elsejét

        foreach ($newarray as $key => $value) {
            if ($key == $date) {
                $newarray[$key]++;
            }
        }
     }
     $json["date"] = json_encode($newarray);

     //print_r($json);

     echo json_encode($newarray);
}

function LoadMeetings ($con, $year, $month) {
    $query = "SELECT date FROM meetings WHERE date LIKE '%" . $year . "-" . $month . "%'";
    $result = mysqli_query($con, $query);
    if ($result) {
    	if ($rows = mysqli_num_rows($result)) {
        	while ($row = mysqli_fetch_assoc($result)) {
            	$returnArray[] = $row;
        	}
        	return $returnArray;
    	}
    }
    else
        return false;
}

function is_ajax() {
  return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}