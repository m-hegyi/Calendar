<?php

    require "function_old.php";
    require "connection.php";

    $actualMonth = date ('n');
    $actualYear  = date ('Y');
    $year        = $actualYear;
    $month       = $actualMonth;

    if(!isset($_SESSION["year"]) && !isset($_SESSION["month"])) {
        $_SESSION["year"]  = $actualYear;
        $_SESSION["month"] = $actualMonth;
    }

    $year  = $_SESSION["year"];
    $month = $_SESSION["month"];

    if(isset($_REQUEST["submit_year"])) {

        $year  = $_POST["years"];
        $month = $_POST["months"];

    }

    $actualMeeting = LoadMeetings($year, $month, $connection);
    print_r($actualMeeting);

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Calender</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="main-calender">
    <div class="div-date-picker">
        <div id="left-arrow"><p>&#10094;</p><!--balra nyíl--></div>
        <div id="right-arrow"><p>&#10095;</p><!--jobbra nyíl--></div>
        <form method="post" action="calendar.php" name="date-modif">
            <select name="years" title="years" class="date-picker" id="select-year">
                <?php ListYears($year); ?>
            </select>
            <select name="months" title="months" class="date-picker" id="select-month">
                <?php ListMonths($month); ?>
            </select>
            <input type="submit" name="submit_year">
        </form>
    </div>
    <div class="middle-content">
        <div class="div-table-date">
            <ul class="days-name">
                <li class="date-day-name">Hét</li>
                <li class="date-day-name">Ked</li>
                <li class="date-day-name">Sze</li>
                <li class="date-day-name">Csü</li>
                <li class="date-day-name">Pén</li>
                <li class="date-day-name">Szo</li>
                <li class="date-day-name">Vas</li>
            </ul>
            <?php ListDays($year, $month); ?>
        </div>
    </div>
    <div class="bottom-content">
        <div class="bottom-date-form-pic-div">
            <div class="bottom-img-div"><?php UserPic($connection); ?></div>
            <div class="bottom-date-div"><p class="bottom-date-p" id="bottom-actual-date">2016. November 30</p></div>
            <div class="bottom-form-div">
                <form>
                    <input type="text" title="comment" disabled placeholder="Új bejegyzés" class="bottom-form-input">
                </form>
            </div>
            <div class="plus-sign-div"><p class="plus-sign-p">&#x002B;</p></div>
        </div>
    </div>



</div>

<script src="js/jquery-3.1.1.min.js"></script>
<script src="js/jsfunctions.js"></script>

</body>
</html>
