<?php 
	include_once "includes/after_common_login.php";
	if($logged_in=="true")
	{

		$title = "List Information";
		$main_menu = after_login_menu("list_info");
		
		$q = "select * from user_registration where username = '$username'";
		$qr = mysqli_query($conn, $q) or die($q);
		$r = mysqli_fetch_object($qr);
		$user_id = $r->id;
		
		$q = "select * from self_informations where user_id='$user_id'";
		$qr = mysqli_query($conn, $q) or die($q);
		$info_table = "
					<div id='my-modal' class='modal fade' aria-labelledby='my-modalLabel' aria-hidden='true' tabindex='-1' role='dialog'>
						<div class='modal-dialog' data-dismiss='modal'>
							<div class='modal-content'  >              
								<div class='modal-body'>
									<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>×</button>
									<img src='' class='gallery' style='width: 100%;'>
								</div> 
							</div>
						</div>
					</div>

					<br><br>
				 <div class='table-responsive'>
					<table class='display' id='info'>
					  <thead>
						<tr class='danger'>
							<th>S.No.</th>
							<th>Category</th>
							<th>Name</th>
							<th>Value</th>
							<th>Image</th>
							<th>Edit</th>
							<th>Delete</th>
						</tr>
					  </thead>
					";
		$info_table.="<tbody>";
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
						

						<td><a href='doc_img/$image' data-lightbox='image-1' data-title='$name'><img class='show-img' src='doc_img/$image' width='50' height='30'></a></td>
						<td><a title='Edit' href=edit_info.php?info_id=$info_id class='text-info'><i class='fa fa-pencil-square-o fa-lg'></i></a></td>
						<td><a title='Delete' href='#' class='text-danger' onClick='deleteme($info_id);'><i class='fa fa-trash-o fa-lg'></i></a> </td>
					</tr>
				   ";
			
			
			$path=null;
			
			
		}
		
		$info_table.="</tbody></table></div>";
		if($i>0)
			$table_disp = $info_table;
		else
			$table_disp ="<br><h2 align='center'>Please Add Information</h2><center><a href='add_information.php' style='color: white; font-size: larger;margin: 60px;' class='btn btn-lg btn-success'>Add Information</a></center>";
		
		$content = "
					<script language='javascript'>
					 $(document).ready(function(){
						 
							$('#info').DataTable();
						});
					
					 function deleteme(del_id)
					 {
						
						if(confirm('Do you want to delete this?'))
						{
							window.location.href='delete_info.php?info_id='+del_id+'';
							return true;
						}
					 }
					</script>
					<form method='post'>
					
						$table_disp
					
					</form>
					";
	}
	else
	{
		
		$title = "Invalid Login";
					 
		 $content.="<section class='container top-margin'>
								 Invalid Login <br> <br> <a class='btn btn-danger' href='index.php'>Try again</a>
							</section><div style='height: 300px'></div>";
	}
	$buf = file_get_contents('template1.html');
	eval($buf);
	echo $page;

?>
