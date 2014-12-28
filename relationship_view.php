<?php

	session_start();
	if($_SESSION['connec']!=1){
		header('Location:index.php?case=1');
	}
	

	$friendnum=$_GET['friendnum'];
	echo'test'.$friendnum;

?>