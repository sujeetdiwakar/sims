<?php
	
	include_once "includes/after_common_login.php";
	if($logged_in=="true")
	{
		$title = "Search";
		$main_menu = after_login_menu("");
		
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
					
					
					
					$('#s').click(function(){
				
				
				var countries = [];
				if( !$('.parent').val() ) { 
				  
					countries = ['0'];
				}
				else
				{															
					$.each($('.parent option:selected'), function(){            

						countries.push($(this).val());

					});
				}
				//var lastEl = countries[countries.length-1];
				
				
				
				function cleanArray(actual) {
				  var newArray = new Array();
				  for (var i = 0; i < actual.length; i++) {
					if (actual[i]) {
					  newArray.push(actual[i]);
					}
				  }
				  return newArray;
				}
				var alle = [];
				alle = cleanArray(countries);
				
				
				//alert(lastEl);
				var last_id = $(alle).get(-1);
				var name= $('#name').val();
				var cat = $('#sub_category').val();
				if(cat=='')
				{
					alert('Please Select Category');
					return false;
				}
				if(name == '')
				{
					alert('Please Fill Input Field', 'Alert Dialog');
					return false;
				}
					
				$.ajax({
						
						url: 'ajax_searchinfo.php',
						method: 'POST',
						data: {last_id:last_id,name:name},
						success:function(data)
						{
							console.log(data);
							
							$('#response').html(data);
							
							
						}
						
					
					});
				
				
				});
				
				$('#name').keyup(function(){
					var name =$(this).val();
					
					$.ajax({
					
						url:'ajax_searchlist.php',
						method:'POST',
						data:'name='+name,
						success:function(data)
						{
							$('#list').fadeIn();
							$('#list').html(data);
						}
					
					
					
					});
					
				
				
				});
				
				$(document).on('click','li',function(){
					$('#name').val($(this).text());
					$('#list').fadeOut();
				});	
					
				});
							
			</script>";		
	
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
				
					  <fieldset>
						<div id='legend'>
						  <legend class=''>Search Information</legend>
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
						  <label class='control-label' for='name'>Text:</label>
						  <div class='controls'>
							<input id='name' name='name' value='$name' class='form-control input-lg' type='text' autocomplete='off' required><span class='error'>$errors[name]</span>						
							<div id='list' style='width:100%'></div>
						  </div>
						  
						</div>
						</br>
						<div class='control-group'>
						  <!-- Button -->
						  <div class='controls'>
							<input type='button' id='s' value='Search Information' class='btn btn-success'>
						  </div>
						</div>		
					  </fieldset>
					</form>
				</div>
			</div>
		  </div>
		  <div id='response'>
		  
		  <center>$msg</center>			
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
