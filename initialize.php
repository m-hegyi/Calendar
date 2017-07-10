<?php

//INSERT INTO `meetings` (`id`, `date`, `time_start`, `time_end`, `creator`, `create_id`, `description`) VALUES (NULL, '2016-12-1', '07:00:00', '08:00:00', 'Kiss Béla', '1', 'asdasd');

session_start();

require 'connection.php';

require_once 'Models/Calendar.php';
require_once 'Models/Database.php';
require_once 'Models/User.php';
require_once 'functions.php';

$actualYear  = date ('Y');

$calendar = new Calendar($actualYear);
$user = new User("Kiss Béla", $connection);
$db = new Db();