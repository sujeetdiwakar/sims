<?php
	include_once "includes/after_common_login.php";
	
	if($logged_in=="true"){
	$title = "List Category";
	$main_menu = after_login_menu("list_cat");
	$q = "select * from user_registration where username = '$username'";
	$qr = mysqli_query($conn, $q) or die($q);
	$r = mysqli_fetch_object($qr);
	$user_id = $r->id;
	cat();
	if(empty($rc))
		$ct="<br><h2 align='center'>Please Add Category</h2><center><a href='add_cat.php' style='color: white; font-size: larger;margin: 60px;' class='btn btn-lg btn-success'>Add Category</a></center>";
	
	
	$content = "
				<form method ='post'>
				<br><br>
				<div class='parent_child_container'>					
					$ct
				</div>	
				</form>
				$errormsg
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
