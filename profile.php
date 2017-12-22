<?php 
	include_once "includes/after_common_login.php";
	
	if($logged_in=="true")
	{
		$title="User Profile";
		$main_menu = after_login_menu("profile");
		if($caller=="self")
		{
			if(($upassword)&&($password_confirm))
			{
					$pass_length=strlen($upassword);
					if($pass_length>=6)
					{
						if(($upassword==$password_confirm))
						{
							$q = "update user_registration set full_name='$full_name', email='$email',password=PASSWORD('$upassword'),mobile='$mobile',address='$address' where id=$user_id";
							$qr = mysqli_query($conn, $q) or die($q.mysqli_error($conn));
							$success = "Profile Updated!";
						}
						else
							$errors[password_confirm]="Mish Match";
								
					}
					else
						$errors[upassword]="Password Must be 6 Character";
			
			}
		
			else
			{
				$q = "update user_registration set full_name='$full_name', email='$email',mobile='$mobile',address='$address' where id=$user_id";
				$qr = mysqli_query($conn, $q) or die($q.mysqli_error($conn));
				$success="
						<div class='row'>
						  <div class='col-md-2'></div>
						  <div class='col-md-8'>
							<div class='alert alert-success center'><b>Profile Updated!</b></div>
						  </div>
						  <div class='col-md-2'></div>
						</div>
					 ";
	
				
			}
				//$success = "Enter or Blank both password and confirm password field";

		}
		
		$q ="select * from user_registration where username='$username'";
		$qr =mysqli_query($conn, $q) or die($q);
		
		$r = mysqli_fetch_object($qr);
		$id = $r->id;
		$name = $r->name;
		$full_name = $r->full_name;
		$mobile=$r->mobile;
		$address=$r->address;
		$username=$r->username;
		$email=$r->email;
		
		
		$content="
			<div class='container'>
			  <div class='row'>
				<div class='col-md-3 col-sm-3'></div>
					<div class='col-md-6 col-sm-6'>
					  <form class='form-horizontal' method='POST'>
						  $success
						  <fieldset>
							<div id='legend'>
							  <legend class=''>Profile</legend>
							</div>
							<div class='control-group'>
							  <label class='control-label' for='full_name'>Full Name</label>
							  <div class='controls'>
								<input id='full_name' name='full_name' value='$full_name' placeholder='' class='form-control input-lg' type='text'>
							  </div>
							</div>
							<div class='control-group'>
							  <label class='control-label' for='username'>Username</label>
							  <div class='controls'>
								<input id='username' name='username' value='$username' placeholder='' class='form-control input-lg' type='text' disabled>
							  </div>
							</div>
						 
							<div class='control-group'>
							  <label class='control-label' for='email'>E-mail</label>
							  <div class='controls'>
								<input id='email' name='email' value='$email' placeholder='' class='form-control input-lg' type='email'><span class='error'>$errors[email]</span>
								
							  </div>
							</div>
							<div class='control-group'>
							  <label class='control-label' for='mobile'>Mobile</label>
							  <div class='controls'>
								<input id='mobile' name='mobile' value='$mobile' placeholder='' class='form-control input-lg' type='text'>
							  </div>
							</div>
							<div class='control-group'>
							  <label class='control-label' for='password'>Password</label>
							  <div class='controls'>
								<input id='password' name='upassword' value='$upassword' placeholder='' class='form-control input-lg' type='password'><span class='error'>$errors[upassword]</span>
								<p class='help-block'>Password should be at least 6 characters</p>
							  </div>
							</div>
						 
							<div class='control-group'>
							  <label class='control-label' for='password_confirm'>Password (Confirm)</label>
							  <div class='controls'>
								<input id='password_confirm' name='password_confirm' value='$password_confirm' placeholder='' class='form-control input-lg' type='password'><span class='error'>$errors[password_confirm]</span>
								<p class='help-block'>Please confirm password</p>
							  </div>
							</div>
							<div class='control-group'>
							  <label class='control-label' for='address'>Address</label>
							  <div class='controls'>
								<textarea name='address' class='form-control'>$address</textarea>
							  </div>
							</div><br>
							<div class='control-group'>
							  <!-- Button -->
							  <div class='controls'>
								<input type='hidden' name='user_id' value='$id'>
								<input type='submit' value='Update Profile' class='btn btn-success'>
								<input type='hidden' name='caller' value='self'>
							  </div>
							</div>
						  </fieldset>
						</form>
					</div> 
					<div class='col-md-3 col-sm-3'></div>
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
	$buf=file_get_contents('template1.html');
	eval($buf);
	echo $page;
	
?>
