<?php
	include_once "includes/common.php";
	include_once "includes/connect.php";
	include_once 'functions/function.php';
	$main_menu=login_register_menu('register');
	if($caller=="self")
	{
	
		$errors = array();
		if(empty($username))
			$errors[username]="Empty";
		
		else if(preg_match('/\s/',$username))
			$errors[username]="White Space Not Allow";
			
		if(empty($email))
			$errors[email]="Empty";
			
		if(empty($password))
			$errors[password]="Empty";
		if(empty($password_confirm))
		    $errors[password_confirm] = "Empty";	
		
		if(empty($errors))
		{
			//echo "hello";
			$q = "select * from user_registration where email='$email'";
			$qr = mysqli_query($conn, $q);
			if(mysqli_num_rows($qr)>=1)
			{
				$errors[email]="Duplicate";
				$t++;
			}
				
			$q = "select * from user_registration where username='$username'";
			$qr = mysqli_query($conn, $q);
			if(mysqli_num_rows($qr)>=1)
			{
				$errors[username]="Dublicate";
				$t++;
			}
			if($t==0)
			{
				$pass_length= strlen($password);
				if($pass_length>=6)
				{
					if(($password==$password_confirm))
					{
						$q = "insert into user_registration (id,username, email, password) values(null,'$username','$email',PASSWORD('$password'))";
						$qr = mysqli_query($conn, $q) or die($q.mysqli_error());
						
						$success="
						<div class='row'>
						  <div class='col-md-2'></div>
						  <div class='col-md-8'>
							<div class='alert alert-success center'><b>Registration Successfull!</b></div>
						  </div>
						  <div class='col-md-2'></div>
						</div>
					 ";
						foreach($_REQUEST as $var=>$val)
							$$var="";
					}
					else
						$errors[password_confirm]="Mish Match";
				}
				else
					$errors[password]="Password Must be 6 Character";
			}
		}
	}
	
		$title="Registration";
		$content="
		<div class='container'>
		  <div class='row'>
			<div class='col-md-3'></div>
				<div class='col-md-6'>
			
				  <form class='form-horizontal' method='POST'>
				  <span style='text-align: center; color: green'>$success</span>
				  <fieldset>
					<div id='legend'>
					  <legend class=''>Register</legend>
					</div>
					<div class='control-group'>
					  <label class='control-label' for='username'>Username</label>
					  <div class='controls'>
						<input id='username' name='username' value='$username' placeholder='Enter Username' class='form-control input-lg' type='text'><span class='error'>$errors[username]</span><!--<span id='availability'></span>-->
						<p class='help-block'>Username can contain without spaces</p>
					  </div>
					</div>
				 
					<div class='control-group'>
					  <label class='control-label' for='email'>E-mail</label>
					  <div class='controls'>
						<input id='email' name='email' value='$email' placeholder='Enter Email' class='form-control input-lg' type='email'><span class='error'>$errors[email]</span>
						<p class='help-block'>Please provide your E-mail</p>
					  </div>
					</div>
				 
					<div class='control-group'>
					  <label class='control-label' for='password'>Password</label>
					  <div class='controls'>
						<input id='password' name='password' value='$password' placeholder='Enter Password' class='form-control input-lg' type='password'><span class='error'>$errors[password]</span>
						<p class='help-block'>Password should be at least 6 characters</p>
					  </div>
					</div>
				 
					<div class='control-group'>
					  <label class='control-label' for='password_confirm'>Password (Confirm)</label>
					  <div class='controls'>
						<input id='password_confirm' name='password_confirm' value='$password_confirm' placeholder='Confirm Password' class='form-control input-lg' type='password'><span class='error'>$errors[password_confirm]</span>
						<p class='help-block'>Please confirm password</p>
					  </div>
					</div>
				 
					<div class='control-group'>
					  <!-- Button -->
					  <div class='controls'>
						<input type='submit' value='Register' class='btn btn-success'>
						<input type='hidden' name='caller' value='self'>
					  </div>
					</div>
				  </fieldset>
				</form>
			</div> 
		  </div>
		</div>
		<script>
			$(document).ready(function(){
			
				$('#username').blur(function(){
					var username = $(this).val();
					$.ajax({
						url:'check.php',
						method:'POST',
						data:{user_name:username},
						dataType:'text',
						success:function(html)
						{
							$('#availability').html(html);
						}
					});
				});
			
			});
		</script>
		";
		
		$buf = file_get_contents("template.html");
		eval($buf);
		echo $page;
?>
