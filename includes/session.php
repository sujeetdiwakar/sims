<?php
	include_once "connect.php";
	session_start();
	$username = $_REQUEST['username'];
	if(empty($username))
		$username = $_SESSION['username'];
	$password = $_REQUEST['password'];
	if(empty($password))
		$password = $_SESSION['password'];
	$q = "select count(*) total from user_registration where username = '$username' AND password = PASSWORD('$password')";
	$qr = mysqli_query($conn, $q) or die($q);
	$r = mysqli_fetch_object($qr);
	$total = $r->total;
	if($total==1)
	{
		$_SESSION['username'] = $username;
		$_SESSION['password'] = $password;
		$logged_in = true;
	}
	else
	{
		session_destroy();
		$logged_in = false;
	}
?>
