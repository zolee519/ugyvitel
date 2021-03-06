<?php

function insertLoginAttempt($ip,$browser)
{
	global $connection;
	$query="INSERT INTO `loginattempt`(`ip`, `browser`) VALUES ('$ip','$browser')";
	$result = mysqli_query($connection, $query) or die (mysqli_error($connection));
}

function getIP(){
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }

    return $ip;
}

function LoginCounter($ip)
{
	global $connection;
	$query="SELECT COUNT(`ip`) 
			FROM `loginattempt` 
			WHERE `ip`='$ip' AND `tryingtime` > (now() - interval 10 minute)
			group by `ip`";
	$result = mysqli_query($connection, $query) or die (mysqli_error($connection));
	$count = mysqli_fetch_array($result, MYSQLI_NUM);

	return (int)$count[0];
	
}

function GetPrilogName($id_string)
{
	$names = array();
	global $connection;
	$x = explode(' ',$id_string);
	$y = count($x);
	for($i=0;$i<$y;$i++)
	{
		$id = $x[$i];
		$query = "SELECT prilog_name_hu FROM prilog WHERE prilog_id = $id";
		$result = mysqli_query($connection, $query) or die (mysqli_error($connection));
		$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
		array_push($names, $row['prilog_name_hu']);
	}
	return $names;
}

function GetPrilogPrice($id_string)
{
	$prices = array();
	global $connection;
	$x = explode(' ',$id_string);
	$y = count($x);
	for($i=0;$i<$y;$i++)
	{
		$id = $x[$i];
		$query = "SELECT prilog_price FROM prilog WHERE prilog_id = $id";
		$result = mysqli_query($connection, $query) or die (mysqli_error($connection));
		$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
		array_push($prices, $row['prilog_price']);

	}
	$prices2 = implode(',',$prices);
	return $prices2;
}

function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}
?>