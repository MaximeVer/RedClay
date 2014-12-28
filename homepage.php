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
	
	$usnum = $_SESSION['usnum'];
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Homepage</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
	<link rel="stylesheet" href="css/addfriend-new.css">
	<link rel="stylesheet" href="css/homepage-new.css">
</head>
<script>
	$(document).ready(function(){
  $(".friend").on("tap",function(){
    $('.friend-notification').toggle("slow");
  });
});
	$(document).ready(function(){
  $(".profile").on("taphold",function(){
    $('.delete').show();
    $('.undo').show();
  });
});
	$(document).ready(function(){
  $(".delete").on("tap",function(){
    $('.profile1').hide();
  });
});
	$(document).ready(function(){
  $(".undo").on("tap",function(){
    $('.delete').hide();
    $('.undo').hide();

  });
});
</script>
<body>
	<div class="header" data-role="header" data-position="fixed" data-theme="b">
		<a href="#left-menu" data-role="button" data-icon="user" data-iconpos="notext" class="ui-btn-inline"></a>
		<a href="#" data-role="button" data-icon="gear" data-iconpos="notext" class="ui-btn-inline"></a>
		<h1>RedClay</h1>
	</div>
	
	<?php
	/*
	*
	* Database Connection
	*
	*/
	
	try{
		$bdd = new PDO('mysql:host=localhost;dbname=redclay', 'root', '');
	}
	catch(Exception $e){
		
		die('Error: '. $e->getMessage());
	}
	?>
	
	
		
	</div>
	<div id="left-menu" data-role="panel" data-position="left" >
	    <a href="" class="friend ui-btn ui-icon-mail ui-btn-icon-left">Notification</a>
		
		
		<?php
			
			$req_friend_notif=$bdd->prepare('SELECT user_number1, user_number2, relationship_number FROM tbl_relationship WHERE (user_number1= ?  AND invitation = 2) OR (user_number2 = ? AND invitation = 1 )ORDER BY frequency DESC');
			$req_friend_notif->execute(array($usnum,$usnum));
			
			
		?>
		
		<div class="friend-notification">
			<?php
				while($num_demand=$req_friend_notif->fetch()){
					if($num_demand[0]==$usnum){
						$friendnumdem= $num_demand[1];
					}else{
						$friendnumdem= $num_demand[0];
					}
					
					
					$req_friend_dem = $bdd->prepare('SELECT * FROM tbl_users WHERE user_number = ? ');
					$req_friend_dem->execute(array($friendnumdem));	
					$donnees_friend_dem=$req_friend_dem->fetch();
					
					$login=$donnees_friend_dem['login'];
					
					$country=$donnees_friend_dem['country'];
					
					if($donnees_friend_dem['gender']==0){
						$gender= 'Female';
					}else{
						$gender='Male';
					}
					
			?>
					<div class="profile profile-notification">
						<div class="left" style="height:100%">
							<div class="shape">
								<img src="images/female.png" alt="">
								<p class="Name">
									<?php echo $login;?>	
								</p>
							</div>
							
						</div>
						<div class="right" style="height:100%">
							<p class="wording text wording-notification">"I want to learn French"</p>
							<div class="center">
								<p class="nationality text notification">
									<?php echo $country; ?>
								</p>
								<p class="gender text notification">
									<?php echo $gender; ?>
								</p>
							</div>
							<ul class="interest interest-notification">
								<?php
									$req_topic_friend_dem = $bdd->prepare('SELECT DISTINCT topic_name FROM tbl_topic AS t, tbl_topic_user AS tu WHERE t.topic_number=tu.topic_number AND tu.user_number = ?');
									$req_topic_friend_dem->execute(array($friendnumdem));	
									while ($topic_dem = $req_topic_friend_dem->fetch()){
					
										echo '<li class="interest-tag notification-tag">'.$topic_dem[0].'</li>';
									}
									$req_topic_dem->closeCursor();
								?>
							</ul>
						</div>
						<div class="clearfix"></div>
						<a class="invite relationship check" href="add_friend_answer.php?case=1&numdem=<?php echo $num_demand[2];?>">Cancel</a>
						<a class="invite relationship check" href="add_friend_answer.php?case=2&numdem=<?php echo $num_demand[2];?>">Accept</a>
					</div>
			<?php
				}
				$req_friend_dem->closeCursor();
			?>
		</div>



	   
	    <a href="" class="ui-btn ui-icon-plus ui-btn-icon-left">Add Friend</a>
	    <a href="" class="ui-btn ui-icon-edit ui-btn-icon-left">Add interest</a>
	    <a href="" class="ui-btn ui-icon-gear ui-btn-icon-left">Setting</a>
	</div>


<!---	
*
*
*	Middle of the page, manage your relationship suggestion
*
*
-->

	<?php
		
		
		
		
		$req_num_rel=$bdd->prepare('SELECT DISTINCT relationship_number FROM tbl_relationship WHERE (user_number1= ? OR user_number2 = ?) AND invitation = 0 ORDER BY frequency DESC');
		$req_num_rel->execute(array($usnum,$usnum));
		
		while($num_rel = $req_num_rel->fetch()){
		
			$req_num_friend=$bdd->prepare('SELECT user_number1, user_number2 FROM tbl_relationship WHERE relationship_number= ?');
			$req_num_friend->execute(array($num_rel[0]));
			$friend_num=$req_num_friend->fetch();
			$req_num_friend->closeCursor();
			
			if($friend_num[0]==$usnum){
				$friendnum= $friend_num[1];
			}else{
				$friendnum= $friend_num[0];
			}
			
			$req2 = $bdd->prepare('SELECT * FROM tbl_users WHERE user_number = ? ');
			$req2->execute(array($friendnum));	
			$donnees2=$req2->fetch();
			
			$login=$donnees2['login'];
			
			$country=$donnees2['country'];
			
			if($donnees2['gender']==0){
				$gender= 'Female';
			}else{
				$gender='Male';
			}
		
	?>
	
	<div data-role="content" class="content">
		<div class="profile2 profile">
			<div class="left" style="height:100%">
				<div class="shape">
					<img src="images/female.png" alt="">
					<p class="Name">
						<?php echo $login;?>	
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
						$req3->execute(array($friendnum));	
						while ($donnees3 = $req3->fetch()){
		
							echo '<li class="interest-tag">'.$donnees3[0].'</li>';
						}
						$req3->closeCursor();
					?>
				</ul>
				
			</div>
			<div class="clearfix"></div>
			<a class="invite relationship" href="relationship_view.php?friendnum=<?php echo $friendnum; ?>">Manage Your Relationship</a>
		</div>
			
		
		
	</div>

	<?php
		}
		$req_num_rel->closeCursor();
	?>
	
	
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
</html>




