<!DOCTYPE html>
<html>
    <head lang="en">
        <meta charset="UTF-8">
        <title></title>
        <!-- Compiled and minified CSS -->
        <link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
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
          			<li><a href="weekview.php">Weekview</a></li>
            		<li class="active"><a href="violations.php">Violations</a></li>
        		</ul>

                <ul id="nav-mobile" class="right hide-on-med-and-down logout">
                    <!-- <li><a href="settings.php"><i class="mdi-action-settings"></i></a></li> -->
                    <a class = "logout" href="index.php">Logout</a>
                </ul>
            </div>
        </nav>
		
		<h4 class="center">Violations</h4>

		<div class="row">
			<div class="col s3">
				<form action = "violations.php" method = "POST">			
			        <h6><b>Filters</b></h6>	
			        <div class="week-picker"></div>
				    <!--<label>Week :</label> <span id="startDate"></span> - <span id="endDate"></span><br />-->
				    <input id ="startDate" style="display:none" type="date" name="startDate">
					<input id="endDate" style="display:none" type="date" name="endDate">			        
			    
				    <!-- <input name = "formSubmit" type="submit" value="Select View"> -->
				    <br>
				    <button class="btn waves-effect waves-light amber accent-3 white-text" type="submit" id="formSubmit" name="formSubmit">Select View</button>
				</form>

				<?php  
				include ('database.php');

				if(isset($_POST['formSubmit'])) 
				{ ?>
			</div>

			<div class="col s9">
				<table class="bordered">
					<thead>
						<tr>
							<th data-field="name">Name</th>
						    <th data-field="violation">Violation(s)</th>
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
				
					
					$year = "";
					$month = "";
					$week = "";
					$group = 'All';
					$default = true;
					printWeek($year, $month, $week, $group, $default); 
				} else { ?>

					</div>

			<div class="col s9">
				<table class="bordered hoverable">
					<thead>
						<tr>
							<th data-field="name">Name</th>
						    <th data-field="violation">Violation(s)</th>
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
					printWeek($year, $month, $week, $group, $default); 
				} }?>


				   
		<!--  Scripts-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.96.1/js/materialize.min.js"></script>
        <!--<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>-->
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
?>

<?php 
function printWeek($year, $month, $week, $group, $default){

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
		$dayCount = 0;
		$weekHours = 0;
		$weekArray = array();
		$sumArray = array();
						?>
		<p class = "viewTitle"> <?php echo "Checking violations from " . $startday . ' to ' . $endday; ?> </p>
	<?php
				$violationquery = $connection->query("Select StartTime, EndTime, PracticeTypeName, DateName, PlayerName
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
					ORDER BY DateName ASC");

				if($violationquery->rowCount() < 1)
				{ ?>

				<tbody>
					<tr>
						<td>
					<?php
				    // row exists. do whatever you want to do.
				    echo "There are no violations for this week"; ?>
				    </td>
				</tr>
			</tbody>
			<?php
				} else {
				foreach($violationquery as $row) { 
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
			    $trackViolations = 0;

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
												$trackViolations++;
											}
					    				}
					    				$weekHours += $difference;
					    				$daysPracticed = count($sumArray[$key]);
					    				if ($difference > $dayLimit){ 
					    				 echo 'Over 4 hours on ' . $dateKey . '</br>';
					    				 $trackViolations++;
					    				} 
					    			 ?> 
					    			 
					    		<?php }
					    		?>

					    		<?php 
					    		if ($daysPracticed > 3) { 
								   echo 'No Break Days this week' . '</br>';
								   $trackViolations++;
					    		}

					    		if ($weekHours > $hourLimit){ 
					    			echo 'Over the 20 hour weekly limit' ;
					    			$trackViolations++;
					    		} 

					    		if ($trackViolations == 0) {
					    			echo 'No Violations this week';
					    		}
					    		?> 
								</td>
					    	</tr>
					    </tbody>
				    <?php 
				}

				}?>   
			</table>
			<br>
				<!-- <button class="btn waves-effect waves-light amber accent-3 white-text right" type="submit" id="submitGroup" name="formSubmit">Submit</button> -->
			</div>
		</div>
		<?php 
		} 

		?>
