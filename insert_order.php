<?php
require "db_config.php";

session_start();
$user_id = $_SESSION['user_id'];

$error = [];
if(isset($_POST)){

	if(isset($_POST['prilog'])) 
    {
        $prilog = mysqli_real_escape_string($connection, trim($_POST['prilog']));
        $prilog2 = substr($prilog, 8);
    }
    else
    {
        $prilog = '' ;
    }

    if(isset($_POST['price'])) 
    {
        $price = mysqli_real_escape_string($connection, trim($_POST['price']));
    }else
    {
        $price = '';
    }

    if(isset($_POST['quantity'])) 
    {
        $quantity = mysqli_real_escape_string($connection, trim($_POST['quantity']));
    }else
    {
        $quantity = '';
    }

    if(!empty($error))
    {
        for($i=0; $i<count($error); $i++)
        {
            echo $error[$i]."\n";
        }
        exit();
    }
    else
    {

        $query = "INSERT INTO `orders2`(`order_id`, `user_id`, `prilog`, `quantity`, `price`, `shipped`, `in_progress`) VALUES (order_id,$user_id,'$prilog2',$quantity,$price,0,0)";
    }

    $result = mysqli_query($connection,$query);
    if($result)
    {
        echo "Successfull order";
        exit;
    }
    else
    {
        echo "Error inserting";
        exit;
    }
}
?>