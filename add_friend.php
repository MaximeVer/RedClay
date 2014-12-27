<?php
	session_start();
	if($_SESSION['connec']!=1){
		header('Location:index.php?case=1');
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Homepage</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.css">
	<script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script>
	<link rel="stylesheet" href="css/homepage-new.css">
</head>
<body>
	<div class="header" data-role="header" data-position="fixed">
		<h1>RedClay</h1>
	</div>
	<?php
	// Connection to database
		try{
			$bdd = new PDO('mysql:host=localhost;dbname=redclay', 'root', '');
		}
		catch(Exception $e){
			die('Error: '. $e->getMessage());
		}
	
		$usnum = $_SESSION['usnum'];
		
		$condition=' 0 ';
		
		$req = $bdd->prepare('SELECT DISTINCT topic_number FROM tbl_topic_user WHERE user_number = ? ORDER BY topic_number ASC');
		$req->execute(array($usnum));
		while ($donnees = $req->fetch()){
			$condition= $condition.' OR topic_number = '.$donnees[0] ;
		}
		$req->closeCursor();
		
		$req = $bdd->prepare('SELECT  COUNT(topic_number) AS c, user_number   FROM `tbl_topic_user` WHERE ('.$condition.') AND user_number!= ?  GROUP BY user_number ORDER BY c DESC ');
		$req->execute(array($usnum));
		
		
	?>
	<div data-role="content" class="content">
	<?php
		while ($donnees = $req->fetch()){
			if ($usnum<$donnees[1]){
				$reqtest=$bdd-> prepare('SELECT * FROM tbl_relationship WHERE user_number1= ? AND user_number2= ?');
				$reqtest->execute(array($usnum,$donnees[1]));
			}else{
				$reqtest=$bdd-> prepare('SELECT * FROM tbl_relationship WHERE user_number1= ? AND user_number2= ?');
				$reqtest->execute(array($donnees[1],$usnum));
			}			
			if($reqtest->rowCount()!=1){
			
				$req2 = $bdd->prepare('SELECT * FROM tbl_users WHERE user_number = ? ');
				$req2->execute(array($donnees[1]));	
				$donnees2=$req2->fetch();
				
				$login=$donnees2['login'];
				
				$country=$donnees2['country'];
				
				if($donnees2['gender']==0){
					$gender= 'Female';
				}else{
					$gender='Male';
				}
				
	?>
				<div class="profile">
					<div class="left" style="height:100%">
						<div class="shape">
							<img src="images/female.png" alt="">
							<p class="Name">
							<?php
								echo $login;
								
							?>	
							</p>
						</div>
						
					</div>
					<div class="right" style="height:100%">
						<p class="wording text">"I want to learn French"</p>
						<div class="center">
							<p class="nationality text">
								<?php echo $country; ?>
							</p>
							<p class="gender text">
								<?php echo $gender; ?>
							</p>
						</div>
						<ul class="interest">
							<?php
						
								$req3 = $bdd->prepare('SELECT DISTINCT topic_name FROM tbl_topic AS t, tbl_topic_user AS tu WHERE t.topic_number=tu.topic_number AND tu.user_number = ?');
								$req3->execute(array($donnees[1]));	
								while ($donnees3 = $req3->fetch()){
				
									echo '<li class="interest-tag">'.$donnees3[0].'</li>';
								}
								$req3->closeCursor();
							?>
						</ul>
						<a class="invite" href="add_friend_post.php?usnum=<?php echo $donnees[1] ;?>">Invite</a>
					</div>
					<div class="clearfix"></div>
				</div>
			<?php 
			}
		}
		$req->closeCursor();
		?>	
	</div>

</body>
</html>