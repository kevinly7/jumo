<?php
if (isset($_GET['p2'])){
    echo "this is : " . $_GET['p2'];
}  
?>


<!DOCTYPE html>
<html>
    <head lang="en">
        <meta charset="UTF-8">
        <title></title>
        <!-- Compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.96.1/css/materialize.min.css">
        <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    </head>
    <body>
        <!-- header -->
        <nav class="purple darken-4">
            <div class="nav-wrapper container">
                <a href="#" class="brand-logo white-text">Jumo</a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                    <li><a href="settings.php"><i class="mdi-action-settings"></i></a></li>
                    <li><a href="index.html">Logout</a></li>
                </ul>
            </div>
        </nav>


        <div>
            <?php  
            include ('database.php');
            include ('Player.php');

            ?>

            <h4>Groups</h4>
            <!-- <form>
                <select class="browser-default">
                    <option>test</option>

                </select>
            </form>

            <div class="row">
                <div class="col s4"><p></p></div>
                <div class="col s4">
                    <div class="selection center">
                        <select class="browser-default" name="p2" required>
                            <option value="" disabled selected>Please select a sport</option>
                            <option value="sport" id="sport">Track and Field</option>
                            <option value="2">Football</option>
                            <option value="3">Tennis (Mens)</option>
                        </select>
                        <a class="waves-effect waves-light btn amber accent-3" href="month_view.html" id="submit">Go Huskies!</a>
                    </div>
                </div>
            </div> -->

            <form action = "edit_students.php" method = "POST">
                <select name="p2" class="browser-default">
                    <option></option>
                    <?php 
                    foreach($connection->query("Select * from tblGROUP") as $row) {?>
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


            <!-- <a href="settings.php"><button id="createGroups">Create a Group</button></a> -->
            <a href="settings.php" class="waves-effect waves-light amber accent-3 white-text btn">Create a Group</a>

            <label for='formStudents[]'>Select the students:</label><br>
            <select multiple="multiple" name="formStudents[]" class="browser-default">
                <?php 

                $playerArray = array();

                foreach($connection->query("Select * from tblPLAYER") as $row) {
                    $playerObject = new Player($row['PlayerName'], $row['PlayerID'], $row['PlayerContact']); 

                    $playerArray[$row['PlayerName']] = $row['PlayerID'];

                    ?>

                    <option >
                        <span>
                            <?php 


                            echo $playerObject ->getName();

                            ?>
                        </span>
                    </br>
                </option>

                <?php }?>
                <option>test</option>

            </select>

            <!-- <input name = "formSubmit" id = "formSubmit" type="submit" value="Test Submission"> -->
            <button class="btn waves-effect waves-light amber accent-3 white-text" type="submit" id="formSubmit" name="formSubmit">Test Submission</button>


        </form>
        <a href="month_view.html" class="waves-effect waves-light amber accent-3 white-text btn">Submit (go to month)</a>



        <?php

        if(isset($_POST['formSubmit'])) 
        {

            echo '</br>' . $_POST['p2'] . '</br>';
            $groupid = $_POST['p2'];

            $aStudents = $_POST['formStudents'];

            if(!isset($aStudents)) 
            {
                echo("<p>You didn't select any students!</p>\n");
            } 
            else
            {

                $statement = $connection->prepare ("INSERT INTO tblPLAYER_GROUP (PlayerID, GroupID) VALUES (:playerid, :groupid)"); 



                $nStudents = count($aStudents);

                echo("<p>You selected $nStudents countries: ");
                for($i=0; $i < $nStudents; $i++)
                {
                    $player = $aStudents[$i];
                    echo $aStudents[$i];
                    $playerID = $playerArray[$player];

                    $statement -> execute(array(':groupid' => $groupid, ':playerid' => $playerID)); 
                }
                echo("</p>");
            }
        }


        ?>



    </div>
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.96.1/js/materialize.min.js"></script>
    </body>
</html>