<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Setting</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
	<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
	<link rel="stylesheet" href="css/setting.css">
</head>
<body>
	<div data-role="page" data-theme="c">
		<div class="header" data-role="header" data-position="fixed" data-theme="b">
			<a href="#" data-role="button" data-icon="arrow-l" data-iconpos="notext"></a>
			<h1>RedClay</h1>
		</div>
		<div data-role="content" data-theme="a">
			<p class="change">Change your password</p>
			<input type="password" name="password-old" id="password-old" placeholder="Type your original password here">
			<input type="password" name="password-new" id="password-new" placeholder="Type your new password here">
		</div>
		<div data-position="fixed" data-role="footer">
	    <div data-role="navbar">
	      <ul>
	        <li>
	          <a data-icon="edit">Submit</a>
	        </li>
	      </ul>
	    </div>
    </div>
	</div>
</body>
</html>