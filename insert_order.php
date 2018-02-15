<?php
require "db_config.php";
require "functions.php";

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
        $price = (int)$price;
    }else
    {
        $price = '';
    }

    if(isset($_POST['quantity'])) 
    {
        $quantity = mysqli_real_escape_string($connection, trim($_POST['quantity']));
    }
    else
    {
        $quantity = '';
    }

    if(isset($_POST['size']))
    {
        $size = mysqli_real_escape_string($connection, trim($_POST['size']));
    }
    else
    {
        $size='';
    }

    $size2 = 0;
    if($size=="M")
    {
        $size2 = 1;
    }
    if($size=="L")
    {
        $size2 = 1.5;
    }
    if($size=="XL")
    {
        $size2 = 2;
    }
    if($size=="XXL")
    {
        $size2 = 2.5;
    }

    $prices = GetPrilogPrice($prilog2);
    $prices2 = explode(',',$prices);
    $x = count($prices2);
    $allprice = 0;
    for($j=0; $j<$x; $j++)
    {
        $allprice = $allprice + $prices2[$j];
    }

    $allprice = $allprice + 150;
    $finalprice = $allprice * $quantity * $size2;


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

        $query = "INSERT INTO `orders2`(`order_id`, `user_id`, `prilog`, `size`, `quantity`, `price`, `shipped`, `in_progress`) VALUES (order_id, $user_id, '$prilog2', '$size', $quantity, $price, 0, 0)";
    }

    $result = mysqli_query($connection,$query);
    if($result)
    {
        echo $finalprice;
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