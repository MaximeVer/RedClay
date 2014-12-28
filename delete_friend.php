<?php
	session_start();
	if($_SESSION['connec']!=1){
		header('Location:index.php?case=1');
	}
	
	
	$numdel = $_GET['numdel'];
	
	// Connection to database
	try{
		$bdd = new PDO('mysql:host=localhost;dbname=redclay', 'root', '');
	}
	catch(Exception $e){
		die('Error: '. $e->getMessage());
	}
	

	$req=$bdd->prepare('DELETE FROM tbl_relationship WHERE relationship_number = ?');
	$req->execute(array($numdel));

	
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Homepage</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>


<body>


	<div>
		Loading!
	</div>

	<meta http-equiv="refresh" content="0.2; URL=homepage.php">
	
</body>

</html>