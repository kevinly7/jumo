<?php  
include ('database.php');
$practiceID = $_GET['practiceID'];
$startTime = $_GET['startTime'];
$endTime = $_GET['endTime'];
$statement = $connection->prepare ("UPDATE tblPRACTICE SET startTime = :startTime, endTime = :endTime WHERE PracticeID = :practiceID");
$statement -> execute(array(':practiceID' =>$practiceID, ':startTime' => $startTime, ':endTime' => $endTime));
?>
