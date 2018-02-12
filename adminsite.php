<?php
session_start();
require ("db_config.php");
require ("config.php");
require ("functions.php");
if(!isset($_SESSION['worker_id']))
{
	header("Location: index.php");
}
?>
<html>
<head>
	<title>Rocket Pizza</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="index.css">
	<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
	<script src="js/functions.js"></script>
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
	<script>
	function refreshOrders(){
		document.getElementById("table").innerHTML = '<img src="img/spinner.gif" alt="loading" style="margin: 0 auto;">';
		setInterval(function(){ 
			var xhttp = new XMLHttpRequest();
  			xhttp.onreadystatechange = function() {
    		if (this.readyState == 4 && this.status == 200) {
      		document.getElementById("table").innerHTML =
      		this.responseText;
    		}
  		};
  		xhttp.open("GET", "admin.php", true);
		xhttp.send();
		}, 4000);
		};
	</script>
	<div>
	<div id="table">Please press refresh button.</div>
		<div class="centering">
			<br><button onclick="refreshOrders()">REFRESH</button>
		</div>
	</div>
	<div class="footer">Doszkocs Zoltán 2017 All Rights Reserved</div>
</div>
</body>
</html>