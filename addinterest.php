<?php 
	session_start();
	if($_SESSION['connec']!=1){
		header('Location:index.php?case=1');
	}
	
	$usnum = $_SESSION['usnum'];
	
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Add interest</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
	<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
	<link rel="stylesheet" href="css/addinterest.css">
</head>
<body>
	<div data-role="page" data-theme="c">
		<div class="header" data-role="header" data-position="fixed" data-theme="b">
			<a href="homepage.php" data-role="button" data-icon="arrow-l" data-iconpos="notext"></a>
			<h1>RedClay</h1>
		</div>
		<form action="addinterest_post.php" method="post">	
			<div data-role="content" data-theme="a">
			<?php
			
				try{
					$bdd = new PDO('mysql:host=localhost;dbname=redclay', 'root', '');
				}
				catch(Exception $e){
					die('Error: '. $e->getMessage());
				}
				$req=$bdd->query('SELECT * FROM tbl_category');			
				while ($donnees = $req->fetch()){
			?>
		
			
					<div class="interest-category">
						<div class="category category1"><?php echo $donnees[1];?></div>
						<select name="cat<?php echo $donnees[0];?>[]" id="<?php echo $donnees[1]; ?>" multiple="multiple" data-native-menu="false" data-theme="a">
						<option>Choose your favorite</option>
						<?php
						$req2=$bdd->query('SELECT * FROM tbl_topic WHERE category_number='.$donnees[0]);
						while ($donnees2 = $req2->fetch()){
							$checked='';
							$req_existe=$bdd->query('SELECT * FROM tbl_topic_user WHERE user_number = '.$usnum.' AND topic_number = '.$donnees2[0]);
							while($req_existe->fetch()){$checked='selected';}
							$req_existe->closeCursor();
						?>
							<option value="<?php echo $donnees2[0].'"  '.$checked;?>><?php echo $donnees2[1];?></option>
						<?php
						}
						$req2->closeCursor();
						?>
						</select>
					</div>
				
				<?php
				}
				$req->closeCursor();
				?>
				
				
				
				
				
			</div>
		

	
			<div data-position="fixed" data-role="footer" data-theme='c'>
				<div data-role="navbar">
				  <ul>
					<li>
					<input type="submit" value="submit" data-icon="check" class="save" />
					 
					</li>
				  </ul>
				</div>
			</div>
		</form>
    </div>
</body>
</html>