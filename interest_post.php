<?php

	try{
		$bdd = new PDO('mysql:host=localhost;dbname=redclay', 'root', '');
	}
	catch(Exception $e){
		die('Error: '. $e->getMessage());
	}

	// number of category 
	
	$req = $bdd->prepare('SELECT * FROM tbl_category');
	$req->execute();
	$number_of_category=$req->rowCount();

	$usnum=$_POST['usnum'];
	
	for ($i=1;$i<=$number_of_category;$i++){
		if(isset($_POST['cat'.$i])&& !empty($_POST['cat'.$i])){
			$result=$_POST['cat'.$i];
			print_r($result);
			foreach($result as $selectValue){

				$req = $bdd->prepare('INSERT INTO tbl_topic_user (user_number, topic_number) VALUES(?, ?)');
				$req->execute(array($usnum,$selectValue));
				
			}
		}
		
		
	}
	
	header('Location:index.php');






?>