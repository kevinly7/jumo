  <?php  
        session_start();
        $newURL = "index.php";
            if (!isset($_SESSION["newsession"])) {
                echo "Please log in again.";
                header('Location: '.$newURL);
            } else if ($_SESSION["newsession"]!="coach") {
                echo "Please log in again.";
                header('Location: '.$newURL);
            } else { 

    ?>

<!DOCTYPE html>
<html>
    <head lang="en">
        <meta charset="UTF-8">
        <title></title>
        <!-- Compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.96.1/css/materialize.min.css">
        <link href="css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection"/>
        <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
        <link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
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


        <div>
            <?php  
            include ('database.php');
            include ('Player.php');

            ?>

            <h4 class="center page-title">Delete students in Groups</h4>

            <div class="row">
                <div class="col s4"><p></p></div>
                <div class="col s4 center">
                    <select name="studentGroups" class="browser-default">
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
                </div>
            </div>

            <div id="response"></div>
            <!-- <a href="settings.php" class="waves-effect waves-light amber accent-3 white-text btn">Create a Group</a> -->
            <!-- <a href="weekview.php" class="waves-effect waves-light amber accent-3 white-text btn">Submit (go to week)</a> -->

        <?php

        if(isset($_POST['formSubmit'])) 
        {
            $aStudents = $_POST['formStudents'];

            if(!isset($aStudents)) 
            {
                echo("<p>You didn't select any students!</p>\n");
            } 
            else
            {

                $statement = $connection->prepare ("DELETE FROM tblPLAYER_GROUP WHERE PlayerID = :playerid"); 



                $nStudents = count($aStudents);

                echo("<p>You selected $nStudents students to delete ");
                for($i=0; $i < $nStudents; $i++)
                {
                    $player = $aStudents[$i];
                                  
                    $statement -> execute(array(':playerid' => $player));
                    


                    
                }
                echo("</p>");
            }
        }

    }
        ?>



    </div>
        <!--  Scripts-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.96.1/js/materialize.min.js"></script>
        <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script src="js/materialize.js"></script>
        <script src="js/init.js"></script>
        <script src="js/logout.js"></script>
        <script src="js/deleteStudent.js"></script>
    </body>
</html>
