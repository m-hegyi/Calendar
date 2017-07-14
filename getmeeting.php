<?php
header("Content-type: text/html; charset=utf-8");
include_once "initialize.php";


$day = $_GET["id"];
$month = $_GET["month"];
$year = $_GET["year"];


$date = $year . "-" . $month . "-" . $day;

if (isset($_SESSION['meetings'])) {

	$meetings = $_SESSION['meetings'];

	foreach ($meetings as $meeting) {
		
		if ($meeting['date'] == $date) {

			?>

			<div class="today-element-container">
	            <div class="today-element">
	                <div class="today-img-div">
	                    <?php $user->UserPicNoDb(); ?>
	                </div>
	                <div class="today-date-div">
	                    <p class="today-date-p">Dátum: <span class="today-date-span"><?php echo $meeting['date']; ?></span></p>
	                    <p class="today-date-p">Időpont: <span class="today-date-span"><?php echo substr($meeting["time_start"], 0, 5) . "-" . substr($meeting["time_end"], 0, 5); ?></span></p>
	                </div>
	                <div class="today-comment-div">
	                    <p><?php echo $meeting["comment"]; ?></p>
	                </div>
	                <div class="today-buttons-div">
	                	<div id="meeting<?php echo $meeting['id']; ?>">
		                    <input type="submit" title="delete" value="törlés" name="delete" class="today-button-delete">
	                    </div>
	                </div>
	            </div>
			</div>

			<?php
			
		}

	}

	
}


/*mysqli_query($connection,"set character set UTF8");

$query = "SELECT * FROM meetings WHERE date = '{$date}'";
$result = mysqli_query($connection, $query);

if($result) {
	$rows = mysqli_num_rows($result);
	if ($rows) {
		while ($row = mysqli_fetch_assoc($result)) {
			?>

			<div class="today-element-container">
	            <div class="today-element">
	                <div class="today-img-div">
	                    <?php UserPicTeszt($connection); ?>
	                </div>
	                <div class="today-date-div">
	                    <p class="today-date-p">Dátum: <span class="today-date-span"><?php echo $row["date"]; ?></span></p>
	                    <p class="today-date-p">Időpont: <span class="today-date-span"><?php echo substr($row["time_start"], 0, 5) . "-" . substr($row["time_end"], 0, 5); ?></span></p>
	                </div>
	                <div class="today-comment-div">
	                    <p><?php echo $row["description"]; ?></p>
	                </div>
	                <div class="today-buttons-div">
	                	<div id="meeting<?php echo $row['id']; ?>">
		                    <input type="submit" title="delete" value="törlés" name="delete" class="today-button-delete">
	                    </div>
	                </div>
	            </div>
        	</div>


			<?php
		}
	}
	else {
		echo "nincs esemény az adott napra";
	}
}
else {
	echo "Hiba történt";
}*/

