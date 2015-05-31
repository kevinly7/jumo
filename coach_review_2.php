<!DOCTYPE html>
<html>
    <head lang="en">
        <meta charset="UTF-8">
        <title></title>

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
        <!-- Compiled and minified CSS -->
  		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.96.1/css/materialize.min.css">
  		<link href="css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection"/>
        <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    </head>
    <body>
  
   	<?php  
   	session_start();
		if (!isset($_SESSION["newsession"])) {
			echo "Please log in again.";
		} else if ($_SESSION["newsession"]!="coach") {
			echo "Please log in again.";
		} else { 

   	?>

    	<!-- header -->
        <ul id="dropdown1" class="dropdown-content">
            <li><a class="purple-text text-darken-4" href="settings.php">Create Groups</a></li>
            <li class="divider"></li>
            <li><a class="purple-text text-darken-4" href="edit_students.php">Edit Groups</a></li>
        </ul>

        <nav class="purple darken-4">
            <div class="nav-wrapper">
                <ul class="logo">
                    <a href="coach_review_2.php" class="brand-logo white-text">Jumo</a>
                </ul>

                <ul id="nav-mobile" class="right hide-on-med-and-down logout">
                    <!-- <li><a href="settings.php"><i class="mdi-action-settings"></i></a></li> -->

                    <!-- Dropdown Trigger -->
                    <li><a class="dropdown-button" href="#" data-activates="dropdown1">Settings<i class="mdi-navigation-arrow-drop-down right"></i></a></li>
                    <li><a class = "logout" href="index.php">Logout</a></li>
                </ul>
            </div>
        </nav>

        <div class="row">
        	<div class="col s3">
				<form action = "" method = "POST">
					<br>
			        <h6><b>Filters</b></h6>
			        <?php $groupArray = array();
			        include ('database.php');?>

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
			        <br>
			        <div class="week-picker"></div>
				    <br /><br />
			        <!--<select name="monthSelect" class="browser-default">
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
					</select>-->

				 	<!--<select name="weekSelect" class="browser-default">
					 	<option value="" >Please select a week</option>
					    <option>1</option> 
					    <option>2</option> 
					    <option>3</option> 
					    <option>4</option> 
				    </select>-->
				    
				    <input id ="startDate" type="date" name="startDate" style="display:none">
					<input id="endDate" type="date" name="endDate" style="display:none">
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

							/*$monthyear = $_POST['monthSelect'];
							$pieces = explode(" ", $monthyear);
							$year = $pieces[0];
							$month3 = $pieces[1];
							$month = date('m',strtotime($month3));
							$nextmonth = $month+1;
							$week = $_POST['weekSelect'];*/
							$group = $_POST['groupSelect'];

							/*if ($week == 1) {
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
							$endday = $weekrange[1];*/
							$startday = $_POST['startDate'];
							$endday = $_POST['endDate'];
							?>
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
									'<input type="checkbox" class="filled-in browser-default"  name=edit'.$practiceCounter.' value='.$practiceCounter.'>'.
									'<input type="checkbox"  class="filled-in browser-default" name=delete'.$practiceCounter.' value="delete">'.
									'<button type="button"  value='.$practiceCounter.' class="btn" onclick="markDelete(this)">Delete</button></br>'.
									'<input type = "time" class='.$practiceCounter.' onchange="selectEdit(this)" name=startTime'.$practiceCounter.' value=' . timeFormat($startTime) . '> to <input type="time" onchange="selectEdit(this)" class='.$practiceCounter.' name=endTime'.$practiceCounter.' value=' . timeFormat($endTime) . '> </br>';
									$weekArray[$name][$dayOfWeek][0] = $dayInput;

								} else {
									$size = sizeof($weekArray[$name][$dayOfWeek]);
									$weekArray[$name][$dayOfWeek][$size] =
									'<input type="hidden" name=groupID'.$practiceCounter.' value='. $groupID.'>
									<input type="hidden" name=dateID'.$practiceCounter.' value='.$dateID.'>
									<input type="hidden" name=playerID'.$practiceCounter.' value='.$playerID.'>
									<input type="hidden" name=practiceID'.$practiceCounter.' value='.$practiceID.'>'.
									'<input type="checkbox" class="filled-in browser-default" style="display:none" name=edit'.$practiceCounter.' value='.$practiceCounter.'>'.
									'<input type="checkbox"  class="filled-in browser-default" style="display:none" name=delete'.$practiceCounter.' value="edit">'.
									'<button type="button"  value='.$practiceCounter.' class="btn" onclick="markDelete(this)">Delete</button></br>'.
									'<input type = "time" class='.$practiceCounter.' onchange="selectEdit(this)" name=startTime'.$practiceCounter.' value=' . timeFormat($startTime) . '> to <input type="time" onchange="selectEdit(this)" class='.$practiceCounter.' name=endTime'.$practiceCounter.' value=' . timeFormat($endTime) . '> </br>';
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
										echo '<font color="red">' .sumFormat($weekHours) . '</font>';
							    		} else {
							    		echo  sumFormat($weekHours); 
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

		<?php } ?>

		<!--  Scripts-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.96.1/js/materialize.min.js"></script>
        <script src="js/materialize.js"></script>
        <script src="js/init.js"></script>
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
			
			function selectEdit(ti) {
				var id = ti.className;
				var checkBox = document.getElementsByName('edit'+id);
				checkBox[0].checked = "checked";
				console.log(id);
				console.log(checkBox[0].checked);
			}

			function markDelete(button) {
				var id = button.value;
				var deleteBox = document.getElementsByName('delete' +id);
				var bool = deleteBox[0].checked;
				deleteBox[0].checked = !bool;
				if(deleteBox[0].checked) {
					button.style.backgroundColor="red";
				} else {
					button.style.backgroundColor="teal";
				}
				console.log(id);
				console.log(deleteBox[0].checked);
			}			
        </script>

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
			if($minutes < 10) {
				$timeDisplay .= '0'. $minutes;
			} else {
				$timeDisplay .= $minutes . '';
			}
		}

		if ($time <60) {
		 	$seconds = $time;
		 	$timeDisplay .= $seconds . ' s ';
		 }
		 return $timeDisplay;
}

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
?>