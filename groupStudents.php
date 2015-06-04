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
        <div>
            <?php  
            include ('database.php');
            include ('Player.php');
            $groupid = $_POST["action"];
 
            ?>

            <div class="row">
                <div class="col s4"><p></p></div>
                <div class="col s4 center">
                    <form action = "delete_student_groups.php" method = "POST">
                        <label for='formStudents[]'>Select the students to delete from the group</label>
                        <select multiple="multiple" name="formStudents[]" class="browser-default student-select ">
                            <?php 

                            $playerArray = array();

                            foreach($connection->query("Select * from tblPLAYER p JOIN tblPLAYER_GROUP pg ON p.PlayerID = pg.PlayerID WHERE pg.GroupID = $groupid ORDER BY PlayerName ASC") as $row) {
                                $playerObject = new Player($row['PlayerName'], $row['PlayerID'], $row['PlayerContact']); 

                                $playerArray[$row['PlayerName']] = $row['PlayerID'];

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

                        <!-- <input name = "formSubmit" id = "formSubmit" type="submit" value="Test Submission"> -->
                        <div class="editStudentSubmit">
                            <button class="btn waves-effect waves-light amber accent-3 white-text" type="submit" id="formSubmit" name="formSubmit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- <a href="settings.php" class="waves-effect waves-light amber accent-3 white-text btn">Create a Group</a> -->
            <!-- <a href="weekview.php" class="waves-effect waves-light amber accent-3 white-text btn">Submit (go to week)</a> -->

        



    </div>
        <!--  Scripts-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.96.1/js/materialize.min.js"></script>
        <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script src="js/materialize.js"></script>
        <script src="js/init.js"></script>
         <script src="js/logout.js"></script>
    </body>
</html>