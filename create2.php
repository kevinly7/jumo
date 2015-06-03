<html>
    <head lang="en">
        <meta charset="UTF-8">
        <title></title>
        <link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>   	
        <!-- Compiled and minified CSS -->
  		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.96.1/css/materialize.min.css">
  		<link href="css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection"/>
        <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    </head>
    <body>
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

        <h4 class="center">Add a Practice to a Group</h4>

		<form action="create.php" method="POST">
			<div class="row">
				<div class="col s4"><p></p></div>
				<div class="col s4">
					<h5>Date</h5>
					<input type="date" name="date">
					
					<h5>Start Time</h5>
					<input type="time" name="startTime">

					<h5>End Time</h5>
					<input type="time" name="endTime">

					<input type="checkbox" class="filled-in" id="filled-in-box" name="competition">
					<label for="filled-in-box">Competition</label>
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

					<!-- <input type="submit" name="formSubmit" value="Submit"> -->
					<div class="editStudentSubmit center">
	                    <button class="btn waves-effect waves-light amber accent-3 white-text" onclick="" type="submit" name="formSubmit" value="Submit">Create Group</button>
	                </div>
				</div>
			</div>
		<form>


		<!--  Scripts -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.96.1/js/materialize.min.js"></script>
        <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script src="js/materialize.js"></script>
        <script src="js/init.js"></script>
		<script src="js/logout.js"></script>
    </body>
</html>