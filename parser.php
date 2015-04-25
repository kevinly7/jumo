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
   	$statement3 = $connection->prepare ("INSERT INTO tblDATE (DateName) 
   	VALUES (:datename)");
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

	$groupID = $row_data[4] . $row_data[5]. $row_data[6] . $row_data[7];
	
	if (!array_key_exists($groupID, $practiceArray)) {
		$practiceArray[$groupID][0] = $row_data[0];

	} else {
		$size = sizeof($practiceArray[$groupID]);
		$practiceArray[$groupID][$size] = $row_data[0];
		
	
	if ($size % 2 == 1 ) {
		$begin = $practiceArray[$groupID][$size-1];
		$end = $practiceArray[$groupID][$size];


		$practicequery = $connection->query("Select PracticeID from tblPRACTICE WHERE GroupID = $groupID AND DateID = $dateid AND StartTime = '$begin' ");
		$practicequery->execute();

		if($practicequery->rowCount() < 1)
		{
		    // row exists. do whatever you want to do.
		  	
			$statement -> execute(array(':dateid' => $dateid, 
			':groupid' => $groupID, 
			':practicetypeid' => 1, 
			':starttime' => $begin,
			':endtime' => $end));

			$query = $connection->query("Select PracticeID from tblPRACTICE WHERE GroupID = $groupID AND DateID = $dateid AND StartTime = '$begin' ");
			$practiceid = $query->fetch(PDO::FETCH_ASSOC);


			foreach($connection->query("Select * from tblPLAYER_GROUP pg WHERE pg.GroupID = $groupID") as $row) {
				$statement2 -> execute(array(':playerid' => $row['PlayerID'], 
				':practiceid' => $practiceid['PracticeID']));

			}

			echo var_dump($practiceArray);

		} 

	} 
		
	
	
	}
}
echo var_dump($practiceArray);
?>