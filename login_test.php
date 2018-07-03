<?php
	include('php/config.php');
	session_start();

	if($_SERVER['REQUEST_METHOD']=="POST"){
		$user=mysqli_real_escape_string($db,'macorlett');

		$sql="SELECT passwd FROM user_auth WHERE user = '$user'";
		$result=mysqli_query($db,$sql);
		$row=mysqli_fetch_array($result,MYSQLI_ASSOC);

		$count=mysqli_num_rows($result);

		if($count==1){
			$dbpasswd=$row['passwd'];
			$salt=substr($dbpasswd,0,32);
			$passwd=hash('sha256', $salt.'bob');

			if($salt.$passwd==$dbpasswd){
				print "working! login worked!";

			}else{
				print "failed! password didn't match :(";
			}
		}else{
			print "failed! row count was wrong :(";
		}
	}
?>