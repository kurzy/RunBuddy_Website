<?php
// Retrieve information from 'users' table with a specified user ID.

session_start();
include_once('functions.php');

// Make sure normal users can only look up their own information, and not others.
if ($_SESSION['acc_type'] != "admin" && $_SESSION['uid'] != $_POST['uid']) 
{
	header("Location: ../index.php");
	exit();
}

$dbConnect = dbLink();
if ($dbConnect == NULL) {
	$_SESSION['msg'] = "Error: could not connect to database";
	header("Location index.php");
	exit();
}

$q = "SELECT email, fname, lname, area, bio FROM users WHERE id = :uid";
$query = $dbConnect->prepare($q);
$query->bindParam(":uid", $_POST['uid']);
$result = $query->execute();

if ($result && $query->rowCount() > 0) {
	$retData = $query->fetch(PDO::FETCH_ASSOC);
	echo json_encode($retData);
}
else {
	http_response_code(404);
}
?>