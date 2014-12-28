<?php

	session_start();
	if($_SESSION['connec']!=1){
		header('Location:index.php?case=1');
	}
	

	$friendnum=$_GET['friendnum'];
	$usnum=$_SESSION['usnum'];

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
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script src="//code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
	<link rel="stylesheet" href="css/addfriend-new.css">
	<link rel="stylesheet" href="css/relationship.css">
	<link rel="stylesheet" href="css/chat.css">
	<script>
    (function (document, $) {

      var now = new Date;
      var genid = "id_gen_" + now.getTime();

      $(document).on('pageinit', '#page-chat', function () {
        loadJS('https://cdn.firebase.com/js/client/1.1.1/firebase.js', function () {

          var myDataRef = new Firebase('https://sizzling-torch-5038.firebaseio.com/');

          $('#messageInput').keypress(function (e) {
            if (e.keyCode == 13) {
              var userid = genid;
              var name = "Tony";
              var text = $('#messageInput').val();
              myDataRef.push({
                name: name,
                text: text,
                userid: userid
              });
              $('#messageInput').val('');
            }
          });
          myDataRef.on('child_added', function (snapshot) {
            var message = snapshot.val();
            displayChatMessage(message.name, message.text, message.userid);
          });

          function displayChatMessage(name, text, userid) {
            $('#messagesDiv').prepend(
              '<div class="' + userid + '">' +
              '<div class="message">' + text + '</div>' +
              '<div class="name">' + name + '</div>' +
              '</div>'
            );
            if (userid == genid) {
              $('.' + userid).addClass('me');
            }
          };

        });
      });


      function loadJS(src, callback) {
        var head = document.getElementsByTagName("head")[0],
          script = document.createElement('script');
        script.src = src;
        script.onload = callback;
        script.onerror = function (e) {
          alert("failed: " + JSON.stringify(e));
        };
        head.appendChild(script);
        head.removeChild(script);
      }

    }(document, jQuery));
  </script>
</head>
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

	
	$common_topic=array();
	
	
	
	$req_own_topic=$bdd->prepare('SELECT topic_number FROM tbl_topic_user WHERE user_number = ?');
	$req_own_topic->execute(array($usnum));
	while($own_topic=$req_own_topic->fetch()){
		$req_other_topic=$bdd->prepare('SELECT topic_number FROM tbl_topic_user WHERE user_number = ? AND topic_number= ?');
		$req_other_topic->execute(array($friendnum,$own_topic[0]));
		
		if($req_other_topic->fetch()){
			array_push($common_topic,$own_topic[0]);
		}
	}
	$req_own_topic->closeCursor();
?>




<body>
	<div data-role="page" data-theme="c" id='page-suggestion'>
		<div class="header" data-role="header" data-position="fixed" data-theme="b">
			<a href="homepage.php" data-role="button" data-icon="arrow-l" data-iconpos="notext" class="ui-btn-inline"></a>
			
			<h1>RedClay</h1>
		</div>
		<?php
			
			$req_info_friend = $bdd->prepare('SELECT * FROM tbl_users WHERE user_number = ? ');
			$req_info_friend->execute(array($friendnum));	
			$donnees_friend=$req_info_friend->fetch();
			
			$login=$donnees_friend['login'];
			
			$country=$donnees_friend['country'];
			
			if($donnees_friend['gender']==0){
				$gender= 'Female';
			}else{
				$gender='Male';
			}
		
		?>
		<div class='content' class='conent'>
			<?php
				include ('profile.php');
			?>
			
			<div data-role="navbar">
	      		<ul>
			        <li class="btn-text"><a href="#" class="ui-btn-active btn-text bg" data-icon="navigation" data-iconpos="top">Suggestion</a></li>
			        <li class="btn-text"><a href="#page-chat" data-icon="comment" data-iconpos="top" class="btn-text">Chat</a></li>
			        <li class="btn-text"><a href="#page-learn" data-icon="star" data-iconpos="top" class="btn-text">Learn</a></li>
	      		</ul>
	    	</div>

	    	<div id="suggestion" class="suggestion">
				<?php
				for($indice=0;$indice<count($common_topic);$indice++){
				
				$req_topic_name=$bdd->prepare('SELECT topic_name FROM tbl_topic  WHERE topic_number= '.$common_topic[$indice]);
				$req_topic_name->execute();
				$name = $req_topic_name->fetch();
				
				?>
					<li class="interest-tag category"><?php echo $name[0];?></li>
					<div class="suggestion-detail">
						<h3 class="suggest-title">Jog in Yuan Ming Yuan park</h3>
						<a href="" class="location ui-btn ui-icon-location ui-btn-icon-left">Beijing</a>
					</div>
					<div class="suggestion-detail">
						<h3 class="suggest-title">Jog in Yuan Ming Yuan park</h3>
						<a href="" class="location ui-btn ui-icon-location ui-btn-icon-left">Beijing</a>
					</div>
	    		
				<?php 
				} 
				?>
				
	    	</div>
			
			


	    		
	    	</div>
		</div>
	</div>

	<div data-role="page" data-theme="c" id='page-chat'>
		<div class="header" data-role="header" data-position="fixed" data-theme="b">
			<a href="homepage.php" data-role="button" data-icon="arrow-l" data-iconpos="notext" class="ui-btn-inline"></a>
			<h1>RedClay</h1>
		</div>
		<div class='content' class='conent'>
				
			<?php
				include ('profile.php');
			?>
				
			<div data-role="navbar">
				<ul>
					<li class="btn-text"><a href="#page-suggestion" class="btn-text" data-icon="navigation" data-iconpos="top">Suggestion</a></li>
					<li class="btn-text"><a href="#" data-icon="comment" data-iconpos="top" class="bg ui-btn-active btn-text">Chat</a></li>
					<li class="btn-text"><a href="#page-learn" data-icon="star" data-iconpos="top" class="btn-text">Learn</a></li>
				</ul>
			</div>

			<div role="main" class="ui-content">
				<div id="messagesDiv"></div>
			</div>
			
			<div id="footer" data-role="footer" data-position="fixed" data-theme="a">
				
				<input type="text" id="messageInput" placeholder="Message">
			</div>
	    </div>
	</div>
	

	<div data-role="page" data-theme="c" id='page-learn'>
		<div class="header" data-role="header" data-position="fixed" data-theme="b">
			<a data-role="button" data-icon="arrow-l" data-iconpos="notext" class="ui-btn-inline" href="homepage.php"></a>
			<h1>RedClay</h1>
		</div>
		<div class='content' class='conent'>
			
			<?php
				include ('profile.php');
			?>
			
			<div data-role="navbar">
	      		<ul>
			        <li class="btn-text"><a href="#page-suggestion" class="btn-text" data-icon="navigation" data-iconpos="top">Suggestion</a></li>
			        <li class="btn-text"><a href="#page-chat" data-icon="comment" data-iconpos="top" class="btn-text">Chat</a></li>
			        <li class="btn-text"><a href="#" data-icon="star" data-iconpos="top" class="bg ui-btn-active btn-text">Learn</a></li>
	      		</ul>
	    	</div>
			
			<?php
				$number_other_topic = 9 - count($common_topic); 
				
				$conditions='1  ';
				
				for($indice=0;$indice<count($common_topic);$indice++){
					$conditions=$conditions.' AND topic_number != '.$common_topic[$indice];
				}
				$req_complete=$bdd->prepare('SELECT topic_number FROM tbl_topic  WHERE '.$conditions.' LIMIT '.$number_other_topic);
				$req_complete->execute();
				
				while($new_topic=$req_complete->fetch()){
					
					array_push($common_topic,$new_topic[0]);
				}
				$req_complete->closeCursor();
			
			for($i=0;$i<3;$i++){
			?>
			
			
				
				<div class="learn">
					<div class="ui-grid-b square first" style="height:100px">
						<div class="ui-block-a" style="height:100%">
							<div class="v-category color-a">
								<?php
								
									$req_topic_name=$bdd->prepare('SELECT topic_name FROM tbl_topic  WHERE topic_number= '.$common_topic[3*$i]);
									$req_topic_name->execute();
									$name = $req_topic_name->fetch();
									echo $name[0];
								?>
							</div>
						</div>
						<div class="ui-block-b" style="height:100%">
							<div class="v-category color-b">
								<?php
									$req_topic_name=$bdd->prepare('SELECT topic_name FROM tbl_topic  WHERE topic_number= '.$common_topic[3*$i+1]);
									$req_topic_name->execute();
									$name = $req_topic_name->fetch();
									echo $name[0];
								?>
							</div>
						</div>
						<div class="ui-block-c" style="height:100%">
							<div class="v-category color-c">
								<?php
									$req_topic_name=$bdd->prepare('SELECT topic_name FROM tbl_topic  WHERE topic_number= '.$common_topic[3*$i+2]);
									$req_topic_name->execute();
									$name = $req_topic_name->fetch();
									echo $name[0];
								?>
							</div>
						</div>
					</div>
				</div>
			
			<?php } ?>


	    		
		</div>
	</div>
</body>