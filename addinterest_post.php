
<?php

	session_start();
	if($_SESSION['connec']!=1){
		header('Location:index.php?case=1');
	}
	
	$usnum = $_SESSION['usnum'];
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
	
	$req_clear = $bdd->query('DELETE FROM tbl_topic_user WHERE user_number = '.$usnum);
	
	
	for ($i=1;$i<=$number_of_category;$i++){
		if(isset($_POST['cat'.$i])&& !empty($_POST['cat'.$i])){
			$result=$_POST['cat'.$i];
			print_r($result);
			foreach($result as $selectValue){

			
				$req_existe=$bdd->query('SELECT * FROM tbl_topic_user WHERE user_number = '.$usnum.' AND topic_number = '.$selectValue);
				if($req_existe->rowCount()==0){
					$req = $bdd->prepare('INSERT INTO tbl_topic_user (user_number, topic_number) VALUES(?, ?)');
					$req->execute(array($usnum,$selectValue));
				}
				
			}
		}
		
		
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
	<?php
		
	?>
</body>

</html>