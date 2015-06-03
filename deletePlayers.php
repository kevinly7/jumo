<!DOCTYPE html>
<html>
	<head lang="en">
		<title></title>
        <!-- Compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.96.1/css/materialize.min.css">
        <link href="css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection"/>
        <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
        <link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
	</head>
	<body>
		<?php
			include ('database.php');
            include ('Player.php');
        ?>
        <!-- header -->
        <ul id="dropdown1" class="dropdown-content">
            <li><a class="purple-text text-darken-4" href="settings.php">Create Groups</a></li>
            <li class="divider"></li>
            <li><a class="purple-text text-darken-4" href="edit_students.php">Add Students to Group</a></li>
            <li class="divider"></li>
            <li><a class="purple-text text-darken-4" href="delete_student_groups.php">Delete Students from Group</a></li>
            <li class="divider"></li>
            <li><a class="purple-text text-darken-4" href="create2.php">Add Practice to Group</a></li>
        </ul>

        <nav class="purple darken-4">
            <div class="nav-wrapper">
                <ul class="logo">
                    <a href="coach_review.php" class="brand-logo white-text">Jumo</a>
                </ul>

                <ul id="nav-mobile" class="right hide-on-med-and-down logout">
                    <!-- <li><a href="settings.php"><i class="mdi-action-settings"></i></a></li> -->

                    <!-- Dropdown Trigger -->
                    <li><a class="dropdown-button" href="#" data-activates="dropdown1">Settings<i class="mdi-navigation-arrow-drop-down right"></i></a></li>
                    <li> <a class = "logout1" href="index.php">Logout</a> </li>
                </ul>
            </div>
        </nav>

        <h4 class="center page-title">Delete Student Athletes</h4>
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
    <!--  Scripts-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.96.1/js/materialize.min.js"></script>
    <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="js/materialize.js"></script>
    <script src="js/init.js"></script>
    <script src="js/logout.js"></script>    
	</body>
</html>