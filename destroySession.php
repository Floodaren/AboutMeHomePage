<?php 
	session_start();
	session_unset();
	session_destroy();
	setcookie("Admin", '$cookie_value', time()-3600, "/");
	header("Location: index.php");
?>

