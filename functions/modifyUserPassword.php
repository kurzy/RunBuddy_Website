<?php
// Modify a user's password.

session_start();
include_once('functions.php');

// Make sure POST variables are set.
if (!isset($_POST['password']) ||
    !isset($_POST['uid'])) 
{
	echo "Error: POST variables not set.";
	exit();
}

// Make sure each field is not empty.
if (!trim($_POST['password']) ||
    !trim($_POST['uid'])) 
{
	echo "Please fill out all fields.";
	exit();
}

// Make sure password length over 4 characters.
if (strlen($_POST['password']) <= 4) {
	echo "Password length must be greater than 4 characters";
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

// The user's email is used in the password encryption process, so retrieve it first.
$email_address = "";
$emailQ = "SELECT email FROM users WHERE id = :uid";
$emailQuery = $dbConnect->prepare($emailQ);
$emailQuery->bindParam(":uid", $_POST['uid']);
$result = $emailQuery->execute();
if ($result && $emailQuery->rowCount() > 0) {
	$ret = $emailQuery->fetch(PDO::FETCH_ASSOC);
	$email_address = $ret['email'];
}
else {
	echo "Error retrieving user email";
	http_response_code(404);
	exit();
}

// Update the user's password.
$q = "UPDATE users SET
		password = :password
		WHERE users.id = :uid";	
$query = $dbConnect->prepare($q);
$password = crypt($_POST['password'], $email_address);
$query->bindParam(":password", $password);
$query->bindParam(":uid", $_POST['uid']);
$result = $query->execute();
if ($result) {
	echo "Password changed successfully";
}
else {
	echo "Failed to update user password";
	http_response_code(404);
}










?>