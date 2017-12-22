
<?php
$rc="";
$ct="<div class='headding'>List of Category & Sub-category</div>"; 
function cat($parent_id = 0)
{
	
	global $conn;
	global $user_id;
	global $ct;
	global $rc;
	$q = "select * from categories where parent_id='$parent_id' and user_id='$user_id'";
	$qr = mysqli_query($conn, $q) or die($q);
	$ct.="<ul class=cat_list>";
	if(mysqli_num_rows($qr)>0)
	{
		$rc++;
		while($r = mysqli_fetch_object($qr))
		{
			$id=$r->id;
			$pid=$r->parent_id;
			if($parent_id)
			 $ct.= "<li class='child_cat'>&gg;$r->name &nbsp;<a href=edit_cat.php?cat_id=$id><span class='glyphicon glyphicon-edit' title='Edit'></span></a></li>";
			else
				$ct.= "<li>#$r->name &nbsp;<a href=edit_cat.php?cat_id=$id><span class='glyphicon glyphicon-edit' title='Edit'></span></a></li>";
			
			 cat($id);
		}
		
	}
	$ct.= "</ul>";
	
}

$path= array(); 
function getcat($id)
{

	global $conn;
	global $user_id;
	global $path;
	$q = "select * from categories where id='$id' and user_id='$user_id'";
	$qr = mysqli_query($conn, $q) or die($q);
	
	if(mysqli_num_rows($qr)>0)
	{
		
		while($r = mysqli_fetch_object($qr))
		{
			
			$id=$r->parent_id;
			
			$name=$r->name;
			$path[]="/".$name;
			getcat($id);
			$id;
			if($id=='')
			{
				break;
		
			}
			 
		}
		
	}
	
}
function login_register_menu($page=null)
{  
	$menu="<ul class='nav navbar-nav navbar-right'>";

		if($page=="register")
		    $menu.="<li class='nav-item active'>
					<a class='nav-link' href='registration.php'><span class='glyphicon glyphicon-user'></span> Sign Up</a>
				  </li>";
		else
		    $menu.="<li class='nav-item'>
					<a class='nav-link' href='registration.php'><span class='glyphicon glyphicon-user'></span> Sign Up</a>
				  </li>";

		if($page=="login")
		    $menu.="<li class='nav-item active'>
					<a class='nav-link' href='index.php'><span class='glyphicon glyphicon-log-in'></span> Login</a>
				  </li>";
			
		else
			$menu.="<li class='nav-item'>
					<a class='nav-link' href='index.php'><span class='glyphicon glyphicon-log-in'></span> Login</a>
				  </li>";
				  
		$menu.="</ul>";
		return($menu);

}

function after_login_menu($page = null)
{
	$menu="<ul class='nav navbar-nav navbar-right'>";
		
		if($page=="home")
			$menu.="<li class='nav-item active'>
					<a class='nav-link' href='home.php'>HOME</a>
				  </li>";
		else
			$menu.="<li class='nav-item'>
					<a class='nav-link' href='home.php'>HOME</a>
				  </li>";
				  
		if($page=="add_cat")
		    $menu.="
				<li class='dropdown active'>
				  <a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>MANAGE CONTENT<span class='caret'></span></a>
				  <ul class='dropdown-menu'>
					<li class='nav-item active'><a href='add_cat.php'>Add Category</a></li>
					<li><a href='list_cat.php'>List Category</a></li>
					<li><a href='add_information.php'>Add Information</a></li>
					<li><a href='list_information.php'>List Information</a></li>
					
				  </ul>
				</li>		    
		    ";
		    
		else if($page=="list_cat")
		    $menu.="
				<li class='dropdown active'>
				  <a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>MANAGE CONTENT<span class='caret'></span></a>
				  <ul class='dropdown-menu'>
					<li><a href='add_cat.php'>Add Category</a></li>
					<li class='nav-item active'><a href='list_cat.php'>List Category</a></li>
					<li><a href='add_information.php'>Add Information</a></li>
					<li><a href='list_information.php'>List Information</a></li>
					
				  </ul>
				</li>		    
		    ";  
		else if($page=="add_info")
		    $menu.="
				<li class='dropdown active'>
				  <a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>MANAGE CONTENT<span class='caret'></span></a>
				  <ul class='dropdown-menu'>
					<li><a href='add_cat.php'>Add Category</a></li>
					<li><a href='list_cat.php'>List Category</a></li>
					<li class='nav-item active'><a href='add_information.php'>Add Information</a></li>
					<li><a href='list_information.php'>List Information</a></li>
					
				  </ul>
				</li>		    
		    ";    
		 else if($page=="list_info")
		    $menu.="
				<li class='dropdown active'>
				  <a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>MANAGE CONTENT<span class='caret'></span></a>
				  <ul class='dropdown-menu'>
					<li><a href='add_cat.php'>Add Category</a></li>
					<li><a href='list_cat.php'>List Category</a></li>
					<li><a href='add_information.php'>Add Information</a></li>
					<li class='nav-item active'><a href='list_information.php'>List Information</a></li>
				  </ul>
				</li>		    
		    ";
		else
			$menu.="
				<li class='dropdown'>
				  <a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>MANAGE CONTENT<span class='caret'></span></a>
				  <ul class='dropdown-menu'>
					<li><a href='add_cat.php'>Add Category</a></li>
					<li><a href='list_cat.php'>List Category</a></li>
					<li><a href='add_information.php'>Add Information</a></li>
					<li><a href='list_information.php'>List Information</a></li>
					
				  </ul>
				</li>		    
		    ";

		if($page=="profile")
		    $menu.="
				<li class='dropdown active'>
				  <a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>SETTING<span class='caret'></span></a>
				  <ul class='dropdown-menu'>
					<li class='nav-item active'><a href='profile.php'>Profile</a></li>
				  </ul>
				</li>		    
		    ";
		   
		  else
		    $menu.="
				<li class='dropdown'>
				  <a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>SETTING<span class='caret'></span></a>
				  <ul class='dropdown-menu'>
					<li><a href='profile.php'>Profile</a></li>
				  </ul>
				</li>		    
		    "; 
		    
		    
		if($page=="logout")
		    $menu.="<li class='nav-item active'>
					<a class='nav-link' href='logout.php'>LOG OUT</a>
				  </li>";
			
		else
			$menu.="<li class='nav-item'>
					<a class='nav-link' href='logout.php'>LOG OUT</a>
				  </li>";
				  
		$menu.="</ul>";
		
		return($menu);
		
}
?> 

