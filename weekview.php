

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
        ?>

 </select>
        

 <select name="weekSelect">
 	 <option></option> </br>
        <option>1</option> </br>
         <option>2</option> </br>
          <option>3</option> </br>
           <option>4</option> </br>

    </select>



        </br><input id = "submitMonth" type="submit" value="Select View">
        </form>


       <?php  
include ('database.php');

 foreach($connection->query("Select StartTime, EndTime, PracticeTypeName, DateName, PlayerName
from tblPRACTICE p
join tblPRACTICE_TYPE pt
on p.PracticeTypeID = pt.PracticeTypeID
join tblDATE d
on p.DateID = d.DateID
join tblPLAYER_PRACTICE pp
on pp.PracticeID = p.PracticeID
join tblPLAYER pl
on pp.PlayerID = pl.PlayerID") as $row) {
	echo $row['DateName'] . ' ' . $row['PlayerName']. ' ' . $row['StartTime'] . ' to ' . $row['EndTime'];
	echo '</br>';
 }

?>
    </body>
</html>