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


            <form action = "edit_students.php" method = "POST">
                 <label for='formCountries[]'>Select the countries that you have visited:</label><br>
                <select multiple="multiple" name="formCountries[]">
                    <option value="US">United States</option>
                    <option value="UK">United Kingdom</option>
                    <option value="France">France</option>
                    <option value="Mexico">Mexico</option>
                    <option value="Russia">Russia</option>
                    <option value="Japan">Japan</option>
                </select>

            <input name = "formSubmit" id = "formSubmit" type="submit" value="Test Submission">
            </form>


<?php
if(isset($_POST['formSubmit'])) 
{
  $aCountries = $_POST['formCountries'];
   
  if(!isset($aCountries)) 
  {
    echo("<p>You didn't select any countries!</p>\n");
  } 
  else
  {
    $nCountries = count($aCountries);
     
    echo("<p>You selected $nCountries countries: ");
    for($i=0; $i < $nCountries; $i++)
    {
      echo($aCountries[$i] . " ");
    }
    echo("</p>");
  }
}
 
?>










            <h1>Groups</h1>
            <form action = "edit_students.php" method = "POST">
                <select name="p2">
                    <option></option>
                    <option id="subgroup" value = "1">Hurdles</option>
                    <option value = "2">Long Jump</option>
                    <option value = "3">Sprints</option>
                    <option value = "4">Pole Vault</option>
                </select>



            


            <a href="settings.html"><button id="createGroups">Create a Group</button></a>
       

            <div class="subgroup">

               <select multiple>
                 
                   
 
            <?php  
            include ('database.php');
 
            foreach($connection->query("Select * from tblPLAYER") as $row) {?>

           <option >
                <span>
                    <?php 
                        echo $row['PlayerName'];
 
                    ?>
                </span>
                       </br>
                      </option>
 
                     <?php }?>
 
 
+                   
                </select>
            </div>


            <input id = "addStudents" type="submit" value="Add to Group">
            </form>




            <a href="month_view.html"><button id="submit">Submit</button></a>
        </div>
    </body>
</html>