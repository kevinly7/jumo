<?php  
  include ('database.php');
  
$netid = $_GET["netid"];
$password = $_GET["password"];
//echo($netid);
//echo($password);
$statement = $connection->prepare("Select * from tblUSER where UserName = :name and UserPassword = :password ");
$statement -> execute(array(':name' =>$netid, ':password' => $password));
$data = $statement->fetchAll();
foreach($data as $row) {
	//echo $row["UserName"];
	//echo $row["UserPassword"];
	if($row["UserTypeName"] == "ICA") {
		header("Location: sport_selection.html");
		die();
		//echo "ICA";
	} 
	if($row["UserTypeName"] == "Coach") {
		echo "go to dummy page";
	}
}
//echo $data;
/*foreach($connection->query("Select * from tblUSER") as $row) {
	echo $row["UserName"];
	echo $row["UserPassword"];
}*/
	?>