<?php
	if(isset($_POST["formSubmit"])) {
		$playerName = $_POST["PlayerName"];
		$email = $_POST["email"];
		echo $playerName . " " . $email . " " . $password;
	}



?>