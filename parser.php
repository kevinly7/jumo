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
foreach($rows as $row => $data)
{

$day = $row_data[1];
$month = $row_data[2];
$year = $row_data[3];
$num_length = strlen((string)$month);
$first = $row_data[4];
if ($num_length < 2){
	$month = '0'.$month;
}

if ($first = 0) {
	$first = '';
}

$row_data = explode(' ', $data);
$date = $day.$month.$year;
$groupID = $first . $row_data[5]. $row_data[6] . $row_data[7];
$count++;

if ($count == 1) {
	$begin = $row_data[0];
} else if ($count == 2){
	$end = $row_data[0];
} else {
	$count = 0;
	$statement -> execute(array(':dateid' => 1, 
	':groupid' => $groupID, 
	':practicetypeid' => 1, 
	':starttime' => $begin,
	':endtime' => $end));



	$practiceid = $connection->query("Select PracticeID from tblPractice p WHERE p.GroupID = $groupID AND p.StartTime = $begin");
	foreach($connection->query("Select * from tblPLAYER_GROUP p WHERE p.GroupID = $groupID") as $row) {
		$statement2 -> execute(array(':playerid' => $row['PlayerID'], 
	':practiceid' => $practiceID;

	}
}

//get row data
echo $row_data[0];
echo '<br />';
echo $date;
echo '<br />';
echo $groupID;
echo '<br />';
echo '<br />';



}
?>