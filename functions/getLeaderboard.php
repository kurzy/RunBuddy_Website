<?php
session_start();
include_once('functions.php');



$dbConnect = dbLink();
if ($dbConnect == NULL) {
	$_SESSION['msg'] = "Error: could not connect to database";
	header("Location index.php");
	exit();
}
if (!isset($_POST['search_area'])) {
	$_SESSION['msg'] = "Please submit a search term";
	header("Location dashboard.php");
	exit();
}

$q = "SELECT users.fname, users.lname, SUM(user_routes.distance) AS dist
	FROM user_routes, users
	WHERE user_routes.userID = users.id
	AND users.area = :search_area
	GROUP BY users.id
	ORDER BY dist DESC";
$query = $dbConnect->prepare($q);
$query->bindParam(":search_area", $_POST['search_area']);
$result = $query->execute();

if ($result && $query->rowCount() > 0) {
	$retData = $query->fetchAll(PDO::FETCH_ASSOC);
	echo json_encode($retData);
}
else {
	http_response_code(404);
}




?>