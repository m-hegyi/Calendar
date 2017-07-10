<?php

function ClearString($string, $conn) 
{
    $string = strip_tags($string);
    $string = stripslashes($string);
    $string = htmlentities($string);
    //$string = mysqli_real_escape_string($conn, $string);
    return $string;   
}