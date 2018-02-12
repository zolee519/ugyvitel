<?php
define("SALT1","a4f*ce91246a&e6e76e7d36%3f2ef92");
define("SALT2","3%2b#3273b15ae7da&a42451cc3e*0a2");
define("ADMIN","http://localhost/ugyvitel/admin.php");
//define("SALT1","a4f*ce91246a&e6e76e7d36%3f2ef92");
//define("SALT2","3%2b#3273b15ae7da&a42451cc3e*0a2");
define("SECRET",md5(SALT1."RoCkEtPiZzA".SALT2));

?>