<!DOCTYPE html>
<html>
    <head lang="en">
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <div>
        	<h1>Groups</h1>
            <form>
                <select name="p2">
                    <option></option>
                    <option id="subgroup">Hurdles</option>
                    <option>Long Jump</option>
                    <option>Sprints</option>
                    <option>Pole Vault</option>
                </select>
            </form>

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
					<option >

                      <?php  
                      include ('database.php');

                      foreach($connection->query("Select * from tblPLAYER") as $row) {?>

                            <span>
                                                <?php 
                            echo $row['PlayerName'];

                                                ?>
                            </span>
                        </br>

                    <?php }?>


				  	</option>
				</select>

            </div>

            <a href="month_view.html"><button id="submit">Submit</button></a>
        </div>
    </body>
</html>