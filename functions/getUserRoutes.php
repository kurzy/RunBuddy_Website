<?php
// Get some data about the routes a particular user has been on.

session_start();
include_once('functions.php');

$dbConnect = dbLink();
if ($dbConnect == NULL) {
	$_SESSION['msg'] = "Error: could not connect to database";
	header("Location index.php");
	exit();
}

$q = "SELECT user_routes.routeID, user_routes.notes, routes.time 
	  FROM user_routes, routes 
	  WHERE user_routes.userID = :uid
	  AND user_routes.routeID = routes.routeID
	  GROUP BY user_routes.routeID";
$query = $dbConnect->prepare($q);
$query->bindParam(":uid", $_POST['uid']);
$result = $query->execute();
if ($result && $query->rowCount() > 0) {
	$retData = $query->fetchAll(PDO::FETCH_ASSOC);
	echo json_encode($retData);
}
else {
	http_response_code(404);
}


?>