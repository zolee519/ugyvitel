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
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.1.6/css/swiper.min.css">
	<link rel="stylesheet" href="index.css">
	<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
	<link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.1.6/js/swiper.js"></script>
</head>
<body>
<div class="wrapper">
	<div class="title">
		<table style="color: white;">
			<tr>
				<td style="width: 35%;">
					<img src="img/logo2.png" alt="logo" width="80%">
				</td>
				<td>
					Ön nincs bejelentkezve. <br>
					Ha még nem regisztrált, azt ITT megteheti.
				</td>
				<td style="text-align: right;">
					Telefon: +381621082640 <br>
					Cím: Ady Endre 44, Szabadka
				</td>
			</tr>
		</table>
	</div>
	<div class="sitebody">
		<ul>
	  		<li><a href="index.php">Kezdőlap</a></li>
	  		<li><a class="active" href="#">Étlap</a></li>
	  		<li><a href="pizzamake.php">PizzaMaker</a></li>
	  		<li><a href="contact.php">Elérhetőségek</a></li>
	  		<li style="float: right"><a href="#"><i class="fas fa-sign-in-alt"></i>&nbsp;Bejelentkezés</a></li>
		</ul>
	</div>
		<div class="sitebody2">
				<h4>LIST OF PIZZAS</h4>
				<br><br><hr>
		</div>
	<div class="footer">Doszkocs Zoltán 2017 All Rights Reserved</div>
</div>
</body>
</html>