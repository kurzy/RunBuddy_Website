<?php
session_start();
include_once('functions.php');

$dbConnect = dbLink();
if ($dbConnect == NULL) {
	$_SESSION['msg'] = "Error: could not connect to database";
	header("Location index.php");
	exit();
}

$q = "SELECT latitude, longitude, time
	  FROM routes WHERE routeID = :routeID";
$query = $dbConnect->prepare($q);
$query->bindParam(":routeID", $_POST['routeID']);
$result = $query->execute();

if ($result && $query->rowCount() > 0) {
	$retData = $query->fetchAll(PDO::FETCH_ASSOC);
	echo json_encode($retData);
}
else {
	http_response_code(404);
}
?>