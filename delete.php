<?php
include_once 'initialize.php';

if(is_ajax()) {
	if (isset($_POST["id"])) {
		$id = $_POST["id"];
		$id = ClearString($id, $connection);
		$id = substr($id, 7);
		deleteNoDb($id);
	};
}

function is_ajax() 
{
  return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}

function deleteNoDb($id) 
{
	$meetings = $_SESSION['meetings'];

	foreach ($meetings as $key => $meeting) {
		if ($meeting['id'] == $id) {
			unset($_SESSION['meetings'][$key]);
		}
	}
}

/*if(is_ajax()) {
	if (isset($_POST["id"])) {
		$id = $_POST["id"];
		$id = ClearString($id, $connection);
		$id = substr($id, 7);
		delete($connection, $id);
	};
}*/

function delete($conn, $id) {
	$query = "DELETE FROM `meetings` WHERE `meetings`.`id` = {$id}";
	$result = mysqli_query($conn, $query);
	if (!$result) {
		echo "hiba történt a törlés közben.";
	}
}