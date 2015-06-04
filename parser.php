<?php  
include ('database.php');
$txt_file    = file_get_contents('timelog3.txt');
$rows        = explode("\n", $txt_file);
array_shift($rows);
$count = 0;
   $statement = $connection->prepare ("INSERT INTO tblPRACTICE (DateID, GroupID, PracticeTypeID, StartTime, EndTime) 
   	VALUES (:dateid, :groupid, :practicetypeid, :starttime, :endtime)");
    $statement2 = $connection->prepare ("INSERT INTO tblPLAYER_PRACTICE (PlayerID, PracticeID) 
   	VALUES (:playerid, :practiceid)");
   	$statement3 = $connection->prepare ("INSERT INTO tblDATE (DateName) 
   	VALUES (:datename)");
	//Check for practice in database
	$statement4 = $connection->prepare ("SELECT PracticeID FROM tblPRACTICE WHERE GroupID = :groupid and DateID = :dateid and StartTime = :starttime");
$count = 0;
$practiceArray = array();
foreach($rows as $row => $data)
{
	$row_data = explode(' ', $data);

	$day = $row_data[1];
	$month = $row_data[2];
	$year = $row_data[3];
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

	$groupID = $row_data[4];
	
	if (!array_key_exists($groupID, $practiceArray)) {
		$practiceArray[$groupID][0] = $row_data[0];

	} else {
		$size = sizeof($practiceArray[$groupID]);
		$practiceArray[$groupID][$size] = $row_data[0];
		
	
		if ($size % 2 == 1 ) {
			$begin = $practiceArray[$groupID][$size-1];
			$end = $practiceArray[$groupID][$size];


			//$practicequery = $connection->query("Select PracticeID from tblPRACTICE WHERE GroupID = $groupID AND DateID = $dateid AND StartTime = '$begin' ");
			$statement4->execute(array('groupid' => $groupID, 'dateid' => $dateid, 'starttime' => $begin));
			$rowNumber = $statement4->fetch(PDO::FETCH_NUM);
			//$practicequery = $statement4->fetchAll();
			//$practicequery->execute();

			if($rowNumber[0] < 1)
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