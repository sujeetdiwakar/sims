<?php
//http://sujeet-diwakar.ultimatefreehost.in/
include_once 'functions/function.php';
$title='Login';
$main_menu = login_register_menu("login");
if($_REQUEST[msg])
{
$success = "
	  <div class='row'>
		  <div class='col-md-2'></div>
		  <div class='col-md-8'>
			<div class='alert alert-success'>$_REQUEST[msg]</div>
		  </div>
		  <div class='col-md-2'></div>
		</div>";
}
$content= 
	"<div class='container'>
	  <div class='row'>
		  <div class='col-md-4'></div>
		  <div class='col-md-4'>
				$success
			  <form class='form-signin' action='home.php' method='POST'>
				<h2 class='form-signin-heading'>Please sign in</h2>
				<label for='inputEmail' class='sr-only'>User name</label>
				<input type='text' name='username' id='inputEmail' class='form-control' placeholder='User name' required autofocus><br>
				<label for='inputPassword' class='sr-only'>Password</label>
				<input type='password' name='password' id='inputPassword' class='form-control' placeholder='Password' required>
				<!--<div class='checkbox'>
				  <label>
					<input type='checkbox' value='remember-me'> Remember me 
				  </label>
				  -->
				<div>
				  <center><a href='forgot_pass.php'>Forgot Password?</a></center>
				</div>
				<button class='btn btn-lg btn-primary btn-block' type='submit'>Sign in</button>
			  </form>
			  
		  </div>
		 <div class='col-md-4'></div>
    </div>
</div>";
   $buf=file_get_contents("template.html");
    eval($buf);
    echo $page;
?>
