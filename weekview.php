

<!DOCTYPE html>
<html>
    <head lang="en">
        <meta charset="UTF-8">
        <title></title>

    </head>
    <body>
	<form action = "weekview.php" method = "POST">
        <h2>Enter name of subgroup: </h2>
        <select name="monthSelect">
            <option></option>

			<?php 
			include ('database.php');
			 $datearray = array();
			    foreach($connection->query("SELECT YEAR(dateName) AS 'year', MONTH(dateName) AS 'month' FROM tblDATE") as $row) {
			 if ($row['year'] != '0' && strlen($row['year']) > 0) { 

			 	$datearray[$row['year'].$row['month']] = $row['year'] . ' ' . $row['month'];
			}
			}
			foreach ($datearray as $value) {

			 	?>
			        <option>
			            <span>
			                <?php 
			                	echo  $value;
			                ?>
			            </span>
			            </br>
			        </option>
			 
			    <?php }

				?>

		 </select>
	        

	 	<select name="weekSelect">
		 	 <option></option> </br>
		     <option>1</option> </br>
		      <option>2</option> </br>
		      <option>3</option> </br>
		      <option>4</option> </br>

	    </select>


	    <select name="groupSelect">
                    <option></option>

<?php 

      foreach($connection->query("Select * from tblGROUP") as $row) {?>

           <option value = <?php echo $row['GroupID'] ?>>
                <span>
                    <?php 
                        echo $row['GroupName'];
 
                    ?>
                </span>
                       </br>
                      </option>
 
                     <?php }?>
        ?>

                </select>



	    </br><input name = "formSubmit" type="submit" value="Select View">
	 </form>



<table style="width:80%">
  <tr>
  	<td>Name</td>
    <td>Sunday</td>
    <td>Monday</td> 
    <td>Tuesday</td>
    <td>Wednesday</td>
    <td>Thursday</td>
    <td>Friday</td>
    <td>Saturday</td>
    <td>Total Time</td>
  </tr>



       <?php  
include ('database.php');

if(isset($_POST['formSubmit'])) 
{

$monthyear = $_POST['monthSelect'];
$pieces = explode(" ", $monthyear);
$year = $pieces[0];
$month = $pieces[1];
$nextmonth = $month+1;
$week = $_POST['weekSelect'];
$group = $_POST['groupSelect'];

if ($week == 1) {
	$week = '01';
} else if ($week == 2) {
	$week = '08';
} else if ($week == 3){
	$week = '15';
} else {
	$week = '22';
}

$num_length = strlen((string)$month);
if($num_length < 2) {
    // Pass
    $month = '0'.$month;
} 


$date = $year.$month.$week;
$weekrange = week_range($date);
$startday = $weekrange[0];
$endday = $weekrange[1];
$dayCount = 0;
$weekHours = 0;
$weekArray = array();
$sumArray = array();

	foreach($connection->query("Select StartTime, EndTime, PracticeTypeName, DateName, PlayerName
		from tblPRACTICE p
		join tblPRACTICE_TYPE pt
		on p.PracticeTypeID = pt.PracticeTypeID
		join tblDATE d
		on p.DateID = d.DateID
		join tblPLAYER_PRACTICE pp
		on pp.PracticeID = p.PracticeID
		join tblPLAYER pl
		on pp.PlayerID = pl.PlayerID
		WHERE DATE(d.DateName) BETWEEN '$startday' AND '$endday' AND (p.GroupID = $group)
		ORDER BY DateName ASC") as $row) { 


		$name = $row['PlayerName'];

		$timestamp = strtotime($row['DateName']);
		$dayOfWeek = date("w", $timestamp);
		$startTime = strtotime($row['StartTime']);
		$endTime = strtotime($row['EndTime']);


		if(!array_key_exists($name, $weekArray)){
			$weekArray[$name][$dayOfWeek] = array();
		} 


		if(!array_key_exists($name, $sumArray)){
			$sumArray[$name][$dayOfWeek] = array();
		} 

		if (!array_key_exists($dayOfWeek, $weekArray[$name])) {
			$dayInput = $startTime . ' ' . $endTime;
			$weekArray[$name][$dayOfWeek][0] = $dayInput;

		} else {
			$size = sizeof($weekArray[$name][$dayOfWeek]);
			$weekArray[$name][$dayOfWeek][$size] = $startTime . ' ' . $endTime;
		} 

		$diffValue = $endTime - $startTime;
		if (!array_key_exists($dayOfWeek, $sumArray[$name]) || count($sumArray[$name][$dayOfWeek]) == 0) {			
			$sumArray[$name][$dayOfWeek][0] = $diffValue;
		} else {

			$sumArray[$name][$dayOfWeek][0] += $diffValue;
		} 

 } ?>
    <?php 
    $dayTracker = array();
    $dayTracker[0] = -1;
    $hourLimit = 72000;
    $dayLimit = 14400;
    $dayHours = array();
    $daysPracticed = 0;

    foreach ($weekArray as $key => $value) {
    	$firsttime = true;?>
		<tr>
    	<td><?php echo $key ?></td>
    	<?php 
    		foreach ($value as $dayKey => $timesArray) { 
    			
    			if ($firsttime == true) {
    				for ($f = 0; $f < ($dayKey); $f++) { ?>
    				<td>No Practice</td>
    			<?php }
    			$firsttime = false; 
    			}
    			
    			?>
    			
    			<?php
    			if($dayTracker[0] != -1 && ($dayKey - $dayTracker[0]) > 1) {
    				for ($j= 0; $j < ($dayKey-$dayTracker[0])-1; $j++) { ?>
    					<td>No Practice</td>

    			<?php }

    			}
					$dayTracker[0] = $dayKey;
					if($dayTracker[0] != -1) {
						if(!array_key_exists($dayTracker[0], $dayHours)){
							$dayHours[$dayTracker[0]] = 0;
						} 
					}
					
				?>
    			<td>
    			<?php 
    				foreach ($timesArray as $timeKey => $timeValue) {
    					$timePieces = explode(' ', $timeValue);
    					$startPiece = $timePieces[0];
    					$endPiece = $timePieces[1];


    					$difference = $sumArray[$key][$dayKey][0];
						
						$diffDisplay = '';
						$hours = '';
						$minutes = '';
						$seconds = '';
						
						if ($dayTracker[0] != -1) {
							$weekDay = $dayTracker[0];

							$dayHours[$weekDay] = $dayHours[$weekDay] + $difference; 

						}

						 if($difference > 3600){

							$hours = abs($difference/3600 %24);
							$difference = $difference - ($hours * 3600);
							$diffDisplay .= $hours . ' hrs ';
						} 
						
						if($difference >= 60){
							$minutes = abs($difference/60%60);
							$difference = $difference - ($minutes * 60);
							$diffDisplay .= $minutes . ' min ';
						}

						if ($difference <60) {
						 	$seconds = $difference;
						 	$diffDisplay .= $seconds . ' s ';
						 } 	

						 if ($startPiece < 18000 || $endPiece < 18000) {
						 	echo 'Violation: Not supposed to be practicing at this time' . '</br>';
						 }

    					echo timeFormat($startPiece) . ' to ' . timeFormat($endPiece) .'</br>';
    				}
    				$weekHours += $difference;
    				$daysPracticed = count($sumArray[$key]);
    				if ($difference > $dayLimit){
    					echo '<font color="red">' . $diffDisplay . '</font>' . '</br>';
    				} else {
    					echo $diffDisplay . '</br>';
    				}
    			?> 
    			</td> 

    		<?php }

    		if($dayTracker[0] != -1 && (7 - $dayTracker[0]) > 1) {
    				for ($j= 0; $j < (7-$dayTracker[0])-1; $j++) { ?>
    					<td>No Practice</td>
    			<?php }
    		}
    	?>

    	<td><?php 
    		if ($daysPracticed > 3) {
    			echo 'Violaion: No Break Days' . '</br>';
    		}

    		if ($weekHours > $hourLimit){
				echo '<font color="red">' .timeFormat($weekHours) . '</font>';
    		} else {
    			echo  timeFormat($weekHours); 
    		} ?>

    	</td>

    	</tr>
    <?php }?> 
  
		</table>


	<?php 
	echo var_dump($sumArray);
	echo var_dump($dayHours); 
	echo var_dump($weekArray); 
	}

?>
    </body>
</html>



<?php 
function week_range($date) {
  $ts = strtotime($date);
  $start = (date('w', $ts) == 0) ? $ts : strtotime('last sunday', $ts);
  return array(date('Y.m.d', $start), 
  	date('Y.m.d', strtotime('next saturday', $start)));
}



function timeFormat($time) {
 		$timeDisplay = '';
 		$minPhrase = ' min ';
		 if($time > 3600){

			$hours = abs($time/3600% 24);
			$time = $time - ($hours * 3600);

			if ($hours > 12){
				$hours  = $hours-12;
			}

			$timeDisplay .= $hours + 2 . ':';
			$minPhrase = ' ';
		} 
		
		if($time >= 60){
			$minutes = abs($time/60 % 60);
			$time = $time - ($minutes * 60);
			$timeDisplay .= $minutes . $minPhrase;
		}

		if ($time <60) {
		 	$seconds = $time;
		 	$timeDisplay .= $seconds . ' s ';
		 }
		 return $timeDisplay;
}
?>