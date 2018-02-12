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
					echo '<a href="pizzamaker.php">Pizza készítő</a><br>';
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
			Sed ultricies tristique metus porttitor aliquam. Donec id metus ac ante ullamcorper congue nec eu mauris. Ut in facilisis dolor, sed porttitor turpis. Ut ac nulla massa. Donec quis risus sodales, sagittis odio at, consequat tortor. Vivamus elementum mauris metus, id cursus nunc lacinia sit amet. Cras sit amet nulla ornare, mollis sem a, fermentum tellus. Aenean at condimentum est, vel aliquam massa. Suspendisse laoreet ultricies velit, sed consectetur lacus scelerisque eget. Integer ac erat eget dui mollis molestie ut eget diam. Vivamus nisl elit, convallis id mollis ut, placerat sed orci. Sed lacinia nisi ullamcorper urna scelerisque, sed iaculis nisi laoreet.<br><br><hr>
			<img src="img/draganddrop.png" alt="draganddrop" width="50%"><br><hr><br>
		</div>
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
			<p class="advise">Are you hungry? Save some time for yourself, and fill every field correctly!</p>
			<button id="send" onclick="SendOrder()">ORDER</button><br>
			<input type="text" name="savename" id="savename">
			<button id "save" onclick="SaveOrder()">SAVE</button>
		</div>
	</div>
	<div class="footer">Doszkocs Zoltán 2017 All Rights Reserved</div>
</div>
</body>
</html>