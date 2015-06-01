<?php
	include ('database.php');
	if(isset($_POST["formSubmit"])) {
		$uwid = $_POST["username"];
		$password = $_POST["password"];
		$email = $_POST["email"];
		$usertype = $_POST["group1"];
		echo $uwid . " " . $password . " " . $email . " " . $usertype;
		$statement = $connection->prepare ("INSERT Into tblUSER(UserTypeName, UserName, UserPassword)  Values(:userType, :userName, :userPassword)");
		$statement -> execute(array(':userType' =>$usertype, ':userName' =>$uwid, ':userPassword' =>$password));



	}


?>