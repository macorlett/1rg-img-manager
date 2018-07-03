<?php
	

	include('php/config.php');
	session_start();

	if($_SERVER['REQUEST_METHOD']=="POST"){
		$user=mysqli_real_escape_string($db,$_POST['user']);
		//$passwd=mysqli_real_escape_string($db,$_POST['passwd']);

		$sql="SELECT passwd FROM user_auth WHERE user = '$user'";
		$result=mysqli_query($db,$sql);
		$row=mysqli_fetch_array($result,MYSQLI_ASSOC);

		$count=mysqli_num_rows($result);

		if($count==1){
			$dbpasswd=$row['passwd'];
			$salt=substr($dbpasswd,0,32);
			$passwd=hash('sha256', $salt.$_POST['passwd']);

			if($salt.$passwd==$dbpasswd){
				$_SESSION['user']=$user;
			}else{
				//error passwd didn't match
			}
		}else{
			//error to many / not enough rows
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>macorlett - image management tool</title>

	<link href="css/main.css" rel="stylesheet" type="text/css">
</head>
<body>
	<form method="POST">
		<input type="text" name="user" placeholder="user name">
		<input type="password" name="passwd" placeholder="password">
		<button type="submit">login</button>
	</form>
</body>
</html>