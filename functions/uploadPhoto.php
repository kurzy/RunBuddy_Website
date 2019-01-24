<?php
session_start();
include_once('functions.php');

// 'file_uploads' is set to On by default, but check for this anyway.
if (!ini_get('file_uploads')) {
	$_SESSION['msg'] = "Please set 'file_uploads' to 'On' in php.ini file";
	header("Location: ../" . $_POST['back_page']);
	exit();
}
//
if (!isset($_POST['submit'])) {
	echo "Error: POST_SUBMIT not set.";
	header("Location: ../" . $_POST['back_page']);
	exit();
}

$img_dir = "../img/";
$img_file = $img_dir . basename($_FILES['photo_file']['name']);

//// Check if a file was given
//if (!is_uploaded_file($_FILES['photo_file']['tmp_name'])) {
//	$_SESSION['msg'] = "Error: File was not uploaded";
//	header("Location: ../" . $_POST['back_page']);
//	exit();
//}

// Check if file already exists
if (file_exists($img_file)) {
	$_SESSION['msg'] = "File already exists";
	header("Location: ../" . $_POST['back_page']);
	exit();
}

// Check file size not too large.
if ($_FILES['photo_file']['size'] > 500000) {
	$_SESSION['msg'] = "File size too large";
	header("Location: ../" . $_POST['back_page']);
	exit();
}

$result = move_uploaded_file($_FILES['photo_file']['tmp_name'], $img_file);
if ($result) {
	$_SESSION['msg'] = "File uploaded successfully";
	// Add it to the database.
	$dbConnect = dbLink();
	if ($dbConnect == NULL) {
		$_SESSION['msg'] = "Error: could not connect to database";
		header("Location: ../" . $_POST['back_page']);
	}
	$file = "img/" . basename($_FILES['photo_file']['name']);
	$q = "INSERT INTO photos (ID, userID, URL) VALUES
		  (NULL, :uid, :file)";
	$query = $dbConnect->prepare($q);
	$query->bindParam(":uid", $_SESSION['uid']);
	$query->bindParam(":file", $file);
	$ins_result = $query->execute();
	if (!$ins_result) {
		$_SESSION['msg'] = "Error inserting image into database";
		header("Location: ../" . $_POST['back_page']);
		exit();
	}
	// If the request is uploading a profile photo, add it to this table.
	$imgID = $dbConnect->lastInsertId();
	if (isset($_POST['profile_photo']) && $_POST['profile_photo'] == "true") {
		$q = "REPLACE INTO user_profile_photo
				SET userID = :uid, imageID = :imgID";
		$query = $dbConnect->prepare($q);
		$query->bindParam(":uid", $_SESSION['uid']);
		$query->bindParam(":imgID", $imgID);
		$ins_result = $query->execute();
		if (!ins_result) {
			$_SESSION['msg'] = "Error inserting image into profile picture database";
			header("Location: ../" . $_POST['back_page']);
			exit();
		}
	}
}
else {
	$_SESSION['msg'] = "Error with move_uploaded_file()";
}


?>

<!DOCTYPE html>
<html>
	<head>
		<script>
			function redirect() {
				window.location.href = "../dashboard.php";
			}
		</script>
	</head>
	<body onload="redirect()">
	</body>
</html>






