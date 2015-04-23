

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
		WHERE DATE(d.DateName) BETWEEN '$startday' AND '$endday' AND (p.GroupID = $group)") as $row) { 

		$timestamp = strtotime($row['DateName']);
		$dayOfWeek = date("N", $timestamp);
			?>
		  <tr>
    <td><?php echo $row['PlayerName'] ?></td>
    <?php for ($i = 0; $i < $dayOfWeek + 1; $i++) {?>
    	<td></td>
    <?php }?>
     <td><?php  echo $row['StartTime'] . ' to ' . $row['EndTime'] ?></td>
  </tr>

		<?php } ?>

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

