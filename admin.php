<?php
  session_start();
  require("db_config.php");
  require("functions.php");

  $query = "SELECT orders2.in_progress, orders2.order_id, user.user_id, user.firstname, user.lastname, user.phone, user.address, orders2.prilog,orders2.size, orders2.quantity, orders2.price FROM orders2 INNER JOIN user ON orders2.user_id = user.user_id WHERE orders2.shipped = 0";
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
    echo "<th>Size </th>";
    echo "<th>Price </th> ";
    echo "<th>Ready</th>";
    echo "<th>In progress</th></tr>";

    while ($row = mysqli_fetch_array($myData))
    {
      if($row['in_progress'] == 0) 
      {
        echo "<tr>";
      }
      if($row['in_progress'] == 1)
      {
        echo "<tr style='background-color: orange; color: white;'>";
      }
      $prilog_name = GetPrilogName($row['prilog']);
      echo "<td>".$prilog_name."</td>";
      echo "<td>" .$row['firstname'] ."</td>";
      echo "<td>" .$row['lastname'] ."</td>";
      echo "<td>" .$row['address'] ."</td>";
      echo "<td>+381" .$row['phone'] ."</td>";
      echo "<td>" .$row['quantity'] ."</td>";
      echo "<td>" .$row['size']. "</td>";
      echo "<td>" .$row['price'] ."</td>";
      if($row['in_progress'] == 0)
      {
       echo "<td><input type='hidden' id='inprogress' name='inprogress' value='".$row['in_progress']."'><button onclick='PutInProgress(".$row['in_progress'].",".$row['order_id'].",".$_SESSION['worker_id'].")'>GET ORDER</button></td>";
       echo "<td><button disabled='true'>DELIVER</button></td></tr>";
      }
      if($row['in_progress'] == 1)
      {
       echo "<td><button disabled='true'>GET ORDER</button></td>";
       echo "<td><button onclick='DeliverOrder(".$row['in_progress'].",".$row['order_id'].",".$_SESSION['worker_id'].")'>DELIVER</button></td></tr>";
      }
    }
    echo "</table>";
  }
  else
  {
    echo "No new order.";
  }
?>