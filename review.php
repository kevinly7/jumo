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
	echo $row['PlayerName']. ' ' . $row['StartTime'] . ' to ' . $row['EndTime'];
	echo '</br>';



 }

?>