<?php

class User {

    private $nev;
    private $conn;

    function __construct ($nev = "User", $conn) 
    {

        $this->nev = $nev;
        $this->conn = $conn;

    }

    function UserPic () 
    {

        $query = 'SELECT * FROM profiles WHERE name LIKE "%Kiss B%"';
        $result = mysqli_query($this->conn, $query);
        if($result) {
            $rows = mysqli_num_rows($result);
            if ($rows < 2) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo  '<img src=' . $row["img"] . ' name="' . $row["name"] . '" title="profilkép" class="bottom-img">';
                }
            }
        }

    }

    function UserPicNoDb () 
    {

        echo '<img src=pics/prof.jpg name="profilkép" title="' . $this->nev . '" class="bottom-img">';

    }

    function LoadMeetings ($year, $month) 
    {
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