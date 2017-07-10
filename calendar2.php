<?php

session_start();

header("Content-type: text/html; charset=utf-8");

    require "functions.php";
    require "connection.php";

    $actualMonth = date ('n');
    $actualYear  = date ('Y');
    $year        = $actualYear;
    $month       = $actualMonth;

    if(!isset($_SESSION["year"]) || !isset($_SESSION["month"])) {
        $_SESSION["year"]  = $actualYear;
        $_SESSION["month"] = $actualMonth;
    }

    $year  = $_SESSION["year"];
    $month = $_SESSION["month"];

    if(isset($_REQUEST["submit_year"])) {

        $year  = $_POST["years"];
        $month = $_POST["months"];

    }

    if(isset($_REQUEST["prev_month"])) {
        if ($_POST["months"] == 1) {
            $month = 12;
            $year = $_POST["years"] - 1;
        }
        else {
            $year = $_POST["years"];
            $month = $_POST["months"] - 1;
        }

    }
    if(isset($_REQUEST["next_month"])) {
        if ($_POST["months"] == 12) {
            $month = 1;
            $year = $_POST["years"] + 1;
        }
        else {
            $year = $_POST["years"];
            $month = $_POST["months"] + 1;
        }
    }

    if(isset($_REQUEST["add"])) {
        $errors = Addmeeting($connection, $_POST["date"], $_POST["time_start"], $_POST["time_end"], $_POST["comment"]);
    }   

    $_SESSION["years"] = $year;
    $_SESSION["months"] = $month;


    $calendar = new Calendar($actualYear);
    $user = new User("Kiss Béla", $connection);

?><!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Calender</title>
    <link rel="stylesheet" href="style.css">
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/jsfunctions.js"></script>
</head>
<body>
<div class="main-calender">
    <div class="div-date-picker">
        <form method="post" action="index.php" name="date-modif" id="date-form">
            <select name="years" title="years" class="date-picker" id="select-year">
                <?php $calendar->ListYears($year); ?>
            </select>
            <select name="months" title="months" class="date-picker" id="select-month">
                <?php $calendar->ListMonths($month); ?>
            </select>
            <input type="submit" name="submit_year">

            <input type="submit" name="prev_month" id="prev_month" hidden>

            <label for="prev_month">
                <div id="left-arrow"><p>&#10094;</p><!--balra nyíl--></div>
            </label>

            <input type="submit" name="next_month" id="next_month" hidden>

            <label for="next_month">
                <div id="right-arrow"><p>&#10095;</p><!--jobbra nyíl--></div>
            </label>
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
            <?php $calendar->ListDays($year, $month); ?>
        </div>
    </div>
    <div class="bottom-content">
        <div class="bottom-date-form-pic-div" id="bottom-form-disabled">
            <div class="bottom-img-div"><?php $user->UserPic(); ?></div>
            <div class="bottom-date-div"><p class="bottom-date-p" id="bottom-actual-dat-disabled">Válassz egy dátumot</p></div>
            <div class="bottom-form-div">
                <form>
                    <input type="text" title="comment" disabled placeholder="Új bejegyzés" class="bottom-form-input">
                </form>
            </div>
            <div class="plus-sign-div"><p class="plus-sign-p" id="add-meeting">&#x002B;</p></div>
        </div>
        <div class="bottom-date-form-pic-div" id="bottom-form-enabled">
            <div class="bottom-img-div"><?php $user->UserPic(); ?></div>
            <div class="bottom-date-div"><p class="bottom-date-p" id="bottom-actual-date-enabled"></p></div>
            <div class="bottom-form-div">
                <form action="" method="POST">
                    <input type="text" title="comment" name= "comment" placeholder="Új bejegyzés" class="bottom-form-input" required="required">
                    <input type="hidden" name="date" value="" id="form-date">
                    <div class="bottom-form-time">
                        <span>Kezdés:</span><input type="time" name="time_start" placeholder="Kezdés" required="required">
                        <span>Vége:</span><input type="time" name="time_end" placeholder="Vége" required="required">
                    </div>
                    <div class="bottom-form-buttons" id="send-button-div">
                        <button type="button" id="close-meeting" class="bottom-form-button">Mégse</button>
                        <input type="submit" id="send-button" name="add" class="bottom-form-button" value="Hozzáad">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="today-list" id="today-lists">
        
    </div>

    <div id="asd">
        <?php 
            if(isset($errors)) {
                if ($errors) {
                    foreach ($errors as $error) {
                        echo "<p>A következő hiba lépett fel: {$error}</p>";
                    }
                }
            }
        ?>
    </div>

</div>



</body>
</html>
