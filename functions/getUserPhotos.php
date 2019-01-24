<?php
// Get a list of image URLs belonging to a specified user.

session_start();
include_once('functions.php');

// Check if user ID received from POST data.
if (!isset($_POST['uid'])) {
	http_response_code(403);
	header("Location: ../index.php");
	exit();
}
$uid = $_POST['uid'];

// If someone tries to access another user's photos, exit.
if ($_SESSION['uid'] != $uid && $_SESSION['acc_type'] != "admin") {
	http_response_code(403);
	exit();
}


$dbConnect = dbLink();
if ($dbConnect == NULL) {
	$_SESSION['msg'] = "Error: could not connect to database";
	header("Location index.php");
	exit();
}

$q = "SELECT photos.URL FROM photos WHERE photos.userID = :uid";
$query = $dbConnect->prepare($q);
$query->bindParam(":uid", $uid);
$result = $query->execute();


if ($result && $query->rowCount() > 0) {
	$retData = $query->fetchAll(PDO::FETCH_COLUMN, 0);
	echo json_encode($retData);
}
else {
	http_response_code(404);
}
?>