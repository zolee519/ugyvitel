<?php

  $con = mysqli_connect("localhost", "root", "", "rocketpizza");
  if (!$con) {
    echo "Connect Error: " .mysqli_connect_errno();
  }

  $sql = "SELECT * FROM orders ORDER BY id desc";
  $myData = mysqli_query($con, $sql);

  echo "<table border=1 style='margin: 0 auto;'>";
  echo "<th>Prilog </th>";
  echo "<th>First Name </th>";
  echo "<th>Last Name </th>";
  echo "<th>Adress </th>";
  echo "<th>Phone </th>";
  echo "<th>E-mail </th>";
  echo "<th>Quantity </th>";
  echo "<th>Price </th> </tr>";

  while ($row = mysqli_fetch_array($myData))
  {
    echo "<td>" .$row['prilog'] ."</td>";
    echo "<td>" .$row['firstname'] ."</td>";
    echo "<td>" .$row['lastname'] ."</td>";
    echo "<td>" .$row['adress'] ."</td>";
    echo "<td>" .$row['phone'] ."</td>";
    echo "<td>" .$row['email'] ."</td>";
    echo "<td>" .$row['quantity'] ."</td>";
    echo "<td>" .$row['price'] ."</td> </tr>";
  }

  echo "</table>";
?>