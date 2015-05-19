<?php  
include ('database.php');
if(isset($_POST['formSubmit'])) {
	$statement = $connection->prepare ("INSERT Into tblPRACTICE(DateID, GroupID, PracticeTypeID, StartTime, EndTime)  Values(:dateID, :groupID, :practiceTypeID, :startTime, :endTime)");

	//$statement -> execute(array(':practiceID' =>$practiceID, ':playerID' =>$playerID));
	//$statement2 -> execute(array(':dateID' =>$dateID, ':groupID' => $groupID, ':practiceTypeID' => 1, ':startTime' => $startTime, ':endTime' => $endTime));
	$statement2 = $connection->prepare ("INSERT INTO tblDATE (DateName) 
   	VALUES (:datename)");
	$statement3 = $connection->prepare ("INSERT INTO tblPLAYER_PRACTICE (PlayerID, PracticeID) VALUES (:playerid, :practiceid)");
	$statement4 = $connection->prepare("Select * FROM tblPRACTICE where DateID = :dateID");
	$groupID = $_POST['groupSelect'];
	$date = $_POST['date'];
	$startTime = $_POST['startTime'];
	$endTime = $_POST['endTime'];
	//$playerID = $_POST['playerID'];
	echo $groupID;
	echo $date;
	echo $startTime;
	echo $endTime;
	//$datequery = $connection->query("Select DateID from tblDATE where DateName = '$date'");
	//$datequery->execute();

	$datequery = $connection->query("Select DateID from tblDATE where DateName = '$date'");
	$datequery->execute();

	if($datequery->rowCount() < 1)
	{
		// row exists. do whatever you want to do.
		$statement2 -> execute(array(':datename' => $date));
	} 
	
	$datequery->execute();
	$dateids = $datequery->fetch(PDO::FETCH_ASSOC);
	$dateID = $dateids['DateID'];
	echo $dateID . " date id ";
	
	//Check for time conflicts
	/*$statement4->execute(aray(':dateID' => $dateID));
	foreach($statement4 as $row) {
		
	}*/
	$statement -> execute(array(':dateID' =>$dateID, ':groupID' => $groupID, ':practiceTypeID' => 1, ':startTime' => $startTime, ':endTime' => $endTime));

	$query = $connection->query("Select PracticeID from tblPRACTICE WHERE GroupID = $groupID AND DateID = $dateID AND StartTime = '$startTime'");
	$practiceid = $query->fetch(PDO::FETCH_ASSOC);
	
	foreach($connection->query("Select * from tblPLAYER_GROUP pg WHERE pg.GroupID = $groupID") as $row) {
		$statement3 -> execute(array(':playerid' => $row['PlayerID'], 
		':practiceid' => $practiceid['PracticeID']));
	}	
	
	/*if(isset($_POST['delete' . $i])) {
		$statement -> execute(array(':practiceID' =>$practiceID, ':playerID' =>$playerID));
		echo 'deleted practice';
	} elseif(isset($_POST['edit' . $i])) {
		$edit = $_POST['edit' . $i];
		if($edit == 'edit') {
			echo $startTime . ' to ' . $endTime;
			$statement -> execute(array(':practiceID' =>$practiceID, ':playerID' =>$playerID));
			$statement2 -> execute(array(':dateID' =>$dateID, ':groupID' => $groupID, ':practiceTypeID' => 1, ':startTime' => $startTime, ':endTime' => $endTime));
			$query = $connection->query("Select PracticeID from tblPRACTICE WHERE GroupID = $groupID AND DateID = $dateID AND StartTime = '$startTime'");
			$practiceid = $query->fetch(PDO::FETCH_ASSOC);
			$statement3 -> execute(array(':playerid' => $playerID, ':practiceid' => $practiceid['PracticeID']));
			//make pdo call
		}
	}*/


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
