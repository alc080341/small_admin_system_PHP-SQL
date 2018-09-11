<?php

//if(isset($_SESSION['id'])) 
//{
//	header("Location: index.php");	
//}

if(isset($_POST['register']))
{
	include_once("connection.php");
	$username = $_POST['username'];
	$password = $_POST['password'];
	$email = $_POST['email'];

	$username = mysqli_real_escape_string($dbconn, $username);
	$password = mysqli_real_escape_string($dbconn, $password);
	$email = mysqli_real_escape_string($dbconn, $email);

	$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
	

	$sql_store = $dbconn->prepare("INSERT into users (username, email, password) VALUES (?, ?, ?)");
	$sql_store->bind_param("sss", $username, $email, $hashedPassword);

	$sql_fetch_username = "SELECT username FROM users WHERE username = '$username'";
	$sql_fetch_email = "SELECT username FROM users WHERE email = '$email'";




	$query_username = mysqli_query($dbconn, $sql_fetch_username);
	$query_email = mysqli_query($dbconn, $sql_fetch_email);

	if(mysqli_num_rows($query_username))
	{
		echo "There is already a user with that name";
		return;
	}
	if($username == "")
	{
		echo "Please insert a user name";
		return;
	}
	if($password == "")
	{
		echo "Please insert your password";
		return;
	}
	if(!filter_var($email, FILTER_VALIDATE_EMAIL) || $email == "")
	{
		echo "This email is not valid";
		return;
	}

	if(mysqli_num_rows($query_email))
	{
		echo "That email is already in use";
		return;
	}

	echo "success!";
	$sql_store->execute();
	$sql_store->close();
	$dbconn->close();
	
}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
</head>
<body>
	
	<form action="register.php" method="post" enctype="multipart/form-data">
		<input placeholder="Username" name="username" type="text">
		<input placeholder="Password" name="password" type="text">
		<input placeholder="Email address" name="email" type="text">
		<input name="register" type="submit" value="Register">
	</form>


</body>


</html>


