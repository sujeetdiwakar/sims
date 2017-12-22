<?php
	 include_once "includes/connect.php";
	 include_once "includes/session.php";
	 include_once "includes/common.php";


	$title= "Add Category & SubCategory";
	
	if($logged_in=="true"){

	if($caller=="self")
	{
		$q = "select * from user_registration where username = '$username'";
		$qr = mysqli_query($conn, $q) or die($q);
		$r = mysqli_fetch_object($qr);
		$user_id = $r->id;
		
		if(empty($cat_id))
		{
			$q = "insert into categories(name,user_id) values('$name',$user_id)";
			$qr = mysqli_query($conn, $q) or die($q);
			echo "<script>window.open('add_cat1.php','_self')</script>";
			
		}
		else
		{
			$q ="insert into categories(name,user_id,parent_id) values('$name',$user_id,$cat_id)";
			$qr = mysqli_query($conn, $q) or die($q);
			echo "<script>window.open('add_cat1.php','_self')</script>";
		}
		
		
		
	}
	
	$content="
				<div class='container'>
		  <div class='row'>
			<div class='col-md-3'></div>
				<div class='col-md-6'>
					<form class='form-horizontal' method='POST'>
				  <span style='text-align: center; color: green'>$success</span>
				  <fieldset>
					<div id='legend'>
					  <legend class=''>Add New Category</legend>
					</div>
					<div class='control-group'>
					  <label class='control-label' for='name'>Category Name:</label>
					  <div class='controls'>
						<input id='username' name='name' value='$name' placeholder='' class='form-control input-lg' type='text' required autofocus><span class='error'>$errors[name]</span>						
					  </div>
					</div>
					<div class='control-group'>
					  <!-- Button -->
					  <div class='controls'>
						<input type='submit' value='Add Category' class='btn btn-success'>
						<input type='hidden' name='cat_id' value='$id'>
						<input type='hidden' name='nc' value='$cat'>
						<input type='hidden' name='caller' value='self'>
					  </div>
					</div>
				  </fieldset>
				</form>
				<br>
				
			</div>
		</div>
	  </div>
	";
}
else
{
	$title = "Invalid Login";
			     
	 $content="<section class='container top-margin'>
							 Invalid Login <br> <br> <a class='btn btn-danger' href='index.php'>Try again</a>
						</section><div style='height: 300px'></div>";
}
	$buf =file_get_contents('template1.html');
	eval($buf);
	echo $page;
?>
