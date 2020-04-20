<?php

	require('config.php');
	header("Content-Type:application/json");

	

	if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']))
	{
		$username = $_POST['username'];
		$email = $_POST['email'];
		$password = base64_encode($_POST['password']);

		$sel = "SELECT *FROM users WHERE email = '$email'";
		$selquery = mysqli_query($conn,$sel);
		

		if(mysqli_num_rows($selquery) > 0)
		{
			response(200,"Email Already Register");

		}

		else
		{

			$ins = "INSERT INTO users(name,email,password) VALUES('$username','$email','$password')";

			$query = mysqli_query($conn,$ins);

			if($query)
			{
				response(200,"Register Successfully");

				
			}
	
		}


	}
	else
	{
		response(400,"Please Fill All Fields");
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