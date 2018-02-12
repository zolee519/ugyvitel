<?php
require "db_config.php";

$worker_id = $_POST['worker_id'];
$order_id = $_POST['order_id'];

$query = "INSERT INTO order_pickup(worker_id,order_id)
                  VALUES($worker_id,$order_id)";

$query2 = "UPDATE orders2 SET shipped = 1 WHERE order_id = $order_id";
    
    $result = mysqli_query($connection,$query);
    $result2 = mysqli_query($connection, $query2);
    if($result)
    {
    	if($result2)
    	{
        	echo "Successfull order";
        	exit;
        }
    }
    else
    {
        echo "Error inserting";
        exit;
    }
?>