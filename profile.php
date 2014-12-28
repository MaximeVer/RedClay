<div class="profile">
	<div class="left" style="height:100%">
		<div class="shape">
			<img src="images/female.png" alt="">
			<p class="Name text">
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
</div>