<?php  
  include ('database.php');

if(isset($_POST["netid"]) and isset($_POST["password"])) {   
	$netid = $_POST["netid"];
	$password = $_POST["password"];
	//echo($netid);
	//echo($password);
	$statement = $connection->prepare("Select * from tblUSER where UserName = :name");// and UserPassword = :password ");
	$statement -> execute(array(':name' =>$netid));//, ':password' => $password));
	$data = $statement->fetchAll();
	if($data != null) {
		session_start();
		foreach($data as $row) {
			//echo $row["UserName"];
			//echo $row["UserPassword"];
			if($row["UserTypeName"] == "ICA") {
				if($row["UserPassword"] == $password) {

					$_SESSION["newsession"]="ica";
					header("Location: sport_selection.html");
					die();
					//echo "ICA";
				} else { 
					$_SESSION["newsession"]="";
					?>
					<script>
						alert("Password is incorrect")
					</script>
					<!--echo "Password is incorrect";-->
				<?php }
			} 
			if($row["UserTypeName"] == "Coach") {
				if($row["UserPassword"] == $password) {
					header("Location: coach_review_2.php");
					$_SESSION["newsession"]="coach";
					die();
				} else { 
						$_SESSION["newsession"]="";
					?>
					<script>
						alert("Password is incorrect")
					</script>
					<!--echo "Password is incorrect";-->
				<?php }
			}
		}
	} else { ?>
		<script>
				alert("Username does not exist")
		</script>
		<!--echo "Username does not exist";-->
	<?php }
}
//echo $data;
/*foreach($connection->query("Select * from tblUSER") as $row) {
	echo $row["UserName"];
	echo $row["UserPassword"];
}*/
	?>