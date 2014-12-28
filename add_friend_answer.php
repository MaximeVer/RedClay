<?php
	session_start();
	if($_SESSION['connec']!=1){
		header('Location:index.php?case=1');
	}
	
	$usnum1 = $_SESSION['usnum'];
	$usnum2 = $_GET['case'];
	
	// Connection to database
	try{
		$bdd = new PDO('mysql:host=localhost;dbname=redclay', 'root', '');
	}
	catch(Exception $e){
		die('Error: '. $e->getMessage());
	}
	
	if($usnum1<$usnum2){
		$req=$bdd->prepare('INSERT INTO tbl_relationship VALUES ("",? , ?,0,1)');
		$req->execute(array($usnum1,$usnum2));
		
	}else{
		$req=$bdd->prepare('INSERT  INTO tbl_relationship VALUES ("",? , ?,0,2)');
		$req->execute(array($usnum2,$usnum1));
	}
	
	
	
	
	
	
	
	
	header('Location:homepage.php');
	

?>