<?php
session_start();
include_once('functions.php');

$uid = $_POST['uid'];

// If someone tries to access another user's achievements, exit.
if ($_SESSION['uid'] != $uid && $_SESSION['acc_type'] != "admin") {
	http_response_code(403);
	exit();
}

// Connect to DB.
$dbConnect = dbLink();
if ($dbConnect == NULL) {
	$_SESSION['msg'] = "Error: could not connect to database";
	http_response_code(500);
	exit();
}

$q = "SELECT achievements.title, achievements.description 
	 FROM achievements, user_achievements 
	 WHERE user_achievements.userID = :uid
	 AND user_achievements.achID = achievements.achID";
$query = $dbConnect->prepare($q);
$query->bindParam(":uid", $uid);
$result = $query->execute();
if ($result && $query->rowCount() > 0) {
	$retData = $query->fetchAll(PDO::FETCH_ASSOC);
	echo json_encode($retData);
}
else {
	http_response_code(404);
}

?>