<?php
  session_start();
  require("db_config.php");

  $query = "SELECT orders2.order_id, user.user_id, user.firstname, user.lastname, user.phone, user.address, orders2.prilog, orders2.quantity, orders2.price FROM orders2 INNER JOIN user ON orders2.user_id = user.user_id WHERE orders2.shipped = 0";
  $myData = mysqli_query($connection, $query);
  var_dump($myData);
  if(mysqli_num_rows($myData)>0)
  {
    echo "<table border=1 style='margin: 0 auto;'>";
    echo "<th>Prilog </th>";
    echo "<th>First Name </th>";
    echo "<th>Last Name </th>";
    echo "<th>Adress </th>";
    echo "<th>Phone </th>";
    echo "<th>Quantity </th>";
    echo "<th>Price </th> ";
    echo "<th>Ready</th></tr>";

    while ($row = mysqli_fetch_array($myData))
    {
      echo "<td>" .$row['prilog'] ."</td>";
      echo "<td>" .$row['firstname'] ."</td>";
      echo "<td>" .$row['lastname'] ."</td>";
      echo "<td>" .$row['address'] ."</td>";
      echo "<td>+381" .$row['phone'] ."</td>";
      echo "<td>" .$row['quantity'] ."</td>";
      echo "<td>" .$row['price'] ."</td>";
      echo "<td><input type='hidden' id='order_id' name='order_id' value='".$row['order_id']."'>
      <input type='hidden' id='worker_id' name='worker_id' value='".$_SESSION['worker_id']."'><button onclick='DeliverOrder()'>DELIVER</button></tr>";
    }
    echo "</table>";
  }
  else
  {
    echo "No new order.";
  }
?>