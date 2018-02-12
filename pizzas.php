<?php
session_start();
require ("db_config.php");
require ("config.php");
require ("functions.php");
require ("pizzamaker.php");
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
		<div class="inactivecontent">
			<?php 
				if(isset($_SESSION['user_id']))
				{
					echo '<a href="pizzamake.php">Pizza készítő</a><br>';
					echo '<a href="logout.php">Kijelentkezés</a>';
				}
				else
				{
					echo '<form action="login.php" method="POST">
							<label>Username: </label><input type="text" name="username" class="rp_input">
							<label>Password: </label><input type="password" name="password" class="rp_password">
							<input type="hidden" name="token" value="'.$token.'">
							<input type="submit" value="Login"><br>
						</form>';
				}

    			if(isset($_GET['error'])) 
    			{
					$x=$_GET['error'];
					switch ($x) 
					{
						case 1:echo "<script>alert('Hibás felhasználónév vagy jelszó!');</script>";
						break;
						case 2:echo "<script>alert('Valami nincs rendben, próbáljon meg később bejelentkezni.');</script>";
						break;
						case 3:echo "<script>alert('Próbáljon meg bejelentkezni 10 perc múlva.');</script>";
						break;
        				case 4:echo "<script>alert('Kérem jelentkezzen be.');</script>";
            			break;
					}
				}
			?>
			<img src="img/orderfast.png" alt="orderfast"><br><br>
			<h4>LIST OF PIZZAS</h4>
			<br><br><hr>
		</div>
	<div class="footer">Doszkocs Zoltán 2017 All Rights Reserved</div>
</div>
</body>
</html>