<?php 
	include_once "includes/after_common_login.php";
	
	if($logged_in=="true"){
		$title = "Update Category";
		$main_menu = after_login_menu();
	if($caller == "self")
	{
		$q = "update categories set name='$name' where id=$cat_id";
		$qr = mysqli_query($conn, $q) or die($q);
		$success= "
					<div class='row'>
					  <div class='col-md-2'></div>
					  <div class='col-md-8'>
						<div class='alert alert-success center'><b>Update Successfull</b></div>
					  </div>
					  <div class='col-md-2'></div>
					</div>
				";
	}
	
	$q = "select * from categories where id = $cat_id";
	$qr = mysqli_query($conn, $q) or die($q);
	$r = mysqli_fetch_object($qr);
	$cat_id = $r->id;
	$name = $r->name;
	
	$content= "
				<div class='container'>
				  <div class='row'>
					<div class='col-md-3'></div>
						<div class='col-md-6'>
							<form class='form-horizontal' method='POST'>
						  <span style='text-align: center; color: green'>$success</span>
						  <fieldset>
							<div id='legend'>
							  <legend class=''>Edit Category</legend>
							</div>
							<div class='control-group'>
							  <label class='control-label' for='name'>Category Name:</label>
							  <div class='controls'>
								<input id='username' name='name' value='$name' placeholder='' class='form-control input-lg' type='text' required><span class='error'>$errors[name]</span>						
							  </div>
							</div><br>
							<div class='control-group'>
							  <!-- Button -->
							  <div class='controls'>
								<input type='hidden' name='cat_id' value='$cat_id'>
								<input type='submit' value='Update Category' class='btn btn-success'>
								<input type='hidden' name='caller' value='self'>
							  </div>
							</div>
						  </fieldset>
						</form>
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
	$buf = file_get_contents('template1.html');
	eval($buf);
	echo $page;
	
?>

