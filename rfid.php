<?php
// 	header("Content-type: text/xml"); 
include ('database.php');

	$statement = $connection->prepare ("INSERT INTO tblPRACTICE (DateID, GroupID, PracticeTypeID, StartTime, EndTime) 
   	VALUES (:dateid, :groupid, :practicetypeid, :starttime, :endtime)");
    $statement2 = $connection->prepare ("INSERT INTO tblPLAYER_PRACTICE (PlayerID, PracticeID) 
   	VALUES (:playerid, :practiceid)");
   	$statement3 = $connection->prepare ("INSERT INTO tblDATE (DateName) 
   	VALUES (:datename)");
	
   	if (isset($_POST['uid']) && isset($_POST['time'])) {
		$groupID = $_POST['uid'];
		$tData = $_POST['time'];
		$timeData = explode('_', $tData);
		$time = $timeData[0];
		$day = $timeData[1];
		$month = $timeData[2];
		$year = $timeData[3];
		$num_length = strlen((string)$month);
		
		if ($num_length < 2){
			$month = '0'.$month;
		}

		$date = $year.$month.$day;

		$datequery = $connection->query("Select DateID from tblDATE where DateName = '$date'");
		$datequery->execute();

		if($datequery->rowCount() < 1)
		{
		    // row exists. do whatever you want to do.
		    $statement3 -> execute(array(':datename' => $date));
		} 

		$dateids = $datequery->fetch(PDO::FETCH_ASSOC);
		$dateid = $dateids['DateID'];

		$practicequery = $connection->query("Select * from tblPRACTICE WHERE GroupID = $groupID AND DateID = $dateid");
		$practicequery->execute();
		$practiceid = 1;


		if($practicequery->rowCount() < 1)
		{
		    // row exists. do whatever you want to do.
		   $statement -> execute(array(':dateid' => $dateid, 
					':groupid' => $groupID, 
					':practicetypeid' => 1, 
					':starttime' => $time,
					':endtime' => NULL));

		} else {
			$practiceData = $practicequery->fetch(PDO::FETCH_ASSOC);
			$practiceid = $practiceData['PracticeID'];
			$checkTime = true;

			foreach($practicequery as $row) {
				$starttime = $row['StartTime'];
				if ($row['EndTime'] == NULL) {
					$updatepractice = $connection->query("UPDATE tblPRACTICE SET EndTime = '$time' WHERE GroupID = $groupID AND DateID = $dateid AND StartTime = '$starttime'");
					$updatepractice->execute();
					$checkTime = false;
					$practiceid = $row['PracticeID'];
					insertPlayers($practiceid);
				}
			}

			if($checkTime) {
				  $statement -> execute(array(':dateid' => $dateid, 
					':groupid' => $groupID, 
					':practicetypeid' => 1, 
					':starttime' => $time,
					':endtime' => NULL));
			}
		}

		function insertPlayers($practiceid){
			foreach($connection->query("Select * from tblPLAYER_GROUP pg WHERE pg.GroupID = $groupID") as $row) {
				$statement2 -> execute(array(':playerid' => $row['PlayerID'], 
				':practiceid' => $practiceid));
			}

		}
	// 	$db = $sql_
		
		echo($uid);
	}
	echo "this is up!";
	?>
