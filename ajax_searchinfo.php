<?php
//print_r($_REQUEST);
include_once "includes/common.php";
include_once "includes/connect.php";
include_once "includes/session.php";
include_once "functions/function.php";	
if($logged_in=="true")
{
	if($last_id>0)
	{
			
		//$sub_category = array_filter($sub_category);
		//$sub_category = end($sub_category);
		$info_table='';
		
		$q = "select * from user_registration where username = '$username'";
		$qr = mysqli_query($conn, $q) or die($q);
		$r = mysqli_fetch_object($qr);
		$user_id = $r->id;
		
		$q ="select * from self_informations where cat_id=$last_id  AND (name like '%$name%' OR value like '%$name%')";
		
		$qr=mysqli_query($conn, $q) or die($q);
		
		$row = mysqli_num_rows($qr);
		//echo $row;
		if($row>0)
		{
			
			$info_table = "<br><br>
					<table class='table table-striped'>
						<tr class='danger'>
							<th>S. No.</th>
							<th>Category location</th>
							<th>Name</th>
							<th>Value</th>
							<th>Image</th>
							<th>Edit</th>
							<th>Delete</th>
						</tr>
					";
			while($r = mysqli_fetch_object($qr))
			{
				$info_id = $r->id;
				$cat_id = $r->cat_id;
				$name = $r->name;
				$value = $r->value;
				$image = $r->image;
				if(empty($image))
					$image='not_avl.jpg';
				//g($cat_id);
					$i++;
					
					getcat($cat_id);
					$path=(array_reverse($path));
					
					$path = implode("", $path);
					$info_table.="
							<tr>
								<td>$i</td>
								<td>$path</td>
								<td>$name</td>
								<td>$value</td>
								<td><a href='doc_img/$image' data-lightbox='image-1' data-title='$name'><img class='show-img' src='doc_img/$image' width='50' height='50'></a></td>
								<td><a href=edit_info.php?info_id=$info_id class='btn btn-default'>Edit</a></td>
								<td><input type=button name=delete value=Delete onClick='deleteme($info_id);'></td>
							</tr>
						   ";
				
				
			$path=null;
				
				
			}
			$info_table.="</table>";
			
			$info_table.="
					<script language='javascript'>
					 function deleteme(del_id)
					 {
						
						if(confirm('Do you want to delete this?'))
						{
							
							window.location.href='delete_info.php?info_id='+del_id+'&search_info=search';
							return true;
						}
					 }
					</script>			
			";
			
			echo $info_table;
			
		}
		else
			echo "<center><h2 style='color: red;'>Not Found</h2></center>";
			
		
	}
	
}

?>
