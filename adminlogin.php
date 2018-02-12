<?php
session_start();
require ("db_config.php");
require ("config.php");
require ("functions.php");
$token = sha1(uniqid());
$_SESSION['token'] = $token;
$_SESSION['secret'] = SECRET;
$try=LoginCounter(getIP());?>
<html>
<head>
	<title>Rocket Pizza</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="index.css">
	<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
</head>
<body>
<div class="wrapper">
	<div class="title">
		<img src="img/title.png" alt="rocketpizza" width="40%">
		<img src="img/logo.png" alt="logo" class="logo" width="12%">
		<img src="img/contact.png" alt="contact" class="contact">
	</div>
	<div class="sitebody">
	<h3 class="centering">ORDERS<h3><br>
	<div class="centering">
	<?php
		if(isset($_SESSION['waiter_id']))
		{
			header("Location: adminsite.php");
		}
		else
		{
			echo '<form action="wlogin.php" method="POST">
				<label>Username: </label><input type="text" name="username" class="rp_input">
				<label>Password: </label><input type="password" name="password" class="rp_password">
				<input type="hidden" name="token" value="'.$token.'">
				<input type="submit" value="Login"><br>
				</form>';
		}
	?>
	<div class="footer">Doszkocs Zoltán 2017 All Rights Reserved</div>
</div>
</body>
</html>