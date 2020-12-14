<?php
session_start();
$sname = session_name();
session_destroy();
if (isset($_COOKIE['login'])) {
	setcookie($sname, '', time()-3600, '/');
}

$message = 'successfully logged out';
echo "<script> alert('$message') 
window.location.replace('index.php');
</script>";

?>			