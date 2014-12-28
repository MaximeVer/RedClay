<?php 
	
	if($_POST['login']!=''AND $_POST['password']!=''AND $_POST['gender']!=''AND $_POST['country']!=''AND $_POST['firstname']!=''AND $_POST['lastname']!=''AND $_POST['lang_learnt']!=''){
		try{
			$bdd = new PDO('mysql:host=localhost;dbname=redclay', 'root', '');
		}
		catch(Exception $e){
			die('Error: '. $e->getMessage());
		}

		$req=$bdd->prepare('SELECT * FROM tbl_users WHERE login = ?');
		$req->execute(array($_POST['login']));
		
		if($req->fetch()){
			$req->closeCursor();
			$path='registration.php?case=2';
		}
		else{
			$req->closeCursor();
			try{
				$req = $bdd->prepare('INSERT INTO tbl_users (login , password, gender, country, last_name, first_name, lang_learnt) VALUES(?, PASSWORD(?), ?, ?, ? ,? ,?)');
				
				$req->execute(array($_POST['login'],$_POST['password'],$_POST['gender'],$_POST['country'],$_POST['firstname'],$_POST['lastname'],$_POST['lang_learnt']));
				echo 'test2';
			}
			catch(Exception $e){
				die('Error: '. $e->getMessage());
			}
			print isset($_POST['login']);
			
			
			$req=$bdd->prepare('SELECT user_number FROM tbl_users WHERE login = ?');
			$req->execute(array($_POST['login']));
			$us_number=$req->fetch();
			$req->closeCursor();
			$path='interest.php?usnum='.$us_number[0];
		}
	}
	else{
		
		$path='Location:registration.php?case=1';
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

	<meta http-equiv="refresh" content="0.2; URL=<?php echo $path ;?>">
	
</body>

</html>