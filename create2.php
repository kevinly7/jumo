<html>
    <head lang="en">
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
		<form action="create.php" method="POST">
			<input type="date" name="date">Date<br>
			<input type="time" name="startTime">Start Time<br>
			<input type="time" name="endTime">End Time<br>
			<input type="checkbox" name="competition">Competition<br>
			<?php $groupArray = array();
				include ('database.php');
			?>

			<select name="groupSelect" class="browser-default">
				<option value="" >Please select a group</option>
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


			<input type="submit" name="formSubmit" value="Submit">
		<form>
    </body>
</html>