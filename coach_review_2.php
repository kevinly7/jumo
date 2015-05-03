<!DOCTYPE html>
<html>
    <head lang="en">
        <meta charset="UTF-8">
        <title></title>

        <!-- Compiled and minified CSS -->
  		<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.96.1/css/materialize.min.css">
  		<link href="css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection"/>
        <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>-->
    </head>
    <body>
    	<!-- header -->
        <nav class="purple darken-4">
            <div class="nav-wrapper">
                <a href="weekview.php" class="brand-logo white-text">Jumo</a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                    <li><a href="settings.php"><i class="mdi-action-settings"></i></a></li>
                    <li><a href="index.php">Logout</a></li>
                </ul>
            </div>
        </nav>

        <div class="row">
        	<div class="col s3">
				<form action = "" method = "POST">
					<br>
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
					            <span>
					                <?php 
					                	echo  $year1 . ' ' . $monthName;
					                ?>
					            </span>
					            </br>
					        </option>
						<?php }?>
					</select>

				 	<select name="weekSelect" class="browser-default">
					 	<option value="" >Please select a week</option>
					    <option>1</option> 
					    <option>2</option> 
					    <option>3</option> 
					    <option>4</option> 
				    </select>
				    <?php $groupArray = array();?>

				    <select name="groupSelect" class="browser-default">
			            <option value="" >Please select a group</option>
			            <!--<option>All</option>-->
						<?php 

				      	foreach($connection->query("Select * from tblGROUP") as $row) {?>
				            <option value = <?php echo $row['GroupID'] ?>>
					            <span>
				                    <?php 
				                    	$groupArray[$row['GroupID']] = $row['GroupName'];
				                        echo $row['GroupName'];
				                    ?>
					            </span>
					            </br>
				            </option>
				        <?php }?>?>
			        </select>

				    </br>
				    <button class="btn waves-effect waves-light amber accent-3 white-text" type="submit" id="submitGroup" name="formSubmit">Select View</button>
				</form>
			</div>

			<div class="col s9">
				<form action="coach_review_update.php" method="POST">
					<table class="bordered striped">
					  	<thead>
							<tr>
								<th data-field="name">Name</th>
				              	<th data-field="sun">Sunday</th>
				              	<th data-field="mon">Monday</th>
				              	<th data-field="tue">Tuesday</th>
				              	<th data-field="wed">Wednesday</th>
				              	<th data-field="thu">Thursday</th>
				              	<th data-field="fri">Friday</th>
				              	<th data-field="sat">Saturday</th>
				              	<th data-field="tot">Total Hours</th>
							</tr>
						</thead>

					    <?php  
						
						include ('database.php');

						if(isset($_POST['formSubmit'])) {

							$monthyear = $_POST['monthSelect'];
							$pieces = explode(" ", $monthyear);
							$year = $pieces[0];
							$month3 = $pieces[1];
							$month = date('m',strtotime($month3));
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
							$endday = $weekrange[1];?>
							<p class = "viewTitle"> <?php echo "Checking practices from " . $groupArray[$group] . ' ' . $startday . ' to ' . $endday; ?> </p>

							<?php $dayCount = 0;
							$weekHours = 0;
							$weekArray = array();
							$sumArray = array();
							//$groupQuery = "AND '$endday' AND (p.GroupID = $group)";
							$practiceCounter = 0;
							if($group == 'All') {
								$groupQuery = '';
							}

							foreach($connection->query("Select p.DateID, p.GroupID, pl.PlayerID, p.PracticeID, p.StartTime, EndTime, PracticeTypeName, DateName, PlayerName
								from tblPRACTICE p
								join tblPRACTICE_TYPE pt
								on p.PracticeTypeID = pt.PracticeTypeID
								join tblDATE d
								on p.DateID = d.DateID
								join tblPLAYER_PRACTICE pp
								on pp.PracticeID = p.PracticeID
								join tblPLAYER pl
								on pp.PlayerID = pl.PlayerID
								WHERE DATE(d.DateName) BETWEEN '$startday' AND '$endday' AND p.GroupID = $group
								ORDER BY DateName ASC") as $row) { 

								$timestamp = strtotime($row['DateName']);
								$dayOfWeek = date("w", $timestamp);
								$startTime = strtotime($row['StartTime']);
								$endTime = strtotime($row['EndTime']);
								$difference = $endTime - $startTime;
								$weekHours += $difference;
								$diffDisplay = '';
								$hours = '';
								$minutes = '';
								$seconds = '';
								$name = $row['PlayerName'];
								$practiceID = $row['PracticeID'];
								$playerID = $row['PlayerID'];
								$dateID = $row['DateID'];
								$groupID = $row['GroupID'];
								$practiceCounter++;

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


								if(!array_key_exists($name, $weekArray)){
									$weekArray[$name][$dayOfWeek] = array();
								} 

								if (!array_key_exists($dayOfWeek, $weekArray[$name])) {
									$dayInput = 
									'<input type="hidden" name=groupID'.$practiceCounter.' value='. $groupID.'>
									<input type="hidden" name=dateID'.$practiceCounter.' value='.$dateID.'>
									<input type="hidden" name=playerID'.$practiceCounter.' value='.$playerID.'>
									<input type="hidden" name=practiceID'.$practiceCounter.' value='.$practiceID.'>'.
									'<input type="checkbox" class="filled-in browser-default" name=edit'.$practiceCounter.' onclick = "handleClick(this)" value='.$practiceCounter.'>Edit</br>'.
									'<input type="checkbox" class="filled-in browser-default" name=delete'.$practiceCounter.' value="delete">Delete</br>'.
									'<input type = "time" class='.$practiceCounter.' disabled = "true" name=startTime'.$practiceCounter.' value=' . timeFormat($startTime) . '> to <input type="time" disabled = "true" class='.$practiceCounter.' name=endTime'.$practiceCounter.' value=' . timeFormat($endTime) . '> </br>';
									$weekArray[$name][$dayOfWeek][0] = $dayInput;

								} else {
									$size = sizeof($weekArray[$name][$dayOfWeek]);
									$weekArray[$name][$dayOfWeek][$size] =
									'<input type="hidden" name=groupID'.$practiceCounter.' value='. $groupID.'>
									<input type="hidden" name=dateID'.$practiceCounter.' value='.$dateID.'>
									<input type="hidden" name=playerID'.$practiceCounter.' value='.$playerID.'>
									<input type="hidden" name=practiceID'.$practiceCounter.' value='.$practiceID.'>'.
									'<input type="checkbox" class="filled-in browser-default" name=edit'.$practiceCounter.' onclick = "handleClick(this)" value='.$practiceCounter.'>Edit</br>'.
									'<input type="checkbox" class="filled-in browser-default" name=delete'.$practiceCounter.' value="edit">Delete</br>'.
									'<input type = "time" class='.$practiceCounter.' disabled = "true" name=startTime'.$practiceCounter.' value=' . timeFormat($startTime) . '> to <input type="time" disabled ="true" class='.$practiceCounter.' name=endTime'.$practiceCounter.' value=' . timeFormat($endTime) . '> </br>';
								} 

					 		} ?><?php 
					 
						    $dayTracker = array();
						    $dayTracker[0] = -1;
						    $hourLimit = 72000;
						    $dayLimit = 14400;
					 
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
						    			}?>
						    			
						    			<?php
						    			if($dayTracker[0] != -1 && ($dayKey - $dayTracker[0]) > 1) {
						    				for ($j= 0; $j < ($dayKey-$dayTracker[0])-1; $j++) { ?>
						    					<td>No Practice</td>
						    				<?php }
						    			}

										$dayTracker[0] = $dayKey;
										?>
						    			<td>
							    			<?php 
						    				foreach ($timesArray as $timeKey => $timeValue) {
						    					echo $timeValue . '</br>';
						    				}?> 
						    			</td> 

						    		<?php }

						    		if($dayTracker[0] != -1 && (7 - $dayTracker[0]) > 1) {
					    				for ($j= 0; $j < (7-$dayTracker[0])-1; $j++) { ?>
					    					<td>No Practice</td>
						    			<?php }
						    		}?>

							    	<td><?php 
							    		if ($weekHours > $hourLimit){
										echo '<font color="red">' .timeFormat($weekHours) . '</font>';
							    		} else {
							    		echo  timeFormat($weekHours); 
							    		} ?>

							    	</td>
						    	</tr>
					    	<?php }?> 
					</table>
					<br>
					<input type="hidden" name="length" value=<?php echo $practiceCounter ?>>
					<!-- <input type="submit" name = "formSubmit" value = "Submit"> -->
					<button class="btn waves-effect waves-light amber accent-3 white-text right" type="submit" id="submitGroup" name="formSubmit">Submit</button>
				</form>
				<?php 
				//echo var_dump($weekArray); 
				}?>
			</div>
		</div>

		<!--  Scripts-->
        <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.96.1/js/materialize.min.js"></script>
        <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script src="js/materialize.js"></script>
        <script src="js/init.js"></script>-->
        <script>
        	function handleClick(cb) {
        		var id = cb.value;
        		var timeInput = document.getElementsByClassName(id);
        		var i;
				for (i = 0; i < timeInput.length; i++) {
    				timeInput[i].disabled = !timeInput[i].disabled;
    				//alert(timeInput[i].disabled);
    			}
			}
        </script>
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
		 if($time > 3600){

			$hours = abs($time/3600% 24);
			$hours = $hours + 2;
			//echo $hours." ";
			$time = $time - ($hours * 3600);
			if ($hours > 23) {
				$hours = $hours -24;
			}
			if ($hours < 10){
				$hours  = "0" . $hours;
			}

			$timeDisplay .= $hours . ':';
		} 
		
		if($time >= 60){
			$minutes = abs($time/60 % 60);
			$time = $time - ($minutes * 60);
			$timeDisplay .= $minutes . '';
		}

		if ($time <60) {
		 	$seconds = $time;
		 	$timeDisplay .= $seconds . ' s ';
		 }
		 return $timeDisplay;
}
?>