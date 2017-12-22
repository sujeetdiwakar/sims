<?php
	include_once "includes/common.php";
	include_once "includes/connect.php";
	
	if(!empty($user_name))
	{
		$q = "select * from user_registration where username='$user_name'";
		$qr = mysqli_query($conn, $q) or die($q);
		$count = mysqli_num_rows($qr);
		if($count)
			echo "<span style='background: red; padding:2px; color:white;'>Not Available</span>";
		else
			echo "<span style='background: green; padding:2px; color:white;'>Available</span>";
	}
?>
