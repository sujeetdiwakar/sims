<?php
 include_once "includes/connect.php";
 include_once "includes/session.php";
 include_once "includes/common.php";
 if($logged_in=="true")
 {
	//print_r($_REQUEST);
		$q = "select * from user_registration where username = '$username'";
		$qr = mysqli_query($conn, $q) or die($q);
		$r = mysqli_fetch_object($qr);
		$user_id = $r->id;
	
		if($last_id)
		{
			$q = "insert into categories(id,name,user_id,parent_id) values(null,'$name',$user_id,$last_id)";
			$qr = mysqli_query($conn, $q) or die($q);
			
			echo"
					<div class='row'>
					  <div class='col-md-2'></div>
					  <div class='col-md-8'>
						<div class='alert alert-success center'><b>Sub-Category added Successfully!</b></div>
					  </div>
					  <div class='col-md-2'></div>
					</div>
					 ";
		}
		else
		{
			$q = "insert into categories(id,name,user_id,parent_id) values(null,'$name',$user_id,0)";
			$qr = mysqli_query($conn, $q) or die($q);
			echo"
				<div class='row'>
					  <div class='col-md-2'></div>
					  <div class='col-md-8'>
						<div class='alert alert-success center'><b>Root-Category added Successfully!</b></div>
					  </div>
					  <div class='col-md-2'></div>
					</div>
					 ";
		}
		
}
?>
