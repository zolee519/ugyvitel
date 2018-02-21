<?php 			
				if(isset($_SESSION['user_id']))
				{
					$myuser = $_SESSION['user_id'];
					$query = "SELECT order_id, prilog, size, quantity, price, shipped, in_progress, order_time FROM orders2 WHERE user_id = $myuser AND order_time < (now() - interval 30 minute)";
					$result = mysqli_query($connection, $query) or die (mysqli_error($connection));
					if(mysqli_num_rows($result)>0){
					while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
					{
						/*$date1=date_create("2013-12-14 23:58:47");
						$date2=date_create("2013-12-15 00:47:47");
						$diff=date_diff($date1,$date2);
						$xyz = $diff->format("%R%h%i");
						var_dump($xyz);
						$orderdate = $row['order_time'];
						$to_time = time();
						var_dump($to_time);
						$from_time = strtotime($orderdate);
						var_dump($from_time);
						$time_remaining = round(abs($to_time - $from_time));
						var_dump(round($time_remaining/60));
						if(($time_remaining /60) < 30)
						{*/
							$prilognames = GetPrilogName($row['prilog']);
							$prilognames = implode(',', $prilognames);
							echo "<br>A pizza amit rendelt (".$prilognames.", ".$row['quantity']." darab, ".$row['price']." Din) állapota:<br>";
							if($row['in_progress'] == 0)
							{
								echo "<span style='color:green; font-weight: bold;'> Rendelés leadva </span>";
							}
							else
							{
								echo "<span style='color:grey'> Rendelés leadva </span>";
							}

							if($row['in_progress'] == 1 && $row['shipped'] == 0)
							{
								echo "<span style='color:green; font-weight: bold;'> A sütőben van! </span>";
							}
							else
							{
								echo "<span style='color:grey'> A sütőben van! </span>";
							}

							if($row['in_progress'] == 1 && $row['shipped'] == 1)
							{
								echo "<span style='color:green; font-weight: bold;'> Már úton van! </span><br>";
							}
							else
							{
								echo "<span style='color:grey'> Már úton van </span><br>";
							}

							/*if( ($time_remaining / 60) > 25)
							{
								echo "<span style='color:green; font-weight: bold;'> Perceken belül megérkezik! </span><br>";
							}
							else
							{
								echo "<span style='color:grey'> Perceken belül megérkezik! </span><br>";
							}
						}*/
	            	}
            	}
            }
          ?>