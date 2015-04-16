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





<label for='formCountries[]'>Select the countries that you have visited:</label><br>
<select multiple="multiple" name="formCountries[]">
    <option value="US">United States</option>
    <option value="UK">United Kingdom</option>
    <option value="France">France</option>
    <option value="Mexico">Mexico</option>
    <option value="Russia">Russia</option>
    <option value="Japan">Japan</option>
</select>


        <div>
            <h1>Groups</h1>
            <form action = "edit_students.php" method = "POST">
                <select name="p2">
                    <option></option>
                    <option id="subgroup" value = "1">Hurdles</option>
                    <option value = "2">Long Jump</option>
                    <option value = "3">Sprints</option>
                    <option value = "4">Pole Vault</option>
                </select>
            </form>


   <?php 
            
              if (isset($_POST['p2'])) {
                    echo 'it wooooorrrks';

              }


            ?>


            <a href="settings.html"><button id="createGroups">Create a Group</button></a>
       

            <div class="subgroup">
                <!-- <div class="details">
                    <ul style="list-style-type:none">
                        <li><span class="first">FirstName</span> 
                        <span class="last">LastName [to be added]</span></li>
                    </ul>
                     <h2 class="name">
                        <span class="first">FirstName</span> 
                        <span class="last">LastName [to be added]</span>
                    </h2> 
                </div> -->

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
                        </option>

                    <?php }?>


                    
                </select>

            </div>

            <a href="month_view.html"><button id="submit">Submit</button></a>
        </div>
    </body>
</html>