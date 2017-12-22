<?php	
	include_once "includes/connect.php";
	include_once "includes/session.php";
	include_once "includes/common.php";
	if($logged_in=="true"){
	
	$sub_opt = '';
	$q = "select * from user_registration where username = '$username'";
	$qr = mysqli_query($conn, $q) or die($q);
	$r = mysqli_fetch_object($qr);
	$user_id = $r->id;
	$sub_opt.="<label class='control-label'>Select Category:</label>";
	$sub_opt.="<select name='sub_category' id='sub_category' class='parent form-control'>
			
			<option value='' selected='selected'>-- Categories --</option>";
			
			
			$q = "select * from categories where user_id=$user_id and parent_id = 0";
			$qr = mysqli_query($conn, $q) or die($q.mysqli_error());
			
			while($r = mysqli_fetch_object($qr))
			{
				$sub_opt.="<option value='$r->id'>$r->name</option>";
			
			}
		$sub_opt.="</select>";
	echo $sub_opt;
}
?>
