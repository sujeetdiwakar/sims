<?php
 include_once "includes/connect.php";
 include_once "includes/session.php";
 include_once "includes/common.php";
 if($logged_in=="true")
 {

	//print_r($_POST);
	//echo $_REQUEST['pid'];
	if($_REQUEST)
	{
		$q = "select * from user_registration where username = '$username'";
		$qr = mysqli_query($conn, $q) or die($q);
		$r = mysqli_fetch_object($qr);
		$user_id = $r->id;
		$pid = $_REQUEST['pid'];
		
		
		$query = "select * from categories where user_id=$user_id and parent_id = $pid";
		$results  = mysqli_query($conn, $query);
		$num_rows = mysqli_num_rows($results);
		
		if($num_rows > 0)
		{?>
			<label class="control-label" style="margin-top: 8px; margin-buttom:0px;">Select Sub-Category:</label>
			<select name="sub_category[]" class="parent form-control" id="sub_category" >
			<option value="" selected="selected">-- Sub Category --</option>
			<?php
			while ($rows = mysqli_fetch_assoc($results))
			{?>
				<option value="<?php echo $rows['id'];?>"><?php echo $rows['name'];?></option>
			<?php
			}?>
			</select>	
			
		<?php	
		}
		//else{echo '<label style="padding:7px; font-size:12px;">No Record Found !</label>';}
	}
	
	
	
	
	
}
?>
