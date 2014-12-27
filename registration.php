<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Registration</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.css">
	<script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script>
</head>
<body>
	<div data-role="page">
		<div class="header" data-role="header">
			<h1>RedClay</h1>
		</div>
	
	<div data-role="content">
		<form action="registration_post.php" method="post">
			<div class="ui-grid-a">
				<div class="ui-block-a">
					<label for="fullname">Last name：</label>
				</div>
				<div class="ui-block-b">
					<input type="text" name="lastname" id="lastname">
				</div>
			</div>
			<div class="ui-grid-a">
				<div class="ui-block-a">
					<label for="fullname">First name：</label>
				</div>
				<div class="ui-block-b">
					<input type="text" name="firstname" id="firstname">
				</div>
			</div>
			<div class="ui-grid-a">
				<div class="ui-block-a">
					<label for="fullname">Login：</label>
				</div>
				<div class="ui-block-b">
					<input type="text" name="login" id="login">
				</div>
			</div>
			<div class="ui-grid-a">
				<div class="ui-block-a">
					<label for="fullname">Password：</label>
				</div>
				<div class="ui-block-b">
					<input type="password" name="password" id="password" type="password">
				</div>
			</div>
			<div class="ui-grid-a">
				<div class="ui-block-a">
					<label for="fullname">Gender：</label>
				</div>
				<div class="ui-block-b">
					<select name="gender" id="gender" data-role="slider">
					<option value=1>Male</option>
					<option value=0>Female</option>
					</select>
				</div>
			</div>
			<div class="ui-grid-a">
				<div class="ui-block-a">
					<label for="fullname">Home Country</label>
				</div>
				<div class="ui-block-b">
					<input type="text" name="country" id="country">
				</div>
			</div>
			<div class="ui-grid-a">
				<div class="ui-block-a">
					<label for="fullname">Language to learn：</label>
				</div>
				<div class="ui-block-b">
					<select name="lang_learnt" id="lang_learnt">
						<option value="chinese">Chinese</option>
					</select>
				</div>
			</div>
			
			<?php 
				if (isset($_GET['case'])){
					if ($_GET['case']=='1'){
			?>
			<div class="ui-grid-a">
				<div class="ui-block-a" style="color:red">
					<b>Please fill in all the required fields.</b>
				</div>
			</div>
			
				<?php 
				
				}elseif($_GET['case']=='2'){
				?>
				
			<div class="ui-grid-a">
				<div class="ui-block-a" style="color:red">
					<b>Login already exists.</b>
				</div>
			</div>
					
				<?php }} ?>
			
			<div data-position="fixed" data-role="footer">
				<div data-role="navbar">
				  <ul>
					<li>
					  <a data-icon="arrow-l" href="index.php">Go Back</a>
					</li>
					<li>
					  <input data-icon="edit" type="submit" value="submit" data-iconpos="top" />
					</li>
				  </ul>
				</div>
			</div>
		</form>
	</div>
</body>
</html>