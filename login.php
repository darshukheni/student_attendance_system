<?php

include('admin/database_connection.php');
session_start();

if(isset($_SESSION["teacher_id"]))
{
	header('location:index.php');
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Student Attendance System</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">

  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	
</head>
<body background="admin/Background_image/a3.jpg">

<div class=" text-center text-light py-4" style="margin-bottom: 0">
		<h1>Student Attendance System</h1>
	</div>

	<div class="container" >
		<div class="row">
			<div class="col-md-4">
				
			</div>
			<div class="col-md-4" style="margin-top: 20px">
				<div class="card shadow-lg rounded-lg border-secondary">
					<div class="card-header bg-secondary text-white" style="font-family: sans-serif;">Teacher Login</div>
					<div class="card-body" style="background-color:#F2F2F2" >
						<form method="post" id="teacher_login_form">
							<div class="form-group">
								<label style="font-family: sans-serif;">Enter Email Address</label>
								<input type="text" name="teacher_emailid" id="teacher_emailid" class="form-control rounded-pill"/>
								<span id="error_teacher_emailid" class="text-danger"></span>
							</div>
							<div class="form-group">
								<label style="font-family: sans-serif;">Enter Password</label>
								<input type="password" name="teacher_password" id="teacher_password" class="form-control rounded-pill"/>
								<span id="error_teacher_password" class="text-danger"></span>
							</div>
							<div class="form-group">
								<input type="submit" name="teacher_login" id="teacher_login" class="btn btn-info  rounded" value="Login" />
							</div>
						</form>	
					</div>	
				</div>
			</div>
			<div class="col-md-4">
				
			</div>
		</div>
	</div>

</body>
</html>


<script>

$(document).ready(function() {
	
	$('#teacher_login_form').on('submit', function(event) {
		event.preventDefault();
		
		$.ajax({

			url:"check_teacher_login.php",
			method:"POST",
			data:$(this).serialize(),
			dataType:"json",
			beforeSend:function(){
				$('#teacher_login').val('Validate...');
				$('#teacher_login').attr('disabled','disabled');
			},

			success:function(data){
				if(data.success)
				{
					location.href = "index.php";
				}
				if(data.error)
				{
					$('#teacher_login').val('Login');
					$('#teacher_login').attr('disabled',false);

					if (data.error_teacher_emailid != ''){
						$('#error_teacher_emailid').text(data.error_teacher_emailid);
					}
					else{
						$('#error_teacher_emailid').text('');
					}
					if (data.error_teacher_password != ''){
						$('#error_teacher_password').text(data.error_teacher_password);

					}
					else{
						$('#error_teacher_password').text('');
					}
				}
			}
		});
	});


});	


</script>