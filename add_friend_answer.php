<?php
	session_start();
	if($_SESSION['connec']!=1){
		header('Location:index.php?case=1');
	}
	
	
	$case = $_GET['case'];
	$numdem = $_GET['numdem'];
	
	// Connection to database
	try{
		$bdd = new PDO('mysql:host=localhost;dbname=redclay', 'root', '');
	}
	catch(Exception $e){
		die('Error: '. $e->getMessage());
	}
	
	if($case==1 AND isset($numdem)){
		$req=$bdd->prepare('DELETE FROM tbl_relationship WHERE relationship_number = ?');
		$req->execute(array($numdem));
		
	}elseif($case==2 AND isset($numdem)){
		$req=$bdd->prepare('UPDATE  tbl_relationship SET invitation = 0 WHERE relationship_number = ?');
		$req->execute(array($numdem));
	}else{
		header('Location:homepage.php');
	}
	
	
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