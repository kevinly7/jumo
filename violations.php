<!DOCTYPE html>
<html>
    <head lang="en">
        <meta charset="UTF-8">
        <title></title>
        <!-- Compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.96.1/css/materialize.min.css">
        <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    </head>
    <body>
    	<!-- header -->
        <nav class="purple darken-4">
            <div class="nav-wrapper container">
                <a href="weekview.php" class="brand-logo white-text">Jumo</a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                    <li><a href="settings.php"><i class="mdi-action-settings"></i></a></li>
                    <li><a href="index.html">Logout</a></li>
                </ul>
            </div>
        </nav>
		
		<h4 class="center">Select a week and a month to review</h4>

		<div class="row">
			<div class="col s3">
				<form action = "violations.php" method = "POST">
			        <!-- <br> -->
			        <h6><b>Filters</b></h6>	
			        <br>			        
			        <select name="monthSelect" class="browser-default">
			            <option value="" >Please select a month</option>

						<?php 
						include ('database.php');
						$datearray = array();
						foreach($connection->query("SELECT YEAR(dateName) AS 'year', MONTH(dateName) AS 'month' FROM tblDATE") as $row) {
							if ($row['year'] != '0' && strlen($row['year']) > 0) { 
						 		$datearray[$row['year'].$row['month']] = $row['year'] . ' ' . $row['month'];
							}
						}
							foreach ($datearray as $value) {
							$mpieces = explode(" ", $value);
							$year1 = $mpieces[0];
							$month2 = $mpieces[1];
							$dateObj   = DateTime::createFromFormat('!m', $month2);
							$monthName = $dateObj->format('F');
							?>
						    <option>
					            <span >
					                <?php 
					                	echo  $year1 . ' ' . $monthName;
					                ?>
					            </span>
					            </br>
					        </option>				 
					    <?php }
						?>
					</select>    

				 	<select name="weekSelect" class="browser-default">
					 	<option value="" disabled selected>Please select a week</option>
					    <option>Week 1</option> 
					    <option>Week 2</option> 
					    <option>Week 3</option> 
					    <option>Week 4</option> 
				    </select>

				    </br>
				    <!-- <input name = "formSubmit" type="submit" value="Select View"> -->
				    <button class="btn waves-effect waves-light amber accent-3 white-text" type="submit" id="formSubmit" name="formSubmit">Select View</button>
				</form>

				<?php  
				include ('database.php');

				if(isset($_POST['formSubmit'])) 
				{ ?>
			</div>

			<div class="col s9">
				<table class="bordered striped">
					<thead>
						<tr>
							<th data-field="name">Name</th>
						    <th data-field="violation">Violation(s)</th>
					  	</tr>	
					</thead>
				  	
				    <?php  
					include ('database.php');

					if(isset($_POST['formSubmit'])) 
					{

						$monthyear = $_POST['monthSelect'];
						$pieces = explode(" ", $monthyear);
						$year = $pieces[0];
						$month3 = $pieces[1];
						$month = date('m',strtotime($month3));
						$nextmonth = $month+1;
						$week = $_POST['weekSelect'];

						if ($week == 'Week 1') {
							$week = '01';
						} else if ($week == 'Week 2') {
							$week = '08';
						} else if ($week == 'Week 3'){
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
							?>
						<p class = "viewTitle"> <?php echo "Checking violations from " . $startday . ' to ' . $endday; ?> </p>
<?php
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

					    foreach ($weekArray as $key => $value) { $weekhours = 0;?>

					    	<tbody>
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
						    </tbody>
					    <?php }?>   
				</table>
				<?php }
				?>
			</div>
		</div>
		<?php 
		}?>
		<!-- Compiled and minified JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.96.1/js/materialize.min.js"></script>
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