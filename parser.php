<?php  
include ('database.php');
$txt_file    = file_get_contents('timelog2.txt');
$rows        = explode("\n", $txt_file);
array_shift($rows);
$count = 0;

   $statement = $connection->prepare ("INSERT INTO tblPRACTICE (DateID, GroupID, PracticeTypeID, StartTime, EndTime) 
   	VALUES (:dateid, :groupid, :practicetypeid, :starttime, :endtime)");
    
$count = 0;
foreach($rows as $row => $data)
{

$row_data = explode(' ', $data);
$count++;

if ($count == 1) {
	$begin = $row_data[0];
} else if ($count == 2){
	$end = $row_data[0];
} else {
$statement -> execute(array(':dateid' => 1, 
	':groupid' => 1, 
	':practicetypeid' => 1, 
	':starttime' => $begin,
	':endtime' => $end)); 
	$count = 0;
}

//get row data
echo $row_data[0];
echo '<br />';


}
?>