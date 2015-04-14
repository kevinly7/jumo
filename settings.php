<!DOCTYPE html>
<html>
    <head lang="en">
        <meta charset="UTF-8">
        <title></title>
    </head>

    <body>




        <h1>Create Subgroups</h1>

        <form action = "settings.php" method = "GET">
            <h2>Enter name of subgroup: </h2>
            <input name ="subgroup" type="text" size=30> </input> </br>
            <input name ="coach" type="text" size=30> </input> </br>
            <input name ="contact" type="text" size=30> </input>
            <input id = "submitGroup" type="submit" value="Create Group">
        </form>

        <button id="editStudents">Edit Students</button>

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


    </body>
</html>