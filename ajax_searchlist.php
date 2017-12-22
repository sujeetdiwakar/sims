<?php
	
	include_once "includes/connect.php";
	include_once "includes/session.php";
	include_once "includes/common.php";
	include_once "functions/function.php";
	if($logged_in=="true"){
		if($name)
		{
			$output='';
			$q = "select * from user_registration where username = '$username'";
			$qr = mysqli_query($conn, $q) or die($q);
			$r = mysqli_fetch_object($qr);
			$user_id = $r->id;
			
			$q ="select * from self_informations where user_id=$user_id  AND (name like '%$name%' OR value like '%$name%')";
			//$q ="select * from self_informations where user_id=$user_id  AND name like '%$name%'";
			$qr = mysqli_query($conn, $q) or die($q);
			$rows = mysqli_num_rows($qr);
			$output.= "<ul class='list-unstyled' style='background: #eee; width: 95%; cursor: pointer; padding: 10px; font-weight: bold;position: absolute;'>";
			if($rows)
			{
				while($r = mysqli_fetch_object($qr))
				{
					if($r->name)
						$output.= "<li>$r->name</li>";		
					else if($r->value)
						$output.= "<li>$r->name</li>";		
				}
			}
			else 
				//$output.= "<li>Not found</li>";
			
			
			$output.= "</ul>";
	
			echo $output;
		}	
	}
?>
