<?php 

	try{
		$bdd = new PDO('mysql:host=localhost;dbname=redclay', 'root', '');
	}
	catch(Exception $e){
		
		die('Error: '. $e->getMessage());
	}
	
	$reponse = $bdd->query('SELECT * FROM tbl_users');
	
	while ($donnees = $reponse->fetch())
		{
			echo $donnees[1]."</br>";
			echo $donnees[2]."</br>";
			echo $donnees[3]."</br>";
			echo $donnees[4]."</br>";
		}

	$reponse->closeCursor();

	
	
	//if(isset($_POST['loginfilled']) AND $_POST['loginfilled']==)
	// header('index.php');	
?>
