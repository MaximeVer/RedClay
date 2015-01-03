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
	<title>Culture</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
	<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
	<link rel="stylesheet" href="css/vacabulary-new.css">
	<link rel="stylesheet" href="css/culture.css">
</head>
<body>
	<div data-role="page" data-theme="c">
		<div class="header" data-role="header" data-position="fixed" data-theme="b">
			<a href="vocabulary.php?friendnum=<?php echo $friendnum;?>&topic=<?php echo $num_topic; ?>" data-role="button" data-icon="arrow-l" data-iconpos="notext" class="ui-btn-inline"></a>
			<h1>RedClay</h1>
		</div>

		<div data-role="content">
			<div class="category">
				<p class="english"><?php echo $topic_name ;?></p>
				<p class="chinese"><?php echo $chinese ;?></p>
			</div>
		</div>

		<?php
			$req_selec_culture=$bdd-> prepare('SELECT title, text FROM tbl_cultural_point WHERE topic_number = ?');
			$req_selec_culture->execute(array($num_topic));
		
		
		
		
			while($culture=$req_selec_culture->fetch()){ 
		
		?>
		
				<div class="culture">
					<p><?php echo $culture[0];?></p>
				</div>

				<div class="culture-point">
					<p><?php echo $culture[1];?></p>
				</div>
			
				
				
			<?php
			}
			$req_selec_culture->closeCursor();
			?>


</body>
</html>