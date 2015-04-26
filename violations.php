

<!DOCTYPE html>
<html>
    <head lang="en">
        <meta charset="UTF-8">
        <title></title>

    </head>
    <body>
	<form action = "violations.php" method = "POST">
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
			foreach ($datearray as $value) { ?>
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
	    </br><input name = "formSubmit" type="submit" value="Select View">
	 </form>



	<table style="width:80%">
	  <tr>
	  	<td>Name</td>
	    <td>Violation(s)</td>
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
			WHERE DATE(d.DateName) BETWEEN '$startday' AND '$endday'
			ORDER BY DateName ASC") as $row) { 


			$name = $row['PlayerName'];

			$timestamp = strtotime($row['DateName']);
			$dayOfWeek = date("w", $timestamp);
			$startTime = strtotime($row['StartTime']);
			$endTime = strtotime($row['EndTime']);


			if(!array_key_exists($name, $weekArray)){
				$weekArray[$name][$dayOfWeek . ' ' . $row['DateName']] = array();
			} 


			if(!array_key_exists($name, $sumArray)){
				$sumArray[$name][$dayOfWeek . ' ' . $row['DateName']] = array();
			} 

			if (!array_key_exists($dayOfWeek, $weekArray[$name])) {
				$dayInput = $startTime . ' ' . $endTime;
				$weekArray[$name][$dayOfWeek . ' ' . $row['DateName']][0] = $dayInput;

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
		    $hourLimit = 72000;
		    $dayLimit = 14400;
		    $dayHours = array();
		    $daysPracticed = 0; 
		    $dayTracker = array();
		    $dayTracker[0] = -1;

		    foreach ($weekArray as $key => $value) { ?>
				<tr>
					<td><?php echo $key ?></td>
					
					<td>
		    	<?php 
		    		foreach ($value as $dayK => $timesArray) {   
		    			$dayPieces = explode(" ", $dayK);
						$dayKey = $dayPieces[0];
						$dateKey = $dayPieces[1];
						?>
		    			
		    			<?php  
		    				foreach ($timesArray as $timeKey => $timeValue) {
		    					$timePieces = explode(' ', $timeValue);
		    					$startPiece = $timePieces[0];
		    					$endPiece = $timePieces[1];
		    					$difference = $sumArray[$key][$dayKey][0];

		    					$dayTracker[0] = $dayKey;
								if($dayTracker[0] != -1) {
									if(!array_key_exists($dayTracker[0], $dayHours)){
										$dayHours[$dayTracker[0]] = 0;
									} 
								}
								
								if ($dayTracker[0] != -1) {
									$weekDay = $dayTracker[0];
									$dayHours[$weekDay] = $dayHours[$weekDay] + $difference; 
								}

								$correctStart = date('h:i:s A', $startPiece);
								$endStart = date('h:i:s A', $endPiece);
								$practiceStart = strtotime('12:00:00 AM');
								$practiceEnd = strtotime('05:00:00 AM');
								
								if (($startPiece > $practiceStart && $startPiece < $practiceEnd) ||
									($endPiece > $practiceStart && $endPiece < $practiceEnd)) {
									echo 'Not supposed to be practicing at the time ' . $correctStart . ' to ' . $endStart . ' on ' . $dateKey .'</br>';
								}
		    				}
		    				$weekHours += $difference;
		    				$daysPracticed = count($sumArray[$key]);
		    				if ($difference > $dayLimit){ 
		    				 echo 'Over 4 hours on ' . $dateKey . '</br>';
		    				} 
		    			 ?> 
		    			 
		    		<?php }
		    	?>

		    	<?php 
		    		if ($daysPracticed > 3) { 

					   echo 'No Break Days this week' . '</br>';
		    		}

		    		if ($weekHours > $hourLimit){ 
		    			echo 'Over the 20 hour weekly limit' ;
		    		} 
		    		 ?> 

		    	
				</td>
		    	</tr>
		    <?php }?> 
		  
				</table>

<?php }

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




?>