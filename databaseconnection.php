<?php 
	$servername = "";
	$username = "";
	$password = "";
	$dbName = "";

	$conn = new mysqli($servername, $username, $password, $dbName);
	$conn->set_charset("utf8");
	if ($conn->connect_error) 
	{
		die("Connection failed: " . $conn->connect_error);
	}
	/*
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbName = "nicholas_portfolio";

	$conn = new mysqli($servername, $username, $password, $dbName);
	$conn->set_charset("utf8");
	if ($conn->connect_error) 
	{
		die("Connection failed: " . $conn->connect_error);
	}
	*/
?>

