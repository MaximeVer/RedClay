<?php 
	session_start();
	if($_SESSION['connec']!=1){
		try{
			$bdd = new PDO('mysql:host=localhost;dbname=redclay', 'root', '');
		}
		catch(Exception $e){
			
			die('Error: '. $e->getMessage());
		}
		
		$password =$_POST['password'];
		$username =$_POST['username'];
		
		$req = $bdd->prepare('SELECT * FROM tbl_users WHERE login = ? AND password = PASSWORD(?)');
		$req->execute(array($username,$password));
		
		if(isset($password)AND isset($username)AND $password!='' AND $username!=''AND $req->rowCount()==1){
			
			
			$_SESSION['connec']=1;
			while ($donnees = $req->fetch()){
				$_SESSION['usnum']=$donnees['user_number'];
				$_SESSION['login']=$donnees['login'];
			}
			$req->closeCursor();
		}else{
			header('Location:index.php?case=1');
			exit();
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

	<meta http-equiv="refresh" content="0.1; URL=homepage.php">
	
</body>

</html>

