<?php
// Fill a <select> HTML element with <option> elements for each user.
// Admin only.

session_start();
include_once('functions.php');

if ($_SESSION['acc_type'] != "admin") {
	header("Location: ../index.php");
	exit();
}

$dbConnect = dbLink();
if ($dbConnect == NULL) {
	$_SESSION['msg'] = "Error: could not connect to database";
	header("Location index.php");
	exit();
}

$q = "SELECT id, email FROM users";
$query = $dbConnect->prepare($q);
$result = $query->execute();

if ($result && $query->rowCount() > 0) {
	while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
		echo '<option value="' . $row['id'] . '">' . $row['email'] . '</option>';
	}
}
else {
	http_response_code(404);
}


?>