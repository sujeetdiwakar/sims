<?php 
	
	include_once "includes/common.php";
	include_once "includes/connect.php";
	include_once "includes/session.php";
	if($logged_in=="true")
	{
		if($info_id)
		{
			$q = "delete from self_informations where id=$info_id";
			$qr = mysqli_query($conn, $q) or die($q);
			
			if($search_info)
				echo "<script>window.open('search.php','_self')</script>";
			else
				echo "<script>window.open('list_information.php','_self')</script>";

		}
	}
?>
