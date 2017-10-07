<?php

function file_upload($target_dir, $name)
{
	$uploadOk = 1;
	$imageFileType = pathinfo(basename($_FILES["eventImage"]["name"]),PATHINFO_EXTENSION);
	$target_file = $target_dir.$name.".".$imageFileType;

// Check if image file is a actual image or fake image
	$check = getimagesize($_FILES["eventImage"]["tmp_name"]);
	if($check !== false) {
		$uploadOk = 1;
	} else {
		echo "File is not an image.";
		$uploadOk = 0;
	}
// Check if file already exists
	if (file_exists($target_file)) {
		echo "Sorry, file already exists.";
		$uploadOk = 0;
	}
// Check file size
	if ($_FILES["eventImage"]["size"] > 500000) {
		echo "Sorry, your file is too large.";
		$uploadOk = 0;
	}
// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
		echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		$uploadOk = 0;
	}
// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
		echo "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
	} else {
		if (move_uploaded_file($_FILES["eventImage"]["tmp_name"], $_SERVER['DOCUMENT_ROOT']."/".$target_file)) {
			return $target_file;
		} else {
			echo "Sorry, there was an error uploading your file.";
		}
	}
}
?>