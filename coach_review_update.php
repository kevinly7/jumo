<?php  
include ('database.php');
if(isset($_POST['formSubmit'])) {
	$length = $_POST['length'];
	$statement = $connection->prepare('DELETE From tblPLAYER_PRACTICE Where PracticeID = :practiceID AND PlayerID = :playerID');
	$statement2 = $connection->prepare ("INSERT Into tblPRACTICE(DateID, GroupID, PracticeTypeID, StartTime, EndTime)  Values(:dateID, :groupID, :practiceTypeID, :startTime, :endTime)");

	//$statement -> execute(array(':practiceID' =>$practiceID, ':playerID' =>$playerID));
	//$statement2 -> execute(array(':dateID' =>$dateID, ':groupID' => $groupID, ':practiceTypeID' => 1, ':startTime' => $startTime, ':endTime' => $endTime));

	$statement3 = $connection->prepare ("INSERT INTO tblPLAYER_PRACTICE (PlayerID, PracticeID) VALUES (:playerid, :practiceid)");
	for($i = 1; $i < $length + 1; $i++) {
		$groupID = $_POST['groupID' . $i];
		$dateID = $_POST['dateID' . $i];
		$practiceID = $_POST['practiceID' . $i];
		$startTime = $_POST['startTime' . $i];
		$endTime = $_POST['endTime' . $i];
		$playerID = $_POST['playerID' . $i];
		
		
		if(isset($_POST['delete' . $i])) {
			$statement -> execute(array(':practiceID' =>$practiceID, ':playerID' =>$playerID));
			echo 'deleted practice';
		} elseif(isset($_POST['edit' . $i])) {
			$edit = $_POST['edit' . $i];
			
				echo $startTime . ' to ' . $endTime;
				$statement -> execute(array(':practiceID' =>$practiceID, ':playerID' =>$playerID));
				$statement2 -> execute(array(':dateID' =>$dateID, ':groupID' => $groupID, ':practiceTypeID' => 1, ':startTime' => $startTime, ':endTime' => $endTime));
				$query = $connection->query("Select PracticeID from tblPRACTICE WHERE GroupID = $groupID AND DateID = $dateID AND StartTime = '$startTime'");
				$practiceid = $query->fetch(PDO::FETCH_ASSOC);
				$statement3 -> execute(array(':playerid' => $playerID, ':practiceid' => $practiceid['PracticeID']));
				//make pdo call
			
		}
	}

	//$statement = $connection->prepare ("UPDATE tblPRACTICE SET startTime = :startTime, endTime = :endTime WHERE PracticeID = :practiceID");
	//$statement -> execute(array(':practiceID' =>$practiceID, ':startTime' => $startTime, ':endTime' => $endTime));

		/*$query = $connection->query("Select PracticeID from tblPRACTICE WHERE GroupID = $groupID AND DateID = $dateID AND StartTime = '$startTime'");
		$practiceid = $query->fetch(PDO::FETCH_ASSOC);
		$statement3 -> execute(array(':playerid' => $playerID, ':practiceid' => $practiceid['PracticeID']));*/
	echo "practice times updated!";
} else {
	echo "something was not set";
}
?>
