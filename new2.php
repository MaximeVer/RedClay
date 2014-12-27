<?php

session_start();
 
$_SESSION['login'] = 'Tony';





session_destroy();


?>
 


<form action="homepage.php" method="post">
	<p>
	<input type="login" name="loginfilled" />
	<input type="password" name="passwordfilled" />
	<input type="submit" value="Valider" />
	</p>
 </form>

