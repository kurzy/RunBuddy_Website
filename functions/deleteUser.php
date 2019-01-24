<?php
session_start();
include_once('functions.php');
// Deletes a user from the database, based on their ID.
// Can only be executed by an admin account.
if (!isset($_SESSION['acc_type']) || $_SESSION['acc_type'] != "admin") {
	echo "Error: This account does not have sufficient privileges for delete operation.";
	http_response_code(403);
	exit();
}
// If no user selected for deletion.
if (!isset($_POST['uid']) || (!trim($_POST['uid']))) {
	echo "Error: Please select a user for deletion.";
	http_response_code(400);
	exit();
}
// An admin account cannot delete itself.
if ($_POST['uid'] === $_SESSION['uid']) {
	echo "Admin account cannot delete itself";
	http_response_code(400);
	exit();
}
// Connect to database.
$dbConnect = dbLink();
if ($dbConnect == NULL) {
	echo "Error: could not connect to database";
	http_response_code(500);
	return false;
}
$uid = $_POST['uid'];

// Delete user information from various tables.
$q = "DELETE FROM users WHERE id = :uid";
$query = $dbConnect->prepare($q);
$query->bindParam(":uid", $uid);
$result = $query->execute();

$q = "DELETE FROM user_achievements WHERE userID = :uid";
$query = $dbConnect->prepare($q);
$query->bindParam(":uid", $uid);
$result = $query->execute();

$q = "DELETE FROM user_profile_photo WHERE userID = :uid";
$query = $dbConnect->prepare($q);
$query->bindParam(":uid", $uid);
$result = $query->execute();

$q = "DELETE FROM user_routes WHERE userID = :uid";
$query = $dbConnect->prepare($q);
$query->bindParam(":uid", $uid);
$result = $query->execute();

if ($result) {
	echo "User deleted successfully.";
}
else {
	echo "Error deleting user.";
}

?>
