<?php

	require('config.php');
	header("Content-Type:application/json");

	if(isset($_POST['email']) && isset($_POST['password']))
	{
		$email = $_POST['email'];
		$password = base64_encode($_POST['password']);

		$sel = "SELECT *FROM users WHERE email = '$email' AND password = '$password'";
		$query = mysqli_query($conn,$sel);
		if(mysqli_num_rows($query) > 0)
		{
			$rows = mysqli_fetch_array($query,MYSQLI_BOTH);
			$username = $rows['name'];
			$email = $rows['email'];

			response(200,"Login Successfully",$username,$email);

		}
		else
		{
			response(200,"Email Or Password Is Worng",NULL,NULL);
		}

	}
	else
	{
		response(400,"Please Fill All Fields",NULL,NULL);
	}

	function response($status,$status_message,$username,$email)
		{
			header("HTTP/1.1 ".$status);
			
			$response['status']=$status;
			$response['status_message']=$status_message;
			$response['username'] = $username;
			$response['email'] = $email;
			
			
			$json_response = json_encode($response);
			echo $json_response;
		}

 ?>