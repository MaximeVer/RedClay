<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Welcome</title>
	<meta charset="UTF-8">
	<title>Registration</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.css">
	<link rel="stylesheet" href="css/welcome.css">
	<script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script>

	<script src="http://jqmdesigner.appspot.com/components/platform/platform.js"></script>
  <!-- <link rel="import" href="http://jqmdesigner.appspot.com/components/core-icons/core-icons.html"> -->
  <link rel="import" href="http://jqmdesigner.appspot.com/components/paper-input/paper-input.html">
  <!-- // <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> -->
  <!-- // <script src="//code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script> -->

</head>
<body>
	<div data-role="page">	
		<div class="header" data-role="header">
			<h1>RedClay</h1>
		</div>
		<div data-role="content" class="content">
			<form action="homepage.php" method="post">
				<paper-input label="Username"></paper-input>
				<paper-input label="Password" type="password"></paper-input>
				<input class="ui-btn" type="submit" value='Login'/>
			</form>
			<a href="registration.php" class="ui-link">
				<p  class="registration">Find your language partner now!</p>
			</a>
			<a href="registration.php" class="ui-link">
				<p  class="registration">現在就去找你的語伴吧!</p>
			</a>
		</div>
	</div>
</body>
</html>