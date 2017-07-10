<?php
    require "connection.php";

    /*$query = "SELECT * FROM profiles";
    $result = mysqli_query($connection, $query);
    $rows = mysqli_num_rows($result);
    if ($result) {
        if ($rows > 0) {
            for ($j = 0; $j < $rows; $j++){
                $rows = mysqli_fetch_array($result, MYSQLI_BOTH);
                echo $rows['id'] . "<br>";
                echo $rows['name'] . "<br>";
                echo $rows['password'] . "<br>";
                echo $rows['img'] . "<br>";
            }
        }
    }*/


    /*$year = 2016;
    $month = 12;

    $query = "SELECT * FROM meetings WHERE date LIKE '%" . $year . "-" . $month . "%'";
    $result = mysqli_query($connection, $query);
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $returnArray[] = $row;
        }
    }

    print_r($returnArray);*/

   $FirstDayOfWeek = date('w', mktime (0,0,0,3,1,2017));
   echo $FirstDayOfWeek;