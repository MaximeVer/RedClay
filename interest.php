<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Interest</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.css">
	<script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script>
</head>
<body>
	<div data-role="page">
		<div class="header" data-role="header">
			<h1>RedClay</h1>
		</div>
	
		<?php
			try{
			$bdd = new PDO('mysql:host=localhost;dbname=redclay', 'root', '');
			}
			catch(Exception $e){
				die('Error: '. $e->getMessage());
			}
		?>
	<form action="interest_post.php" method="post">	
	<input type="hidden" name="usnum" value="<?php echo $_GET['usnum']; ?>"/>
	<div data-role="content">
		<div class="ui-grid-a">
			
			<?php
				$req=$bdd->query('SELECT * FROM tbl_category');			
				while ($donnees = $req->fetch()){
					echo "<div class='ui-block-a'><label for='fullname'>".$donnees[1]."：</label>";
					echo '</div>';
					echo '<div class="ui-block-b">';
					
					
					echo '<select name=cat'.$donnees[0].'[] id='.$donnees[1].' multiple="multiple" data-native-menu="false">';
					echo '<option >Choose your favorite '.$donnees[1].'</option>';
					$req2=$bdd->query('SELECT * FROM tbl_topic WHERE category_number='.$donnees[0]);
					while ($donnees2 = $req2->fetch()){
						echo '<option value='.$donnees2[0].'>'.$donnees2[1].'</option>';	
					}
					$req2->closeCursor();
					echo '</select>';
					echo '</div>';
				}
				$req->closeCursor();
			?>
		</div>
	</div>


	<div data-position="fixed" data-role="footer">
	    <div data-role="navbar">
	      <ul>
	        <li>
	          <a data-icon="arrow-l">Go Back</a>
	        </li>
	        <li>
				<input data-icon="edit" type="submit" value="submit" data-iconpos="top" />
	        </li>
	      </ul>
	    </div>
    </div>

	</form>
	</div>
</body>
</html>