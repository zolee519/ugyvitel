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
?>