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

<script>
function showUser(str) {
    if (str == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET","words.php?q="+str,true);
        xmlhttp.send();
    }
}
</script>



<body>
	<div data-role="page" data-theme="c">
		
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
				<a href="#" class="ui-btn ui-icon-carat-r ui-btn-icon-left ui-culture">View some culture difference in <?php echo $topic_name ;?></a>
			</div >
			<div id='txtHint'>
				<div data-role="collapsibleset" data-theme='c' data-collapsed-icon="carat-d" >
					
					<div style="color:red" >
						<h3>Click me - I'm collapsible!</h3>
						<p>I'm the expanded content.</p>
						</div>
					<div  class='vacabulary'>
						<h3>Click me - I'm collapsible!</h3>
						<p>I'm the expanded content.</p>
					</div>
					<div  class='vacabulary'>
						<h3>Click me - I'm collapsible!</h3>
						<p>I'm the expanded content.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>