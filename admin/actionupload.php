
<?php

	$sport = $_POST['cboSports'];
	 
    $uploaddir = '../img/';
	$name = $_FILES["image"]["name"];
	//$uploadfile =  $uploaddir . basename($name);
	$tmp           = explode('.', $name);
	$ext = end($tmp);
	 
	$newfilename=$uploaddir.$sport .".".$ext;
	 
	if (move_uploaded_file($_FILES["image"]["tmp_name"], $newfilename)) {
		echo "<script>alert('Image Successfully uploaded.');</script>";
	} else {
		echo "<script>alert('Image uploading failed.');</script>";
	}
 
	echo "<script>window.location.href='image.php';</script>";


?> 