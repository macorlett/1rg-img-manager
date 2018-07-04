<?php
	define('DB_SERVER','localhost');
	define('DB_USERNAME','website');
	define('DB_PASSWORD', 'ElfyEa0SUi6s69ZG');
	define('DB_DATABASE', 'db_img_manager');
	$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE) or die("Server Error");
	
?>