<?php
	include('session.php');


	if($_SERVER['REQUEST_METHOD']=="POST"){
		
		// image directory
		$dir='img_uploads/';

		// setup image directory if one doesn't exist
		if(!file_exists($dir)){
			$oldmask=umask(0);
			mkdir($dir,0744);
		}

		$target_name=round(microtime(true)).'-'.basename($_FILES["upload-file"]["name"]);
		$target_file=$dir.$target_name;
		$isValid=1;
		$fileType=strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

		// check if it is an actual image
		if(isset($_POST["submit"])) {
			$check=getimagesize($_FILES["upload-file"]['tmp_name']);
			if($check==false){
				$isValid=0;
			}
		}

		// check if file already exists
		if(file_exists($target_file)){
			$isValid=0;
		}

		// check file size
		if($_FILES['upload-file']['size']>500000){
			$isValid=0;
		}

		// allow only certain file types (jpeg,jpg,png)
		if(fileType!="jpg"&&fileType!="jpeg"&&fileType!="png"){
			$isValid=0;
		}

		if($isValid!=0){
			if(move_uploaded_file($_FILES["upload-file"][tmp_name], $target_file)){
				// image uploaded fine

				$sql="insert into UPLOADED_IMAGES (date,name,location) values (".time().",".$target_name.",".$dir.")";
				if($db->query($sql)===TRUE){
					// added to DB
				}else{
					// failed to adde to DB
				}
			}else{
				// failed to upload image
			}
		}else{
			// not upload because image was not correctly formatted.
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
	<form method="POST" enctype="multipart/form-data">
		<input type="file" name="upload-file">
		<button type="submit">upload image</button>
	</form>
</body>
</html>