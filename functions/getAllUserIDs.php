<?php
// Returns all of the user IDs in the users table.
session_start();
include_once('functions.php');

if ($_SESSION['acc_type'] != "admin") {
	header("Location: ../index.php");
	exit();
}


$dbConnect = dbLink();
if ($dbConnect == NULL) {
	$_SESSION['msg'] = "Error: could not connect to database";
	header("Location: ../index.php");
	exit();
}

$q = "SELECT id FROM users";
$query = $dbConnect->prepare($q);
$result = $query->execute();
if ($result && $query->rowCount() > 0) {
	$retData = $query->fetchAll(PDO::FETCH_ASSOC);
	echo json_encode($retData);
}
else {
		http_response_code(404);
}


?>