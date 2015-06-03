<html>
	<head>
	</head>
	<body>
		<?php
			include ('database.php');
            include ('Player.php');
        ?>
        <form action="delete.php" method="POST">
			<select multiple="multiple" name="formStudents[]" class="browser-default student-select ">

	        <?php   
	    		foreach($connection->query("Select * from tblPLAYER")  as $row) {
	            $playerObject = new Player($row['PlayerName'], $row['PlayerID'], $row['PlayerContact']); 
				//$playerArray[$row['PlayerName']] = $row['PlayerID'];
			?>
	        
		        <option class="student" value = <?php echo $row['PlayerID'] ?> >
		            <span class="student">
		                <?php 
		                echo $playerObject ->getName();
		                ?>
		            </span>
		        </option>

	            <?php }?>
	        </select>
        	<input type="submit" value="Submit">
    	</form>
        
	</body>
</html>