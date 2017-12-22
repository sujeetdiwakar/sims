<?php 
//session_start();
//session_destroy();
//header("location:index.php");


include_once "includes/after_common_login.php";



if($logged_in)
{
	$main_menu = after_login_menu("profile");
	session_destroy();
	unset($_REQUEST[username]);
	unset($_REQUEST[password]);
	$logged_in=false;	
	?>
	<script>
		window.location="index.php?msg=Successfully logged out!";
	</script>
	<?php
}
else
{
?>
<script>
	window.location="index.php?msg=It is a wrong username or password";
</script>
<?php
} 
$buf=file_get_contents("template.html");
eval($buf);
echo $page;
?>

