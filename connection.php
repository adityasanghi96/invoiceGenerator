<?php
	error_reporting(0);
	session_start();
	ob_start();
	$con=mysqli_connect('127.0.0.1','root','') or die("Connection not found");
	mysqli_select_db($con,'invoice') or die("No DB");
?>