<?php

	include_once "includes/session.php";
	include_once "functions/function.php";
	$title = "Home";

	if($logged_in){
		$main_menu = after_login_menu("home");
		$content ="<center><div class='home'>Welcome To Self Information Management System</div></center>";
	}
	else
		$content ="<h3>Invalid Login</h3>$_SESSION[password]<br>$_SESSION[username]<a href='index.php' class='btn btn-danger btn-sm'>Try again</a>";
	
	
	$buf = file_get_contents('template1.html');
	eval($buf);
	echo $page;
	
?>
