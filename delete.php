<?php
	include("database.php");
	$selected = $_POST["formStudents"];
	$count = count($selected);
	$playerGroup = $connection->prepare("DELETE FROM tblPLAYER_GROUP WHERE PlayerID = :playerID");
	$playerPractice = $connection->prepare("DELETE FROM tblPLAYER_PRACTICE WHERE PlayerID = :playerID");
	$player = $connection->prepare("DELETE FROM tblPLAYER WHERE PlayerID = :playerID");
	//$playerGroup ->bindPram(':playerID', $row);
	foreach($selected as $row) {
		$playerGroup ->bindParam(':playerID', $row);
		$playerGroup -> execute();
		$playerPractice -> bindParam(':playerID', $row);
		$playerPractice -> execute();
		$player -> bindParam(':playerID', $row);
		$player -> execute();
		echo $row;
	}
	//echo $selected[0];



?>