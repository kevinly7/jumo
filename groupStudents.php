<?php
echo "YESSSS";
include("database.php"); ?>

 <form action = "edit_students.php" method = "POST">
                       
                        <label for='formStudents[]'>Select the students to add to the above group:</label>
                        <select multiple="multiple" name="formStudents[]" class="browser-default student-select ">
                            <?php 

                            $playerArray = array();

                            foreach($connection->query("Select * from tblPLAYER ORDER BY PlayerName ASC") as $row) {
                                $playerObject = new Player($row['PlayerName'], $row['PlayerID'], $row['PlayerContact']); 

                                $playerArray[$row['PlayerName']] = $row['PlayerID'];

                                ?>

                                <option class="student">
                                    <span class="student">
                                        <?php 
                                        echo $playerObject ->getName();
                                        ?>
                                    </span>
                                    
                                </option>

                            <?php }?>
                            <option>test</option>

                        </select>

                        <!-- <input name = "formSubmit" id = "formSubmit" type="submit" value="Test Submission"> -->
                        <div class="editStudentSubmit">
                            <button class="btn waves-effect waves-light amber accent-3 white-text" type="submit" id="formSubmit" name="formSubmit">Submit</button>
                        </div>
                    </form>



