<?php 
session_start();
require ("db_config.php");
require ("config.php");
require ("functions.php");
$username="";
$password="";

if(isset($_POST['password']) && strlen($_POST['password'])>=5 && strlen($_POST['password'])<=40)
    $password = trim(mysqli_real_escape_string($connection,trim($_POST["password"])));

if(isset($_POST['username']) && strlen($_POST['username'])>=5 && strlen($_POST['username'])<=40)
    $username =trim(mysqli_real_escape_string($connection,trim($_POST["username"])));

if(LoginCounter(getIP())<10)
{
    if(isset($_POST['token']) && isset($_SESSION['token']) 
        && $_POST['token']==$_SESSION['token'] && isset($_SESSION['secret']) 
        && $_SESSION['secret']==SECRET)
    {

        $tmppsw=md5(SALT1.$password.SALT2);
        $query = "SELECT worker_id, username, password FROM worker WHERE username='$username' AND password='$tmppsw'";
        $result=mysqli_query($connection, $query) or die (mysqli_error($connection));
        if(mysqli_num_rows($result)>0){
            while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){

                    $_SESSION['worker_id']=$row['worker_id'];
                    header("location: adminsite.php"); exit;
            }
            mysqli_free_result($result);
        }
        else{
            
            insertLoginAttempt(getIP(),$_SERVER['HTTP_USER_AGENT']);
            header('location:index.php?error=1');
            mysqli_close($connection);
            exit;
        }
    }
    else{
        insertLoginAttempt(getIP(),$_SERVER['HTTP_USER_AGENT']);
        header('location:index.php?error=2');
        mysqli_close($connection);
        exit;
    }
}
else{
        header('location:index.php?error=3');
        mysqli_close($connection);
        exit;
}