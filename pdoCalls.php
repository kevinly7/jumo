<?php 
include 'Group.php';
include 'Player.php';
$conn = new PDO('mysql:host=howarddatabase.c5n7l5fbfxta.us-west-2.rds.amazonaws.com;dbname=ICADB', 'info344user', '<password>'); 
//Get Players
/*$statement = $conn->prepare("Select * from tblPLAYER");
$statement -> execute(array(':name' =>$name, ':firstName' => $firstName, ':lastName' => $lastName));
$data = $statement->fetchAll();*/
$playerArray = Array();
$i = 0;
foreach($conn->query("Select * from tblPLAYER") as $row) {
	echo $row['PlayerName'];
	$player = new Player($row['PlayerName'], $row['PlayerContact'], $row['PlayerID']);
	$playerArray[$i] = $player;
	$i++;
}

$groupArray = Array();
$j = 0;
foreach($conn->query("Select * from tblGROUP") as $row) {
	echo $row['GroupName'];
	$group = new Group($row['CoachName'], $row['CoachContact'], $row['GroupID'], $row['GroupName']);
	$groupArray[$i] = $group;
	$j++;
}

?>