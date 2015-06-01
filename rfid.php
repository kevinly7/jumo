<?php
// 	header("Content-type: text/xml"); 
include ('database.php');
include('grouprfid.php');

echo "does it work";
	$uid = $_POST['uid'];
	$time = $_POST['time'];
	
// 	$db = $sql_
	$file = 'data.txt';
	
	//file_put_contents($file, $uid ." " .  $time . "\n", FILE_APPEND);
	echo($uid);


$inside = "not";
file_put_contents($file, $inside . " " . $uid ." " .  $time . "\n", FILE_APPEND);


$statement = $connection->prepare ("INSERT INTO tblPRACTICE (DateID, GroupID, PracticeTypeID, StartTime, EndTime) 
	VALUES (:dateid, :groupid, :practicetypeid, :starttime, :endtime)");
$statement2 = $connection->prepare ("INSERT INTO tblPLAYER_PRACTICE (PlayerID, PracticeID) 
	VALUES (:playerid, :practiceid)");
	$statement3 = $connection->prepare ("INSERT INTO tblDATE (DateName) 
	VALUES (:datename)");
	//echo "works: " . $_GET['uid'];

   	if (isset($_POST['uid']) && isset($_POST['time'])) {
   		echo "did it work?";
   		$inside = "yes";
		$groupID = $_POST['uid'];
		$tData = $_POST['time'];
		$timeData = explode('_', $tData);
		$hour = $timeData[0]; 
		$minute = $timeData[1]; 
		$second = $timeData[2];
		$day = $timeData[3];
		$month = $timeData[4];
		$year = $timeData[5];
		$time = $hour.$minute.$second;
		$num_length = strlen((string)$month);

		if ($num_length < 2){
			$month = '0'.$month;
		}

		$date = $year.$month.$day;

		$datequery = $connection->query("Select DateID from tblDATE where DateName = '$date'");
		$datequery->execute();

		file_put_contents($file, "after date query". " " . $date . " " . $uid ." " .  $time . "\n", FILE_APPEND);

		if($datequery->rowCount() < 1)
		{
		    // row exists. do whatever you want to do.
		    $statement3 -> execute(array(':datename' => $date));
		} 

		$dateids = $datequery->fetch(PDO::FETCH_ASSOC);
		$dateid = $dateids['DateID'];

		file_put_contents($file, "after date ids". " " . " date ids:  " . $dateid . " " . " group ids: " . $groupID . " " . $uid ." " .  $time . "\n", FILE_APPEND);

		$practicequery = $connection->query("Select * from tblPRACTICE WHERE GroupID = $groupID AND DateID = $dateid");
		file_put_contents($file, "before execution". " " . $uid ." " .  $time . "\n", FILE_APPEND);
		$practicequery->execute();

		file_put_contents($file, "execute practive query". " " . $uid ." " .  $time . "\n", FILE_APPEND);

		$practiceid = 1;

		file_put_contents($file, "after practicequery". " " . $uid ." " .  $time . "\n", FILE_APPEND);

		if($practicequery->rowCount() < 1)
		{
		    // row exists. do whatever you want to do.
		    echo "nothing exists";
		   $statement -> execute(array(':dateid' => $dateid, 
					':groupid' => $groupID, 
					':practicetypeid' => 1, 
					':starttime' => $time,
					':endtime' => ''));

		} else {
			$practiceid = 1;
			$checkTime = true;
			foreach($practicequery as $row) { 
				echo " this::: " . $row['StartTime'] . ' end: ' . $row['EndTime'];
				$starttime = $row['StartTime'];
				if ($row['EndTime'] == '00:00:00.000000') {
					echo "     inside end      ";
					$updatepractice = $connection->query("UPDATE tblPRACTICE SET EndTime = '$time' WHERE GroupID = $groupID AND DateID = $dateid AND StartTime = '$starttime'");
					$updatepractice->execute();
					$checkTime = false;
					$practiceid = $row['PracticeID'];
					$checkTime = false;
					foreach($connection->query("Select * from tblPLAYER_GROUP pg WHERE pg.GroupID = $groupID") as $row) {
						$statement2 -> execute(array(':playerid' => $row['PlayerID'], 
						':practiceid' => $practiceid));
					}
				}
				
			}
			if($checkTime) {
				echo "inside check time statement";
				  $statement -> execute(array(':dateid' => $dateid, 
					':groupid' => $groupID, 
					':practicetypeid' => 1, 
					':starttime' => $time,
					':endtime' => ''));
			}
		}

	
	// 	$db = $sql_
		
	echo($groupID);
	} 
	 
	file_put_contents($file, $inside . " " . $uid ." " .  $time . "\n", FILE_APPEND);
	?>
