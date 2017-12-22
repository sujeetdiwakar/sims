<?php
	include_once "includes/common.php";
	include_once "includes/connect.php";
	include_once 'functions/function.php';
	$main_menu=login_register_menu();
	$title="Forgot Password";
	if($caller=="self")
	{
		
		$errors = array();
		
		$q ="select * from user_registration where username='$username'";
		
		$qr =mysqli_query($conn, $q) or die($q);
		$total = mysqli_num_rows($qr);
		if($total==0)
			$errors[username]="Does't Exist";
		else
		{
			include_once "phpmailer/class.phpmailer.php";
			function send_email($from,$from_name,$to,$subject,$message)
			{
				$mail = new PHPMailer();
				$mail->IsMail();
				$mail->IsHTML(true);
				$mail->From = $from;
				$mail->FromName = $from_name;
				$mail->AddReplyTo=$from;
				$mail->Subject = $subject;
				$mail->Body = $message;
				$mail->AddAddress($to);
				$mail->Send();
			}
			$ts = time();
			$ts = strrev($ts);
			$nw_pwd =substr($ts, 0, 4);
			$q ="update user_registration set password=password('$nw_pwd') where username='$username'";
		    $qr=mysqli_query($conn, $q) or die($q.mysqli_error($conn));
			$q ="select * from user_registration where username='$username'";
			$qr=mysqli_query($conn, $q) or die($q);
			$r = mysqli_fetch_object($qr);
			$name = $r->full_name;
			$username = $r->username;
			$email =$r->email;
			
			
			$from ="sims@gmail.com";
			$from_name ="SIMS";
			$subject ="SIMS - New Password";
			$massage ="Dear $name<br><br>
								<p>Your Password is<b>$nw_pwd</b></p>";
			$to =$email;
			send_email($from,$from_name,$to,$subject,$message);
			
			
			
			
			$success = "
	                      <div class='row'>
					          <div class='col-md-2'></div>
					          <div class='col-md-8'>
					            <div class='alert alert-success'><b>Your New Password send on Email</b></div>
					          </div>
					          <div class='col-md-2'></div>
					        </div>";
		}
		
	}
	
	
	$content ="
			<div class='container'>
			  <div class='row'>
				  <div class='col-md-4'></div>
				  <div class='col-md-4'>
					  <form class='form-signin' method='POST'>
						$success
						<h2 class='form-signin-heading'>Forgot Password</h2>
						<label for='inputEmail' class='sr-only'>Enter Username</label>
						<input type='text' name='username' id='inputEmail' class='form-control' placeholder='Enter username' value='$username' required><span class='error'>$errors[username]</span><br>
						<input type='hidden' name='caller' value='self'>
						<button class='btn btn-lg btn-primary btn-block' type='submit'>Forgot?</button>
					  </form>
					  
				  </div>
				 <div class='col-md-4'></div>
			</div>
		</div>
	
	";
	
	$buf =file_get_contents('template.html');
	eval($buf);
	echo $page;
?>
