<?php
	include("database.php");
	if(isset($_POST["formSubmit"])) {
		$playerName = $_POST["PlayerName"];
		$email = $_POST["email"];
		$statement2 = $connection->prepare("SELECT * FROM tblPLAYER WHERE  PlayerName = :player");
		$statement2 -> execute(array(':player' => $playerName));
		$result = $statement2->fetchAll();
		if(!empty($result)) {
			echo "Player already exists in system";
		} else {
			$statement = $connection->prepare ("INSERT INTO tblPLAYER(PlayerName, PlayerContact) VALUES (:player, :contact)");
			$statement -> execute(array(':player' =>$playerName, ':contact' =>$email));
		}
		echo $playerName . " " . $email . " " . $password;
	}



?>