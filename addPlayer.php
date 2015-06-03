<html>
	<header>
	</header>

	<body>
		<form action="addPlayerBack.php" onSubmit = "validateForm()" method="POST">
			<input type="text" name="PlayerName">
			<input type="email" name="email">
			
			<?php  
	            include ('database.php');
            ?>
            <select name="group" class="browser-default">
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
            <input type="submit" value="Submit" name="formSubmit">     
		</form>
		<script>
			function validateForm() {
			    var inputs = document.getElementsByTagName("input");
			    for (var i = 0; i<inputs.length; i++) {
			        if (!inputs[i].value){
			            alert("Please fill all the inputs");
			            return false;
			         }
			     }
			     return true;
			};
		</script>
	</body>


</html>