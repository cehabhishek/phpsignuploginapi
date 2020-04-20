<?php
	
	require('config.php');
	header("Content-Type:application/json");


	if(isset($_POST['otp']))
	{

		$otp = $_POST['otp'];
		$sel = "SELECT *FROM users WHERE otp = '$otp'";
		$query = mysqli_query($conn,$sel);

		if(mysqli_num_rows($query) > 0)
		{
			

			
			response(200,"Otp Verified");

		}
		else
		{
			response(200,"Please Enter Valid Otp");
		}
	}
	else
	{
		response(200,"Enter otp");
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