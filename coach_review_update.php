<?php  
include ('database.php');
$groupID = $_GET['groupID'];
$dateID = $_GET['dateID'];
$practiceID = $_GET['practiceID'];
$startTime = $_GET['startTime'];
$endTime = $_GET['endTime'];
$playerID = $_GET['playerID'];
$statement = $connection->prepare('DELETE From tblPLAYER_PRACTICE Where PracticeID = :practiceID AND PlayerID = :playerID');
$statement2 = $connection->prepare ("INSERT Into tblPRACTICE(DateID, GroupID, PracticeTypeID, StartTime, EndTime)  Values(:dateID, :groupID, :practiceTypeID, :startTime, :endTime)");
//$statement = $connection->prepare ("UPDATE tblPRACTICE SET startTime = :startTime, endTime = :endTime WHERE PracticeID = :practiceID");
//$statement -> execute(array(':practiceID' =>$practiceID, ':startTime' => $startTime, ':endTime' => $endTime));
$statement -> execute(array(':practiceID' =>$practiceID, ':playerID' =>$playerID));
$statement2 -> execute(array(':dateID' =>$dateID, ':groupID' => $groupID, ':practiceTypeID' => 1, ':startTime' => $startTime, ':endTime' => $endTime));
$statement3 = $connection->prepare ("INSERT INTO tblPLAYER_PRACTICE (PlayerID, PracticeID) VALUES (:playerid, :practiceid)");
	$query = $connection->query("Select PracticeID from tblPRACTICE WHERE GroupID = $groupID AND DateID = $dateID AND StartTime = '$startTime'");
			$practiceid = $query->fetch(PDO::FETCH_ASSOC);

				$statement3 -> execute(array(':playerid' => $playerID, 
				':practiceid' => $practiceid['PracticeID']));

			
?>
