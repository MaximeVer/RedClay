<?php 
	session_start();
	if($_SESSION['connec']!=1){
		header('Location:index.php?case=1');
	}
	
	$usnum = $_SESSION['usnum'];
	
	$num_topic= $_GET['topic'];
	$friendnum=$_GET['friendnum'];
	
	
	/*
	*
	* Database Connection
	*
	*/
	
	try{
		$bdd = new PDO('mysql:host=localhost;dbname=redclay', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
	}
	catch(Exception $e){
		
		die('Error: '. $e->getMessage());
	}
	
	$req_topic_name=$bdd->prepare('SELECT topic_name, chinese_name FROM tbl_topic  WHERE topic_number= '.$num_topic);
	$req_topic_name->execute();
	$info_topic = $req_topic_name->fetch();
	$topic_name = $info_topic[0];
	$chinese=$info_topic[1];

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Vocabulary</title>
	<meta charset="UTF-8">
	<title>Vocabulary</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
	<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
	<link rel="stylesheet" href="css/vacabulary-new.css">

</head>




<body>
	<div data-role="page" data-theme="c" id="lv1">
		
		<div class="header" data-role="header" data-position="fixed" data-theme="b">
			<a href="relationship_view.php?friendnum=<?php echo $friendnum;?>" data-role="button" data-icon="arrow-l" data-iconpos="notext" class="ui-btn-inline"></a>
			<h1>RedClay</h1>
		</div>
		
		<div data-role="content">
			<div class="category">
				<p class="english"><?php echo $topic_name ;?></p>
				<p class="chinese"><?php echo $chinese ;?></p>
				</br>
			</div>
			<div class="culture">
				<a href="culture.php?topic=<?php echo $num_topic; ?>&friendnum=<?php echo $friendnum; ?>" class="ui-btn ui-icon-carat-r ui-btn-icon-left ui-culture">View some culture difference in <?php echo $topic_name ;?></a>
			</div >
			
			<div data-role="navbar">
	      		<ul>
			        <li class="btn-text"><a href="#" class="ui-btn-active btn-text bg">Level 1</a></li>
			        <li class="btn-text"><a href="#lv2" class="btn-text">Level 2</a></li>
			        <li class="btn-text"><a href="#lv3" class="btn-text">Level 3</a></li>
	      		</ul>
	    	</div>
			<div data-role="collapsibleset" data-theme='c' data-collapsed-icon="carat-d">
				<?php
					$req_selec_mot=$bdd-> prepare('SELECT chinese_word, pinyin, english_word FROM tbl_vocabulary WHERE level = ? AND topic_number = ?');
					$req_selec_mot->execute(array(1,$num_topic));
				
				
				
				
					while($word=$req_selec_mot->fetch()){ 
				
				?>
				
				
					
						<div data-role="collapsible" class='vacabulary'>
							<h3><?php echo $word[0]; ?></h3>
							<p><?php echo $word[1].'</br>'.$word[2]; ?></p>
						</div>
						
					<?php
					}
					$req_selec_mot->closeCursor();
					?>
			</div>
		</div>
	</div>
	<div data-role="page" data-theme="c" id='lv2'>
		
		
		<div class="header" data-role="header" data-position="fixed" data-theme="b">
			<a href="relationship_view.php?friendnum=<?php echo $friendnum;?>" data-role="button" data-icon="arrow-l" data-iconpos="notext" class="ui-btn-inline"></a>
			<h1>RedClay</h1>
		</div>
		
		<div data-role="content">
			<div class="category">
				<p class="english"><?php echo $topic_name ;?></p>
				<p class="chinese"><?php echo $chinese ;?></p>
				</br>
			</div>
			<div class="culture">
				<a href="culture.php?topic=<?php echo $num_topic; ?>&friendnum=<?php echo $friendnum; ?>" class="ui-btn ui-icon-carat-r ui-btn-icon-left ui-culture">View some culture difference in <?php echo $topic_name ;?></a>
			</div>
			<div data-role="navbar">
	      		<ul>
			        <li class="btn-text"><a href="#lv1" class="btn-text ">Level 1</a></li>
			        <li class="btn-text"><a href="#" class="btn-text ui-btn-active bg">Level 2</a></li>
			        <li class="btn-text"><a href="#lv3" class="btn-text">Level 3</a></li>
	      		</ul>
	    	</div>
			<div data-role="collapsibleset" data-theme='c' data-collapsed-icon="carat-d">
					
					<?php
					$req_selec_mot=$bdd-> prepare('SELECT chinese_word, pinyin, english_word FROM tbl_vocabulary WHERE level = ? AND topic_number = ?');
					$req_selec_mot->execute(array(2,$num_topic));
				
				
				
				
				while($word=$req_selec_mot->fetch()){ 
				
				?>
				
				
						<div data-role="collapsible" class='vacabulary'>
							<h3><?php echo $word[0]; ?></h3>
							<p><?php echo $word[1].'</br>'.$word[2]; ?></p>
						</div>
					
				<?php
				}
				$req_selec_mot->closeCursor();
				?>
			</div>
		</div>
					
				
		
	</div>
	<div data-role="page" data-theme="c" id='lv3'>
		
		
		<div class="header" data-role="header" data-position="fixed" data-theme="b">
			<a href="relationship_view.php?friendnum=<?php echo $friendnum;?>" data-role="button" data-icon="arrow-l" data-iconpos="notext" class="ui-btn-inline"></a>
			<h1>RedClay</h1>
		</div>
		
		<div data-role="content">
			<div class="category">
				<p class="english"><?php echo $topic_name ;?></p>
				<p class="chinese"><?php echo $chinese ;?></p>
				</br>
			</div>
			<div class="culture">
				<a href="culture.php?topic=<?php echo $num_topic; ?>&friendnum=<?php echo $friendnum; ?>" class="ui-btn ui-icon-carat-r ui-btn-icon-left ui-culture">View some culture difference in <?php echo $topic_name ;?></a>
			</div>
			<div data-role="navbar">
				<ul>
					<li class="btn-text"><a href="#lv1" class="btn-text ">Level 1</a></li>
					<li class="btn-text"><a href="#lv2" class="btn-text">Level 2</a></li>
					<li class="btn-text"><a href="#" class="btn-text bg">Level 3</a></li>
				</ul>
			</div>
			<div data-role="collapsibleset" data-theme='c' data-collapsed-icon="carat-d">
				
				<?php
				$req_selec_mot=$bdd-> prepare('SELECT chinese_word, pinyin, english_word FROM tbl_vocabulary WHERE level = ? AND topic_number = ?');
				$req_selec_mot->execute(array(1,$num_topic));
			
			
			
				
				while($word=$req_selec_mot->fetch()){ 
				
				?>
				
					
						
						<div data-role="collapsible" class='vacabulary'>
							<h3><?php echo $word[0]; ?></h3>
							<p><?php echo $word[1].'</br>'.$word[2]; ?></p>
						</div>
						
				<?php
				}
				$req_selec_mot->closeCursor();
				?>
					
			</div>
		</div>
	</div>
			
		</div>
	</div>
</body>
</html>