<?php
 include_once "includes/connect.php";
 include_once "includes/session.php";
 include_once "includes/common.php";
 include_once "functions/function.php";
 if($logged_in=="true")
 {
	 $title = "Add Category";	 
	 $q = "select * from user_registration where username = '$username'";
	 $qr = mysqli_query($conn, $q) or die($q);
	 $r = mysqli_fetch_object($qr);
	 $user_id = $r->id;
	 
	 menu();
	 
	 
	
	 $content="
			<div class='container'>
			  <div class='row'>
				<div class='col-md-3'></div>
					<div class='col-md-6'>
						<form class='form-horizontal' method='POST'>
					  <span style='text-align: center; color: green'>$success</span>
						<br<br><center><button class='btn btn-success btn-lg'><a href=add_cat_subcat.php?id='' style='text-align:center;' class=''>Add New Category</a></button></center>
						<center><h2>Click any one to add Sub Category</h2></center>
						
					</form>
					<br>
					
				</div>
				
			</div>
			$ct
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
