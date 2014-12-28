<?php

	try{
		$bdd = new PDO('mysql:host=localhost;dbname=redclay', 'root', '',array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
	}
	catch(Exception $e){
		die('Error: '. $e->getMessage());
	}

	// number of category 
	
	$req = $bdd->prepare('INSERT INTO tbl_vocabulary VALUES ("","test","我","test",1)');
	$req->execute();
	
	$req = $bdd->prepare('SELECT pinyin FROM tbl_vocabulary WHERE word_number = 7');
	$req->execute();
	$mot=$req->fetch();
	echo 'tttttttt  '.$mot[0];
	
	
?>