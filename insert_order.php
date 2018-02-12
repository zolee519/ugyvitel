<?php
require "db_config.php";

session_start();
$username = $_SESSION['username'];

$sql = "SELECT user_id FROM user WHERE username = '$username'";
$eredmeny = mysqli_query($connection, $sql);

while ($row = mysqli_fetch_array($eredmeny))
{
    $user_id = $row['user_id'];
}

$error = [];
if(isset($_POST)){

	if(isset($_POST['prilog'])) 
    {
        $prilog = mysqli_real_escape_string($connection, trim($_POST['prilog']));
        $prilog2 = substr($prilog, 7);
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
        $query = "INSERT INTO orders2(order_id,user_id,prilog,quantity,price)
                  VALUES(order_id,$user_id,'$prilog2',$quantity,$price)";
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