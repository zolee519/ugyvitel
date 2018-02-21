<?php
session_start();
if(!isset($_SESSION['user_id']))
{
	header("location: index.php");
}
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
			<td>
				Telefon: +381621082640 <br>
				Cím: Ady Endre 44, Szabadka
			</td>
		</tr>
		</table>
	</div>
	<div class="sitebody">
		<ul>
	  		<li><a href="index.php">Kezdőlap</a></li>
	  		<li><a href="pizzas.php">Étlap</a></li>
	  		<li><a class="active" href="#">PizzaMaker</a></li>
	  		<li><a href="contact.php">Elérhetőségek</a></li>
	  		<li style="float: right"><a href="#"><i class="fas fa-sign-in-alt"></i>&nbsp;Bejelentkezés</a></li>
		</ul>
	</div>
	<div class="sitebody2">
		<div class="content">
			<div class="options">
				<?php 				
    				$sql = "SELECT * FROM prilog ORDER BY prilog_id asc";
    				$prilogData1 = mysqli_query($connection, $sql);
					while($row = mysqli_fetch_array($prilogData1))
					{
						echo '<div class="icondiv">';
					    echo "<img id='".$row['prilog_id']."' src='img/ikonok/".$row['prilog_name_eng'].".png' alt='".$row['prilog_name_eng']."' draggable='true' ondragstart='drag(event)'>";
					    echo '</div>';
					}
				?>
				<div class="icondiv">
					<img src="img/prilogslot.jpg" alt="emptyslot" width="90%">
				</div>
				<div class="icondiv">
					<img src="img/prilogslot.jpg" alt="emptyslot" width="90%">
				</div>
				<div class="icondiv">
					<img src="img/prilogslot.jpg" alt="emptyslot" width="90%">
				</div>
				<div class="icondiv">
					<img src="img/prilogslot.jpg" alt="emptyslot" width="90%">
				</div>
				<div class="icondiv">
					<img src="img/prilogslot.jpg" alt="emptyslot" width="90%">
				</div>
			</div>
			<?php
					if(isset($_SESSION['user_id']))
					{
						$user_id = $_SESSION['user_id'];
						$savedsql = "SELECT * FROM favourites WHERE user_id = $user_id";
    					$listData = mysqli_query($connection, $savedsql);
    					echo '<select id="pizzaload" name="pizzaload">';
						while ($row = mysqli_fetch_array($listData))
						{
							echo "<option value='".$row['fav_id']."'>".$row['name']."</option>";
						}
						echo '</select>';
					}
					else
					{
						echo 'Not logged in.';
					}
			 ?>
			<button id="load" onclick="LoadPizza()" class="loadbtn">LOAD</button>

			<div class="table" ondrop="drop(event)" ondragover="allowDrop(event)">
				<?php 
    				$sql = "SELECT * FROM prilog ORDER BY prilog_id asc";
    				$prilogData = mysqli_query($connection, $sql);
					while ($row = mysqli_fetch_array($prilogData))
					{
					    echo "<img id='".$row['prilog_id']."1' src='".$row['prilog_img']."' alt='".$row['prilog_name_hu']."' class='".$row['prilog_name_eng']."'>";
					}
				?>
				<button id="undo" onclick="undoFunction()" class="undobtn">UNDO</button>
			</div>
		</div>
		<div class="centering">
			<input type="radio" name="size" value="M" onclick="changeSize(1)" checked="checked"> M
  			<input type="radio" name="size" value="L" onclick="changeSize(1.5)"> L
  			<input type="radio" name="size" value="XL" onclick="changeSize(2)"> XL
			<input type="radio" name="size" value="XXL" onclick="changeSize(2.5)"> XXL
			<p id ="showprice">150 Din</p>
			<p id ="added">Added: (nothing yet)</p>
			<table class="tablecenter">
				<tr>
					<td>
						<label>Quantity:</label>
					</td>
					<td>
						<input type="number" min="1" id="quantity" value="1" oninput="changeQuantity()">
					</td>
				</tr>
			</table>
			<button id="send" onclick="SendOrder()">ORDER</button><br>
			<input type="text" name="savename" id="savename">
			<button id "save" onclick="SaveOrder()">SAVE</button>
		</div>
	</div>
	<div class="footer">Doszkocs Zoltán 2017 All Rights Reserved</div>
</div>
</body>
</html>