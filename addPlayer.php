  <?php  
        session_start();
        $newURL = "index.php";
            if (!isset($_SESSION["newsession"])) {
                echo "Please log in again.";
                header('Location: '.$newURL);
                die();
            } else if ($_SESSION["newsession"]!="coach") {
                echo "Please log in again.";
                header('Location: '.$newURL);
                die();
            } else { 

    ?>
<html>
	<header>
	</header>
	<!-- header -->
        <ul id="dropdown1" class="dropdown-content">
            <li><a class="purple-text text-darken-4" href="signup.php">Create Accounts</a></li>
            <li class="divider"></li>
        </ul>

        <nav class="purple darken-4">
            <div class="nav-wrapper">
                <ul class="logo">
                    <a href="sport_selection.php" class="brand-logo white-text">Jumo</a>
                </ul>
                
                <ul class="left hide-on-med-and-down menu">
                    <li><a href="weekview.php">Weekview</a></li>
                    <li><a href="violations.php">Violations</a></li>
                </ul>

                <ul id="nav-mobile" class="right hide-on-med-and-down logout">
                    <li><a class="dropdown-button" href="#" data-activates="dropdown1">Settings<i class="mdi-navigation-arrow-drop-down right"></i></a></li>
                    <!-- <li><a href="settings.php"><i class="mdi-action-settings"></i></a></li> -->
                    <li> <a class = "logout1" href="index.php">Logout</a> </li>
                </ul>
            </div>
        </nav>  
	<body>
		<form action="addPlayerBack.php" onSubmit = "validateForm()" method="POST">
			<input type="text" name="PlayerName">
			<input type="email" name="email">
			
			<?php  
	            include ('database.php');
            ?>
            <select name="group" class="browser-default">
                <option value="" disabled selected>Please select a group</option>
                <?php 
                foreach($connection->query("Select * from tblGROUP ORDER BY GroupName ASC") as $row) {?>
                <option value = <?php echo $row['GroupID'] ?> >
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
            <input type="submit" value="Submit" name="formSubmit">     
		</form>
		<script>
			function validateForm() {
			    var inputs = document.getElementsByTagName("input");
			    for (var i = 0; i<inputs.length; i++) {
			        if (!inputs[i].value){
			            alert("Please fill all the inputs");
			            return false;
			         }
			     }
			     return true;
			};
		</script>
	</body>


</html>

<?php } ?>