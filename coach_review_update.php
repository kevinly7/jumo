<?php  
include ('database.php');
if(isset($_POST['groupID'])) {
$length = $_POST['length'];
$practice = array();
$statement = $connection->prepare('DELETE From tblPLAYER_PRACTICE Where PracticeID = :practiceID AND PlayerID = :playerID');
$statement2 = $connection->prepare ("INSERT Into tblPRACTICE(DateID, GroupID, PracticeTypeID, StartTime, EndTime)  Values(:dateID, :groupID, :practiceTypeID, :startTime, :endTime)");

$statement -> execute(array(':practiceID' =>$practiceID, ':playerID' =>$playerID));
$statement2 -> execute(array(':dateID' =>$dateID, ':groupID' => $groupID, ':practiceTypeID' => 1, ':startTime' => $startTime, ':endTime' => $endTime));

$statement3 = $connection->prepare ("INSERT INTO tblPLAYER_PRACTICE (PlayerID, PracticeID) VALUES (:playerid, :practiceid)");
for($i = 0; $i < $length; $i++) {
	$practice[$i] = 
	$groupID = $_POST['groupID'];
	$dateID = $_POST['dateID'];
	$practiceID = $_POST['practiceID'];
	$startTime = $_POST['startTime'];
	$endTime = $_POST['endTime'];
	$playerID = $_POST['playerID'];
	$edit = $_POST['edit'];
}

//$statement = $connection->prepare ("UPDATE tblPRACTICE SET startTime = :startTime, endTime = :endTime WHERE PracticeID = :practiceID");
//$statement -> execute(array(':practiceID' =>$practiceID, ':startTime' => $startTime, ':endTime' => $endTime));

	$query = $connection->query("Select PracticeID from tblPRACTICE WHERE GroupID = $groupID AND DateID = $dateID AND StartTime = '$startTime'");
			$practiceid = $query->fetch(PDO::FETCH_ASSOC);

				$statement3 -> execute(array(':playerid' => $playerID, 
				':practiceid' => $practiceid['PracticeID']));
echo "practice times updated!";
} else {
	echo "something was not set";
}
?>
