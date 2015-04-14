<?php

echo "inside database";
	//values for access to db
	$username = 'info344user';
	$password = '<password>';

	// Connect to database
	$query = '';
	try {
		$connection = new PDO('mysql:host=howarddatabase.c5n7l5fbfxta.us-west-2.rds.amazonaws.com:3306;dbname=ICADB', $username,$password);
		$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	} catch (PDOException $e) {
	  echo 'ERROR: ' . $e->getMessage();
	} 


?>