<?php
// Modify a user's (specified by uid) information in the database.
session_start();
include_once('functions.php');

// Make sure POST variables are set.
if (!isset($_POST['fname']) ||
   !isset($_POST['lname']) ||
   !isset($_POST['email']) ||
   !isset($_POST['area']) ||
   !isset($_POST['bio']) ||
   !isset($_POST['uid'])) 
{
	echo "Error: POST variables not set.";
	exit();
}

// Make sure each field is not empty.
if (!trim($_POST['fname']) ||
   !trim($_POST['lname']) ||
   !trim($_POST['email']) ||
   !trim($_POST['area']) ||
   !trim($_POST['bio']) ||
   !trim($_POST['uid'])) 
{
	echo "Please fill out all fields.";
	exit();
}

// Make sure the person modifying data is the same user, or an admin.
if ($_SESSION['uid'] != $_POST['uid'] && $_SESSION['acc_type'] != "admin") {
	echo "Cannot modify other user's data without admin rights.";
	exit();
}

// Connect to DB.
$dbConnect = dbLink();
if ($dbConnect == NULL) {
	$_SESSION['msg'] = "Error: could not connect to database";
	echo "Error: could not connect to database";
	return false;
}

// SQL query.
$q = "UPDATE users SET
		fname = :fname,
		lname = :lname,
		email = :email,
		area = :area,
		bio = :bio
		WHERE users.id = :uid";	
$query = $dbConnect->prepare($q);
$query->bindParam(":fname", $_POST['fname']);
$query->bindParam(":lname", $_POST['lname']);
$query->bindParam(":email", $_POST['email']);
$query->bindParam(":area", $_POST['area']);
$query->bindParam(":bio", $_POST['bio']);
$query->bindParam(":uid", $_POST['uid']);
$result = $query->execute();
if ($result) {
	echo "User info updated successfully";
}
else {
	echo "SQL query error";
	print_r($_POST);
	http_response_code(404);
}


?>