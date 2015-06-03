<?php
	$selected = $_POST["formStudents"];
	$count = count($selected);
	foreach($selected as $row) {
		echo $row;
	}
	//echo $selected[0];



?>