<?php
	$token = bin2hex(random_bytes(16));
	$passwd = "bob";
	print "passwd: ".$passwd.", token: ".$token.", hash: ".hash('sha256', $token.$password);

?>