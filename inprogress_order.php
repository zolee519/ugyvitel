<?php
require "db_config.php";

$worker_id = $_POST['worker_id'];
$order_id = $_POST['order_id'];

$query = "UPDATE orders2 SET in_progress = 1 WHERE order_id = $order_id";
    
    $result = mysqli_query($connection,$query);
    if($result)
    {
    	if($result)
    	{
        	echo "It is in progress!";
        	exit;
        }
    }
    else
    {
        echo "Error!";
        exit;
    }
?>