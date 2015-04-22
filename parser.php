<?php  
include ('database.php');
$txt_file    = file_get_contents('timelog2.txt');
$rows        = explode("\n", $txt_file);
array_shift($rows);
$count = 0;
   $statement = $connection->prepare ("INSERT INTO tblPRACTICE (DateID, GroupID, PracticeTypeID, StartTime, EndTime) 
   	VALUES (:dateid, :groupid, :practicetypeid, :starttime, :endtime)");
    $statement2 = $connection->prepare ("INSERT INTO tblPLAYER_PRACTICE (PlayerID, PracticeID) 
   	VALUES (:playerid, :practiceid)");
$count = 0;
$practiceArray = array();
foreach($rows as $row => $data)
{
	$day = $row_data[1];
	$month = $row_data[2];
	$year = $row_data[3];
	$num_length = strlen((string)$month);
	if ($num_length < 2){
		$month = '0'.$month;
	}

	$row_data = explode(' ', $data);
	$date = $day.$month.$year;

	$groupID = $row_data[4] . $row_data[5]. $row_data[6] . $row_data[7];
	
	if (!array_key_exists($groupID, $practiceArray)) {
		$practiceArray[$groupID][0] = $row_data[0];

	} else {
		$size = sizeof($practiceArray[$groupID]);
		$practiceArray[$groupID][$size] = $row_data[0];
		
	
	if ($size % 2 == 1 ) {
		$begin = $practiceArray[$groupID][$size-1];
		$end = $practiceArray[$groupID][$size];
		echo $groupID . '</br>';
		echo $begin . '</br>';
		echo $end . '</br>' . '</br>';
		
		$statement -> execute(array(':dateid' => 1, 
		':groupid' => $groupID, 
		':practicetypeid' => 1, 
		':starttime' => $begin,
		':endtime' => $end));

		$query = $connection->query("Select PracticeID from tblPRACTICE WHERE GroupID = $groupID AND StartTime = '$begin'");
		$practiceid = $query->fetch(PDO::FETCH_ASSOC);


		foreach($connection->query("Select * from tblPLAYER_GROUP pg WHERE pg.GroupID = $groupID") as $row) {
			$statement2 -> execute(array(':playerid' => $row['PlayerID'], 
		':practiceid' => $practiceid['PracticeID']));

		}

	} 
		
	
	
	}
}
echo var_dump($practiceArray);

	/*$statement -> execute(array(':dateid' => 1, 
		':groupid' => $groupID, 
		':practicetypeid' => 1, 
		':starttime' => $begin,
		':endtime' => $end));

		$practiceid = $connection->query("Select PracticeID from tblPractice p WHERE p.GroupID = $groupID AND p.StartTime = $begin");
		foreach($connection->query("Select * from tblPLAYER_GROUP p WHERE p.GroupID = $groupID") as $row) {
			$statement2 -> execute(array(':playerid' => $row['PlayerID'], 
		':practiceid' => $practiceID));

		} */
?>