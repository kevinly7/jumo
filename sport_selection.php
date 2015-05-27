<!DOCTYPE html>
<html>
    <head lang="en">
        <meta charset="UTF-8">
        <title></title>
        <!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/settings.css">
 -->
        <!-- Compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.96.1/css/materialize.min.css">
        <link href="css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection"/>
        <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    </head>
    <body>
        <?php  
        session_start();
        echo $_SESSION["newsession"];
            if (!isset($_SESSION["newsession"])) {
                echo "Please log in again.";
            } else if ($_SESSION["newsession"]!="ica") {
                echo "Please log in again.";
            } else { 

    ?>

        <!-- header -->
        <nav class="purple darken-4">
            <div class="nav-wrapper">
                <a href="weekview.php" class="brand-logo white-text">Jumo</a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                    <li><a href="settings.php"><i class="mdi-action-settings"></i></a></li>
                    <li><a class = "logout" href="index.php">Logout</a></li>
                </ul>
            </div>
        </nav>

        <!-- body -->
        <h4 class="title center">Choose a Sport</h4>

        <div class="row">
            <div class="col s4"><p></p></div>
            <div class="col s4">
                <div class="selection center">
                    <select class="browser-default" name="p2" required>
                        <option value="" disabled selected>Please select a sport</option>
                        <option value="sport" id="sport">Track and Field</option>
                        <!-- <option value="2">Football</option> -->
                        <!-- <option value="3">Tennis (Mens)</option> -->
                    </select>
                    <a class="waves-effect waves-light btn amber accent-3" href="weekview.php" id="submit">Go Huskies!</a>
                </div>
            </div>
        </div>
  <?php } ?>
        <!--  Scripts-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.96.1/js/materialize.min.js"></script>
        <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script src="js/materialize.js"></script>
        <script src="js/init.js"></script>
        <script src="js/logout.js"></script>
    </body>
</html>