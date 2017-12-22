<?php
 include_once "includes/connect.php";
 include_once "includes/session.php";
 include_once "includes/common.php";
 if($logged_in=="true")
 {
	 $title = "Add Category";
	 
	 
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
				if(name == '')
				{
					    alert('Please Fill Input Field', 'Alert Dialog');
					return false;
				}
				//alert(last_id);
				//alert(name);		
				$.ajax({
						
						url: 'insert_cat.php',
						method: 'POST',
						data: {last_id:last_id,name:name},
						success:function(data)
						{
							console.log(data);
							$('#response').html(data);
						}
						
					
					});
				
				
				});

		});
		</script>";
		
		$q = "select * from user_registration where username = '$username'";
		$qr = mysqli_query($conn, $q) or die($q);
		$r = mysqli_fetch_object($qr);
		$user_id = $r->id;
		
		$sub_opt = '';
		
		if($cat=='s')
		{
	
		
		  $sub_opt.="<select name='sub_category' id='sub_category' class='parent form-control'>
			
			<option value='' selected='selected'>-- Categories --</option>";
			
			
			$q = "select * from categories where user_id=$user_id and parent_id = 0";
			$qr = mysqli_query($conn, $q) or die($q.mysqli_error());
			
			while($r = mysqli_fetch_object($qr))
			{
				$sub_opt.="<option value='$r->id'>$r->name</option>";
			
			}
		$sub_opt.="</select>";
		 
		}
							
		if($cat=='s')  $ch='checked';
 $content.="
		<br>
		<div class='container'>
		  <div class='row'>
			<div class='col-md-3'></div>
				<div class='col-md-6'>
						<div id='show_sub_categories'>
							<div id='response'></div>
							<form id='submit_form' class='form-horizontal' method='POST'>
								Add Category:
								<input type='text' class='form-control' name='name' id='name' required autofocus>
								Root<input type='radio' name='cat' value='r' id='root' checked onchange=this.form.submit();>
								Sub<input type='radio' name='cat' value='s' id='sub' $ch onchange=this.form.submit();>
								<input type='hidden' id='l_id' name='l_id'>
								<input type='button' id='s' class='btn btn-block btn-success' value='submit'>
								<br>
							</form><br>
							$sub_opt
						</div>
				<br>
					
			</div>
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
	  $buf = file_get_contents('template1.html');
	  eval($buf);
	  echo $page;
?>
