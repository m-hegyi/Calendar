<?php

function ListYears($year) {

    $actual_year = date('Y');

    //5 évvel korábbi és 5 évvel előbbi adatok megadása
    $yearList = $actual_year - 4;
    echo $year;

    for ($i = 0; $i < 9; $i++) {
        echo '<option value="'. $yearList. '"';
        if ($year == $yearList)
            echo " selected";
        echo '>'. $yearList . '</option>';
        $yearList++;
    }
    echo $year;
}

function ListMonths($month) {
    $month       -= 1;
    $month_number = 1;
    $month_name   = array(
        'Január',
        'Február',
        'Március',
        'Április',
        'Május',
        'Június',
        'Július',
        'Augusztus',
        'Szeptember',
        'Október',
        'November',
        'December'
    );

    for($i = 0; $i < 12; $i++) {
        echo '<option value="' . $month_number . '"';
        if ($month == $i)
            echo " selected";
        echo '>' . $month_name[$i] . '</option>';
        $month_number++;
    }
}

function ListDays($year, $month) {
    $daysOfMonth    = date('t', mktime(0,0,0,$month,1,$year)); //hány napos a hónap
    $LeapYear       = date ('L', mktime (0,0,0,1,1,$year)); //szökőév
    $FirstDayOfWeek = date('w', mktime (0,0,0,$month,1,$year)); //a hónap else milyen napra esik 1-7ig
    $Today          = date ('j');
    $actualMonth    = date ('n');
    $actualYear     = date ('Y');

    if ($daysOfMonth == 30) {
        $pastMonth = 31;
        $nextMonth = 31;
    }
    else {
        if ($month == 1) {
            $pastMonth = 31;
            if ($LeapYear)
                $nextMonth = 29;
            else
                $nextMonth = 28;
        }
        elseif ($month == 3) {
            $nextMonth = 30;
            if ($LeapYear)
                $pastMonth = 29;
            else
                $pastMonth = 28;
        }
        else {
            $nextMonth = 30;
            $pastMonth = 30;
        }
    }

    $BeforeThisMonth = $FirstDayOfWeek-1; // az előző hónapokból hátramaradt napok
    $BeforeStatic    = $BeforeThisMonth;
    $nextMonthStart  = 1;

    for ($i = 0; $i < 5; $i++) {
        echo '<ul class="date-days">';

        for ($j = 1; $j < 8; $j++) {
            $DaysForLoop = 7 * $i + $j - $BeforeStatic;

            echo '<li class="date-day">';

            if ($BeforeThisMonth > 0 || $DaysForLoop > $daysOfMonth) {
                $DateForId = $pastMonth - $BeforeThisMonth + 1;         //az előző hónapból hátramaradt napok

                echo '<p class="date-day-p disabled-day';

                $BeforeThisMonth--;
            }
            else {
                $DateForId = $DaysForLoop;
                echo '<p id="' . $DateForId . '" class="date-day-p';
            }

            if ( $Today == $DaysForLoop && $month == $actualMonth && $year == $actualYear)    //A mai nap
                echo ' actual';



            if ($DaysForLoop > $daysOfMonth){
                echo '">' . $nextMonthStart . '</p>';
                $nextMonthStart++;
            }
            else
                echo '">' . $DateForId . '</p>';                            //A megjelenített napok számmal
        }


        echo '</ul>';
    }
}

function UserPic ($conn) {

    $query = 'SELECT * FROM profiles WHERE name LIKE "%Kiss B%"';
    $result = mysqli_query($conn, $query);
    if($result) {
        $rows = mysqli_num_rows($result);
        if ($rows < 2) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo  '<img src=' . $row["img"] . ' name="' . $row["name"] . '" title="profilkép" class="bottom-img">';
            }
        }
    }
}

function LoadMeetings ($year, $month, $conn) {

    $query = "SELECT * FROM meetings WHERE date LIKE '%" . $year . "-" . $month . "%'";
    $result = mysqli_query($conn, $query);
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $returnArray[] = $row;
        }
        return $returnArray;
    }
    else
        return false;
}