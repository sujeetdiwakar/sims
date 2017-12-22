<?php
	include_once "includes/after_common_login.php";
	if($logged_in=="true")
	{
		$title = "Add Information";
		$main_menu = after_login_menu("add_info");
		
		
		$content="
			<script type='text/javascript' src='jquery.js'></script>
			<script src='https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js'></script>
			<script type='text/javascript' src='jquery.livequery.js'></script>
			<script src='js/bootbox.min.js'></script>
			
			<script type='text/javascript'>
			
				$(document).ready(function() {
					//alert('hi');
					$('.parent').livequery('change', function() {
				
						$(this).nextAll('.parent').remove();
						$(this).nextAll('label').remove();
						var id = $(this).val();
						$.ajax({
							
								url: 'sub_cat.php',
								method: 'POST',
								data:'pid='+id,
								dataType:'html',
								success:function(data)
								{
									$('#show_sub_categories').append(data);
								}
							});
						
					});

				});
			</script>";		
		 
		
		 
		 if($caller == "self")
		 {
			 //echo "<pre>";
			 //var_dump($GLOBALS);
			 //echo "</pre>";
			 
			 
			 $image_name = $_FILES[image][name];
			 $img_tmp_name = $_FILES[image][tmp_name];
			 if($image_name)
			   $image_name = time()."_".$image_name;
			 
			 $sub_category = array_filter($_REQUEST['sub_category']);
			 $sub_category=end($sub_category);
			 //$image_name = $name;
			 $types = array('image/jpeg', 'image/gif', 'image/jpg', 'image/png'); 
			 if (in_array($_FILES['image']['type'], $types))
				move_uploaded_file($img_tmp_name, "doc_img/$image_name");
			 
			$q = "select * from user_registration where username = '$username'";
			$qr = mysqli_query($conn, $q) or die($q);
			$r = mysqli_fetch_object($qr);
			$user_id = $r->id;

			 $q = "insert into self_informations(id, user_id, cat_id, name, value, image) values(null, $user_id, $sub_category,'$name','$vl','$image_name')";
			 $qr = mysqli_query($conn, $q) or die($q);
			 $success="
						<div class='row'>
						  <div class='col-md-2'></div>
						  <div class='col-md-8'>
							<div class='alert alert-success center'><b>Information Successfull Added!</b></div>
						  </div>
						  <div class='col-md-2'></div>
						</div>
					 ";
			 foreach($_REQUEST as $var=>$val)
				$$var="";
			
		 }

		
		 
		$sub_opt = '';
		$q = "select * from user_registration where username = '$username'";
		$qr = mysqli_query($conn, $q) or die($q);
		$r = mysqli_fetch_object($qr);
		$user_id = $r->id;
		$sub_opt.="<select name='sub_category[]' id='sub_category' class='parent form-control' required>
				
				<option value='' selected='selected'>-- Categories --</option>";
				
				
				$q = "select * from categories where user_id=$user_id and parent_id = 0";
				$qr = mysqli_query($conn, $q) or die($q.mysqli_error());
				
				while($r = mysqli_fetch_object($qr))
				{
					$sub_opt.="<option value='{$r->id}'>$r->name</option>";
				
				}
			$sub_opt.="</select>";

	$content.="
			<div class='container'>
			  <div class='row'>
				<div class='col-md-3'></div>
					<div class='col-md-6'>
						<form class='form-horizontal' method='POST' enctype='multipart/form-data'>
					  <span style='text-align: center; color: green'>$success</span>
					  <fieldset>
						<div id='legend'>
						  <legend class=''>Add Information</legend>
						</div>
						<div class='control-group'>
						  <label class='control-label' for='name'>Select Category:</label>
						  <div class='controls'>
							<div id='show_sub_categories'>
								$sub_opt
							</div>
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
							<input type='file' name='image' value=''>
						  </div><br>
						</div>
						<div class='control-group'>
						  <!-- Button -->
						  <div class='controls'>
							<input type='submit' value='Add Information' class='btn btn-success'>
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


