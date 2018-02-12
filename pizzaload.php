<?php
require "db_config.php";

session_start();
$user_id = $_SESSION['user_id'];
$selected = $_POST['selected'];

$sql = "SELECT prilog FROM favourites WHERE fav_id = $selected";
$eredmeny = mysqli_query($connection, $sql);
while ($row = mysqli_fetch_array($eredmeny))
{
	echo $row['prilog'];
}
