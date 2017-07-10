<?php

session_start();

if ($_SESSION['meetings']) {
	$_SESSION['meetings'] = [];
	print_r($_SESSION);
}

header('Location: index.php');