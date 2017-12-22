<?php 
	include_once "includes/after_common_login.php";
	
	if($logged_in=="true")
	{
		$title = "Update Information";
		$main_menu = after_login_menu();
		if($caller=="self")
		{
			if(empty($_FILES[image][name]))
			{
				
				$q = "update self_informations set cat_id=$cat_id, name='$name',value='$vl' where id=$info_id";
				$qr = mysqli_query($conn, $q) or die($q);
				$success="
							<div class='row'>
							  <div class='col-md-2'></div>
							  <div class='col-md-8'>
								<div class='alert alert-success center'><b>Information Updated!</b></div>
							  </div>
							  <div class='col-md-2'></div>
							</div>
				";
			}
			else
			{
				$image_name = $_FILES[image][name];
				$img_tmp_name = $_FILES[image][tmp_name];
				if($image_name)
				  $image_name = time()."_".$image_name;
				$types = array('image/jpeg', 'image/gif', 'image/jpg', 'image/png'); 
				if (in_array($_FILES['image']['type'], $types))
					move_uploaded_file($img_tmp_name, "doc_img/$image_name");
				
				$q = "update self_informations set cat_id=$cat_id, name='$name',value='$vl',image='$image_name' where id=$info_id";
				$qr = mysqli_query($conn, $q) or die($q);
				$success="
							<div class='row'>
							  <div class='col-md-2'></div>
							  <div class='col-md-8'>
								<div class='alert alert-success center'><b>Information Updated!</b></div>
							  </div>
							  <div class='col-md-2'></div>
							</div>
				";
			}
		}
		 
		
		$q = "select *from self_informations where id=$info_id";
		$qr = mysqli_query($conn, $q) or ($q);
		$r = mysqli_fetch_object($qr);
		$name = $r->name;
		$vl= $r->value;
		$cat_id = $r->cat_id;
		
		$q = "select * from user_registration where username = '$username'";
		 $qr = mysqli_query($conn, $q) or die($q);
		 $r = mysqli_fetch_object($qr);
		 $user_id = $r->id;
		 
		 $select_cat ="<select class='form-control' name='cat_id' required>
						<option value=''>Select Category/Sub-category</option>";
						$q = "select * from categories where user_id='$user_id'";
						$qr = mysqli_query($conn, $q) or die($q);
						while($r = mysqli_fetch_object($qr))
						{
							if($cat_id==$r->id)
							 $select_cat.="<option value='{$r->id}' selected>{$r->name}</option>";
							 
							else
							 $select_cat.="<option value='{$r->id}'>{$r->name}</option>";
						}
		 $select_cat.="</select>";
		
		
		
		$content="
			<div class='container'>
			  <div class='row'>
				<div class='col-md-3'></div>
					<div class='col-md-6'>
						<form class='form-horizontal' method='POST' enctype='multipart/form-data'>
					  <span style='text-align: center; color: green'>$success</span>
					  <fieldset>
						<div id='legend'>
						  <legend class=''>Update Information</legend>
						</div>
						<div class='control-group'>
						  <label class='control-label' for='name'>Select Category/Sub-category:</label>
						  <div class='controls'>
							$select_cat
						  </div>
						</div>
						<div class='control-group'>
						  <label class='control-label' for='name'>Name:</label>
						  <div class='controls'>
							<input id='name' name='name' value='$name' placeholder='' class='form-control input-lg' type='text' required><span class='error'>$errors[name]</span>						
						  </div>
						</div>
						<div class='control-group'>
						  <label class='control-label' for='value'>Value:</label>
						  <div class='controls'>
							<input id='value' name='vl' value='$vl' placeholder='' class='form-control input-lg' type='text' required><span class='error'>$errors[name]</span>						
						  </div>
						</div>
						<div class='control-group'>
						  <label class='control-label' for=''>Document Image</label>
						  <div class='controls'>
							<input type='file' name='image'>
						  </div><br>
						</div>
						<div class='control-group'>
						  <!-- Button -->
						  <div class='controls'>
							<input type='submit' value='Update Information' class='btn btn-success'>
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
