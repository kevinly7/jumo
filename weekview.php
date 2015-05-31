
<?php
include ('database.php'); 
?>
<!DOCTYPE html>

<html>

    <head lang="en">
        <meta charset="UTF-8">
        <title></title>
        <!-- Compiled and minified CSS -->
  		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.96.1/css/materialize.min.css">
  		<link href="css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection"/>
        <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
 		<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    	<script type="text/javascript">
		$(function() {
		    var startDate;
		    var endDate;
		    
		    var selectCurrentWeek = function() {
		        window.setTimeout(function () {
		            $('.week-picker').find('.ui-datepicker-current-day a').addClass('ui-state-active')
		        }, 1);
		    }
		    
		    $('.week-picker').datepicker( {
		        showOtherMonths: true,
		        selectOtherMonths: true,
		        onSelect: function(dateText, inst) { 
		            var date = $(this).datepicker('getDate');
		            startDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay());
		            endDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay() + 6);
		            var dateFormat = inst.settings.dateFormat || $.datepicker._defaults.dateFormat;
		            $('#startDate').val($.datepicker.formatDate( "yy-mm-dd", startDate, inst.settings ));
		            $('#endDate').val($.datepicker.formatDate( "yy-mm-dd", endDate, inst.settings ));
		            console.log($.datepicker.formatDate( "yy-mm-dd", startDate, inst.settings ));
		            console.log($.datepicker.formatDate( "yy-mm-dd", endDate, inst.settings ))
		            
		            selectCurrentWeek();
		        },
		        beforeShowDay: function(date) {
		            var cssClass = '';
		            if(date >= startDate && date <= endDate)
		                cssClass = 'ui-datepicker-current-day';
		            return [true, cssClass];
		        },
		        onChangeMonthYear: function(year, month, inst) {
		            selectCurrentWeek();
		        }
		    });
		    
		    $('.week-picker .ui-datepicker-calendar tr').on('mousemove', function() { $(this).find('td a').addClass('ui-state-hover'); });
		    $('.week-picker .ui-datepicker-calendar tr').on('mouseleave', function() { $(this).find('td a').removeClass('ui-state-hover'); });
		});
		</script>
    </head>
    <body>
      <?php  
        session_start();
            if (!isset($_SESSION["newsession"])) {
                echo "Please log in again.";
            } else if ($_SESSION["newsession"]!="ica") {
                echo "Please log in again.";
            } else { 

    ?>
    	<!-- header -->
    	<nav class="purple darken-4">
            <div class="nav-wrapper">
                <ul class="logo">
                	<a href="sport_selection.php" class="brand-logo white-text">Jumo</a>
                </ul>
                
                <ul class="left hide-on-med-and-down menu">
          			<li class="active"><a href="weekview.php">Weekview</a></li>
            		<li><a href="violations.php">Violations</a></li>
        		</ul>

                <ul id="nav-mobile" class="right hide-on-med-and-down logout">
                    <!-- <li><a href="settings.php"><i class="mdi-action-settings"></i></a></li> -->
                    <li><a class = "logout" href="index.php">Logout</a></li>
                </ul>
            </div>
        </nav>

        <h4 class="center">Week View</h4>

    	<div class="row">
			<div class="col s3">	
				<form action = "weekview.php" method = "POST"> 
			        <h6><b>Filters</b></h6>	


			        <!-- Group Selection -->
			        <?php $groupArray = array();?>
				    <select name="groupSelect" class="browser-default">
			            <option value="" disabled selected>Please select a group</option>
		                <option>All</option>
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
		                <?php }?>
			        	?>
			        </select>
			        <br>


			        <!--  Date Picker -->


			        <div class="week-picker"></div>
				 
				    <!--<label>Week :</label> <span id="startDate"></span> - <span id="endDate"></span><br />-->
				    <input id ="startDate" style="display:none" type="date" name="startDate">
					<input id="endDate" style="display:none" type="date" name="endDate">
			        <!--<select name="monthSelect" class="browser-default">
			            <option value="" >Please select a month</option>

						<?php 
						
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
					    <option>Week 5</option> 
				    </select>-->


				    </br><!-- <input name = "formSubmit" type="submit" value="Select View"> -->
				    <button class="btn waves-effect waves-light amber accent-3 white-text" type="submit" id="submitGroup" name="formSubmit">Select View</button>
				</form>
		
				<?php  
				if(isset($_POST['formSubmit']) AND isset($_POST['groupSelect'])) 
				{ ?>
				</div>
						<div class="col s9">
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
					
					/*$monthyear = $_POST['monthSelect'];
					$pieces = explode(" ", $monthyear);
					$year = $pieces[0];
					$month3 = $pieces[1];
					$month = date('m',strtotime($month3));
					
					
					$week = $_POST['weekSelect'];*/
					$year = "";
					$month = "";
					$week = "";
					$group = $_POST['groupSelect'];
					$default = true;
					printWeek($year, $month, $week, $group, $groupArray, $default);
							
				} elseif(isset($_POST['formSubmit'])) {
					echo "<script>alert('Please select a group')</script>"; 
				} else { ?>
				</div>
				<div class="col s9">
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

					date_default_timezone_set("America/Los_Angeles");
					$year = date("Y");
					$month = date("m");

					if ($month == 1) {
						$month = 12;
					} else {
						$month -= 1;
					}
				
					
					$week = 'Week 1';
					$group = 'All';
					$default = false;
					printWeek($year, $month, $week, $group, $groupArray,$default); 
				}
			}
		?>
		<!--  Scripts-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.96.1/js/materialize.min.js"></script>
        <script src="js/materialize.js"></script>
        <script src="js/init.js"></script>
         <script src="js/logout.js"></script>
    </body>
</html>

<?php 
function week_range($date) {
  $ts = strtotime($date);
  $start = (date('w', $ts) == 0) ? $ts : strtotime('last sunday', $ts);
  return array(date('Y.m.d', $start), 
  	date('Y.m.d', strtotime('next saturday', $start)));
}


function printWeek($year, $month, $week, $group, $groupArray, $default){
	include ('database.php');
	$nextmonth = $month+1;
	if ($week == 'Week 1') {
							$week = '01';
						} else if ($week == 'Week 2') {
							$week = '08';
						} else if ($week == 'Week 3'){
							$week = '15';
						} else if ($week == 'Week 4') {
							$week = '22';
						}
						else {
							$week = '29';
						}
						$num_length = strlen((string)$month);
						if($num_length < 2) {
						// Pass
							$month = '0'.$month;
						} 
						$date = $year.$month.$week;
						$weekrange = week_range($date);
						if($default) {
							$startday = $_POST["startDate"];//$weekrange[0];
							$endday = $_POST["endDate"];//$weekrange[1];
						} else {
							$startday = $weekrange[0];
							$endday = $weekrange[1];
						}
						
						$groupDisplay = $group; 
						if ($group != 'All'){
							$groupDisplay = $groupArray[$group];
						}
						?>
						<p class = "viewTitle"> <?php echo "Checking practices from " . $groupDisplay . ' ' . $startday . ' to ' . $endday; ?> </p>
						<?php $dayCount = 0;
						$weekHours = 0;
						$weekArray = array();
						$sumArray = array();
						$groupQuery = "AND '$endday' AND (p.GroupID = $group)";

						if($group == 'All') {
							$groupQuery = '';
						}

						foreach($connection->query("Select StartTime, EndTime, PracticeTypeName, DateName, PlayerName, p.PracticeTypeID
							from tblPRACTICE p
							join tblPRACTICE_TYPE pt
							on p.PracticeTypeID = pt.PracticeTypeID
							join tblDATE d
							on p.DateID = d.DateID
							join tblPLAYER_PRACTICE pp
							on pp.PracticeID = p.PracticeID
							join tblPLAYER pl
							on pp.PlayerID = pl.PlayerID
							WHERE DATE(d.DateName) BETWEEN '$startday' AND '$endday' $groupQuery
							ORDER BY DateName ASC") as $row) { 
							$name = $row['PlayerName'];
							$timestamp = strtotime($row['DateName']);
							$dayOfWeek = date("w", $timestamp);
							$startTime = strtotime($row['StartTime']);
							$endTime = strtotime($row['EndTime']);
							$practiceTypeID = $row['PracticeTypeID'];
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
							if ($practiceTypeID == 2){
								$diffValue = 10800;
							}
							if($diffValue < 0) {
								$diffValue = $diffValue + (24*3600);
							}
							if (!array_key_exists($dayOfWeek, $sumArray[$name]) || count($sumArray[$name][$dayOfWeek]) == 0) {			
								$sumArray[$name][$dayOfWeek][0] = $diffValue;
							} else {
								$sumArray[$name][$dayOfWeek][0] += $diffValue;
							} 
						} 
						
						?>
					
						<tbody>
							<?php 
							$dayTracker = array();
							$dayTracker[0] = -1;
							$hourLimit = 72000;
							$dayLimit = 14400;
							$dayHours = array();
							$daysPracticed = 0;
							foreach ($weekArray as $key => $value) {
								$firsttime = true;
								$weekHours = 0;?>
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
												$dayDifference = $difference;
												$diffDisplay = '';
												$hours = '';
												$minutes = '';
												$seconds = '';
												if ($dayTracker[0] != -1) {
													$weekDay = $dayTracker[0];
													$dayHours[$weekDay] = $dayHours[$weekDay] + $difference; 
												}
												if($difference >= 3600){
													$hours = abs($difference/3600 %24);
													$difference = $difference - ($hours * 3600);
													$diffDisplay .= $hours . ' hrs ';
												} 
												if($difference >= 60){
													$minutes = abs($difference/60%60);
													$difference = $difference - ($minutes * 60);
													if ($difference > 30) {
														$minutes += 1;
													}
													$diffDisplay .= $minutes . ' min ';
												}
												$correctStart = date('h:i A', $startPiece);
												$endStart = date('h:i A', $endPiece);
												$practiceStart = strtotime('12:00:00 AM');
												$practiceEnd = strtotime('05:00:00 AM');
												
												if (($startPiece > $practiceStart && $startPiece < $practiceEnd) ||
													($endPiece > $practiceStart && $endPiece < $practiceEnd)) {
													echo 'Not supposed to be practicing at this time' . '</br>';
												}
												echo $correctStart . ' to ' . $endStart .'</br>';
											}
											$weekHours += $dayDifference;
											$daysPracticed = count($sumArray[$key]);
											if ($dayDifference > $dayLimit){
												echo '<font color="red">' .  $diffDisplay . '</font>' . '</br>';
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
											echo 'No Break Days' . '</br>';
										}
										if ($weekHours > $hourLimit){
											echo '<font color="red">' .sumFormat($weekHours) . '</font>';
										} else {
											echo  sumFormat($weekHours); 
										} ?>
									</td>
								</tr>
							<?php }
							?> 
						</tbody>
				</table>
				<!-- <br> -->
				<!-- <a class="waves-effect waves-light btn amber accent-3 right" href="violations.php" id="submit">Next</a> -->
			
	      	</div>
	      	
	      	<!-- <button class="btn waves-effect waves-light amber accent-3 white-text" type="submit" id="submitGroup" name="formSubmit">Next</button> -->
	    </div>
<?php }


function sumFormat($time) {
 		$timeDisplay = '';
 		$minPhrase = ' min ';
		 if($time > 3600){
		 	$hours = abs($time/3600);
		 	$hours = floor($hours);
		 	
		 	$minutes = abs($time/3600) - $hours;
		 	
			//$hours = $hours - $minutes;
			$minutes = $minutes * 60;
			if(round($minutes) < 1) {
				$timeDisplay .= $hours . ' hrs ';
			} else {
				$timeDisplay .= $hours . ' hrs ' . round($minutes) . ' min ';
			}
			//$time = $time - ($hours * 3600);
		} elseif($time >= 60){
			$minutes = abs($time/60 % 60);
			$time = $time - ($minutes * 60);
			if($time > 30){
				$minutes += 1;
			}
			$timeDisplay .= $minutes . ' min ';
		} elseif($time < 60) {
			$timeDisplay .= '0 min ';
		}
		 return $timeDisplay;
}

function timeFormat($time) {
 		$timeDisplay = '';
 		$minPhrase = ' min ';
		 if($time > 3600){
			$hours = abs($time/3600% 24);
			$hours = $hours + 2;
			$time = $time - ($hours * 3600);
			if ($hours > 24) {
				$hours = $hours -24;
			} else if ($hours > 12){
				$hours  = $hours-12;
			}

			$timeDisplay .= $hours . ':';
			$minPhrase = ' ';
		} 
		
		if($time >= 60){
			$minutes = abs($time/60 % 60);
			$time = $time - ($minutes * 60);
			if ($time > 30){
				$minutes += 1;
			}
			$timeDisplay .= $minutes . $minPhrase;
		}
		 return $timeDisplay;
}
?>