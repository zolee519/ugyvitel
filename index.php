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
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.1.6/css/swiper.min.css">
	<link rel="stylesheet" href="index.css">
	<link href="https://fonts.googleapis.com/css?family=Patua+One" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
	<link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.1.6/js/swiper.js"></script>
</head>
<body>
<div class="wrapper">
	<div class="title">
		<table class="toptext">
		<tr>
			<td style="width: 35%;">
				<img src="img/logo2.png" alt="logo" width="80%">
			</td>
			<td>
				<i class="fas fa-exclamation-circle"></i>&nbsp;Ön nincs bejelentkezve. <br>
				Ha még nem regisztrált, azt ITT megteheti.
			</td>
			<td style="text-align: right;">
				+381621082640&nbsp;<i class="fas fa-phone-square"></i><br>
				Ady Endre 44, Szabadka&nbsp;<i class="fas fa-map-marker"></i><br>
				rocketpizza&nbsp;<i class="fab fa-instagram"></i><br>
				rocketpizzasu&nbsp;<i class="fab fa-facebook-square"></i>
			</td>
		</tr>
		</table>
	</div>
	<div class="sitebody">
		<ul>
	  		<li><a class="active" href="#">Kezdőlap</a></li>
	  		<li><a href="pizzas.php">Étlap</a></li>
	  		<li><a href="pizzamake.php">PizzaMaker</a></li>
	  		<li><a href="contact.php">Elérhetőségek</a></li>
	  		<li style="float: right"><a href="#"><i class="fas fa-sign-in-alt"></i>&nbsp;Bejelentkezés</a></li>
		</ul>
		<div class="swiper-container">
		    <div class="swiper-wrapper">
		      <div class="swiper-slide" style="background-image: url('img/swiper/1.jpg');"></div>
		      <div class="swiper-slide" style="background-image: url('img/swiper/2.jpg');"></div>
		      <div class="swiper-slide" style="background-image: url('img/swiper/3.jpg');"></div>
		    </div>
		    <!-- Add Pagination -->
		    <div class="swiper-pagination"></div>
		    <!-- Add Arrows -->
		    <div class="swiper-button-next swiper-button-white"></div>
		    <div class="swiper-button-prev swiper-button-white"></div>
	  	</div>
		<div class="sitebody2">
		<div class="inactivecontent1">
			<h2>RÓLUNK</h2>
			<?php 
				/*if(isset($_SESSION['user_id']))
				{
					include ("menu.php");
				}
				else
				{
					echo '<form action="login.php" method="POST">
							<label>Username: </label><input type="text" name="username" class="rp_input">
							<label>Password: </label><input type="password" name="password" class="rp_password">
							<input type="hidden" name="token" value="'.$token.'">
							<input type="submit" value="Login"><br>
						</form>';
				}*/
				include("order_status.php");
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
			<br>
			<p class="titletext">HOGYAN KEZDŐDÖTT</p>
			<table>
				<tr>
					<td style="width: 50%;">
					<img src="img/chef1.png" alt="pizza chef" width="100%">
					</td>
					<td style="padding: 10px; text-align: justify;">
					Sed ultricies tristique metus porttitor aliquam. Donec id metus ac ante ullamcorper congue nec eu mauris. Ut in facilisis dolor, sed porttitor turpis. Ut ac nulla massa. Donec quis risus sodales, sagittis odio at, consequat tortor. Vivamus elementum mauris metus, id cursus nunc lacinia sit amet. Cras sit amet nulla ornare, mollis sem a, fermentum tellus. Aenean at condimentum est, vel aliquam massa. Suspendisse laoreet et ultricies velit, sed consectetur lacus scelerisque eget. Integer ac erat eget dui mollis molestie ut eget diam. Vivamus nisl elit, convallis id mollis ut, placerat sed orci. Sed lacinia nisi ullamcorper urna scelerisque, sed iaculis nisi laoreet.
					</td>
				</tr>
			</table>
			<br>
		</div>
		<div class="inactivecontent2">
			<h2>VÉLEMÉNYEK</h2><br>
			<img src="img/chef2.png" alt="pizza chef" class="chef2">
			<img src="img/quote.png" alt="quotesign" class="quotesign" width="50px">
			<p class="quotetext">A leggyorsabb kiszállítás amit <br>valaha tapasztaltam!</p>
			<p class="quoteby"> - egy elégedett vásárló</p>
			<a href="contact.php" class="button2">RENDELJEN MOST</a>
		</div>
		<div class="inactivecontent3">
			<h2>RENDEZVÉNY</h2><br>
			<p class="titletext">RENDEZVÉNYT SZERVEZEL?</p><br>
			<p style="width: 600px; margin: 0 auto;">Sed ultricies tristique metus porttitor aliquam. Donec id metus ac ante ullamcorper congue nec eu mauris. Ut in facilisis dolor, sed porttitor turpis. Ut ac nulla massa. Donec quis risus sodales, sagittis odio at, consequat tortor. Vivamus elementum mauris metus, id cursus nunc lacinia sit amet. Cras sit amet nulla ornare, mollis sem a, fermentum tellus. Aenean at condimentum est, vel aliquam massa. Suspendisse laoreet et ultricies velit, sed consectetur lacus scelerisque eget.</p><br>
			<a href="contact.php" class="button1">KAPCSOLAT FELVÉTELE</a>
		</div>
		<div class="inactivecontent4">
			<h2>SAJÁT PIZZA</h2><br>
			<p class="titletext">CSINÁLD MAGAD</p><br>
			<p style="width: 600px; margin: 0 auto;">Sed ultricies tristique metus porttitor aliquam. Donec id metus ac ante ullamcorper congue nec eu mauris. Ut in facilisis dolor, sed porttitor turpis. Ut ac nulla massa. Donec quis risus sodales, sagittis odio at, consequat tortor. Vivamus elementum mauris metus, id cursus nunc lacinia sit amet. Cras sit amet nulla ornare, mollis sem a, fermentum tellus. Aenean at condimentum est, vel aliquam massa. Suspendisse laoreet et ultricies velit, sed consectetur lacus scelerisque eget.</p><br>
			<a href="contact.php" class="button1">ELKÉSZÍTEM A SAJÁTOM</a>
		</div>
		<div class="inactivecontent5">
			<h2>MUTASD MEG</h2><br>
			<p class="titletext">KÜLD EL A SAJÁT PIZZÁID</p><br>
			<div class="images">
				<img src="img/kep1.jpg" alt="pizza kep" width="205px">
				<img src="img/kep2.jpg" alt="pizza kep" width="205px">
				<img src="img/kep3.jpg" alt="pizza kep" width="205px">
				<img src="img/kep4.jpg" alt="pizza kep" width="205px">
			</div><br>
			<p style="width: 800px; margin: 0 auto; text-align: center-justify;">Küld el a tőlünk rendelt pizzádról készült képeid és nyerj ár engedményeket a következő rendeléshez! Nincs más dolgod mint a kiválasztott képeket elküldened a rocketpizza@gmail.com e-mail címre és ha a kép elnyeri tetszésünket, máris jóváírjuk az engedményt a profilodban. A játék előtt kérjük olvasd el a feltételeinket.</p><br>
			<a href="contact.php" class="button1">FELTÉTELEK</a>
		</div>
	<div class="footer">Doszkocs Zoltán 2017 All Rights Reserved</div>
</div>
</div>
<script>
    var swiper = new Swiper('.swiper-container', {
      spaceBetween: 30,
      centeredSlides: true,
      autoplay: {
        delay: 4000,
        disableOnInteraction: false,
      },
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    });
  </script>
</body>
</html>