<?php
	include("database.php");
	if(isset($_POST["formSubmit"])) {
		$playerName = $_POST["PlayerName"];
		$email = $_POST["email"];
		$group = $_POST["group"];
		$getPlayer = $connection->prepare("SELECT * FROM tblPLAYER WHERE  PlayerName = :player");
		$getPlayer -> execute(array(':player' => $playerName));
		$result = $getPlayer->fetchAll();
		$getID = $connection->prepare("SELECT PlayerID FROM tblPLAYER WHERE PlayerName = :player");
		$playerGroup = $connection->prepare("INSERT INTO tblPLAYER_GROUP(PlayerID, GroupID) VALUES (:playerID, :groupID)");
		if(!empty($result)) {
			echo "Player already exists in system";
		} else {
			$insertPlayer = $connection->prepare ("INSERT INTO tblPLAYER(PlayerName, PlayerContact) VALUES (:player, :contact)");
			$insertPlayer -> execute(array(':player' =>$playerName, ':contact' =>$email));
			$getID -> execute(array(':player' =>$playerName));
			$playerID = $getID->fetchAll();
			$ID = $playerID[0];
			$playerGroup -> execute(array(':playerID'=> $ID, ':groupID' => $group));
		}
		echo $playerName . " " . $email . " " . $password . " " . $group;
	}



?>