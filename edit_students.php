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
    </head>
    <body>
        <div>


 <?php  
            include ('database.php');
            include ('Player.php');

            ?>

            <h1>Groups</h1>
            <form action = "edit_students.php" method = "POST">
                <select name="p2">
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


            <a href="settings.html"><button id="createGroups">Create a Group</button></a>
       
                 <label for='formStudents[]'>Select the countries that you have visited:</label><br>
                <select multiple="multiple" name="formStudents[]">
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
 
                </select>

            <input name = "formSubmit" id = "formSubmit" type="submit" value="Test Submission">
            

            </form>
            <a href="month_view.html"><button id="submit">Submit</button></a>



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
    </body>
</html>