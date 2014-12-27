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
		}
	}
	
	
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>test</title>
	<meta charset="UTF-8">
	<title>test</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.css">
	<script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script>

	<script src="http://jqmdesigner.appspot.com/components/platform/platform.js"></script>
  <!-- <link rel="import" href="http://jqmdesigner.appspot.com/components/core-icons/core-icons.html"> -->
  <link rel="import" href="http://jqmdesigner.appspot.com/components/paper-input/paper-input.html">
  <!-- // <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> -->
  <!-- // <script src="//code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script> -->

</head>

<body>

	<div>
		<?php
			echo "Ceci est un test".$_SESSION['usnum'].$_SESSION['login'];
		?>
		</br>
		<a href="deconnec.php" >
			<p >Deconnection!</p>
		</a>
	</div>
</body>