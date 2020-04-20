<?php
	
	require('config.php');
	header("Content-Type:application/json");

	

	if(isset($_POST['email']))
	{

		$email = $_POST['email'];
		$sel = "SELECT *FROM users WHERE email = '$email'";
		$query = mysqli_query($conn,$sel);

		if(mysqli_num_rows($query) > 0)
		{
			$otp = mt_rand(100000, 999999);

			mail($email,"Otp Verification",$otp);
			$ins = "UPDATE users SET otp = '$otp' WHERE email = '$email'";
			$insquery = mysqli_query($conn,$ins);


			response(200,"Please Check Your Email For Otp And Verify Your Account");

		}
		else
		{
			response(200,"Please Enter Valid Email");
		}
	}
	else
		{
			response(400,"Please Enter Email");
		}

	function response($status,$status_message)
		{
			header("HTTP/1.1 ".$status);
			
			$response['status']=$status;
			$response['status_message']=$status_message;
			
			
			
			$json_response = json_encode($response);
			echo $json_response;
		}
	

 ?>