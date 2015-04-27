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
                <a href="weekview.php" class="brand-logo white-text">Jumo</a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                    <li><a href="#"><i class="mdi-action-settings"></i></a></li>
                    <li><a href="index.php">Logout</a></li>
                </ul>
            </div>
        </nav>

        <h4 class="title center">Create Subgroups</h4>

        <form action = "settings.php" method = "GET">
            <div class="row">
                <div class="col s4"><p></p></div>
                <div class="col s4 center">
                    <h5 class="center">Enter name of subgroup: </h5>

                    <form>
                        <div class="input-field">
                            <input id="subgroup" type="text" size="30" class="validate" name="subgroup">
                            <label for="soubgroup">Subgroup</label>
                        </div>
                        <div class="input-field">
                            <input id="coach" type="text" size="30" class="validate" name="coach">
                            <label for="coach">Coach</label>
                        </div>
                        <div class="input-field">
                            <input id="contact" type="text" size="30" class="validate" name="contact">
                            <label for="contact">Contact Info</label>
                        </div>
                    </form>

                    <!-- <input name ="subgroup" type="text" size=30> </input> </br>
                    <input name ="coach" type="text" size=30> </input> </br>
                    <input name ="contact" type="text" size=30> </input> -->
                    <!-- <input id = "submitGroup" type="submit" value="Create Group"> -->
                    <button class="btn waves-effect waves-light amber accent-3 white-text" type="submit" id="submitGroup" name="action">Create Group</button>
                    <br>
                    <a href="edit_students.php" class="waves-effect waves-light amber accent-3 white-text btn">Edit Students</a>
                </div>
            </div>
        </form>

        

    <?php
    include ('database.php');

    if (isset($_GET['subgroup']) && isset($_GET['coach']) && isset($_GET['contact'])) {

        $group = $_GET['subgroup'];
        $coach = $_GET['coach'];
        $contact = $_GET['contact'];
        $sportid = 1;

     $statement = $connection->prepare ("INSERT INTO tblGROUP (GroupName, CoachName, CoachContact, SportID) VALUES (:group, :coach, :contact, :sportid)");
    $statement -> execute(array(':group' => $group, ':coach' => $coach, ':contact' => $contact, ':sportid' => $sportid));
    } else {
        echo "Please fill out all the fields";
    }
    ?>

        <!-- Compiled and minified JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.96.1/js/materialize.min.js"></script>
    </body>
</html>