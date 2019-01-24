<?php

// Attempts to log in a registered user.
// Encrypted hash of the password for the user with '$email'.
// Then compare this with the provided password.
session_start();
include_once("functions.php");
if (!isset($_POST['email_login']) || !isset($_POST['password_login'])) {
	$_SESSION['msg'] = "Please fill out both fields";
	header("Location: ../index.php");
	exit();
}

$dbConnect = dbLink();
if ($dbConnect == NULL) {
	$_SESSION['msg'] = "Error: could not connect to database";
	return false;
}
$email = $_POST['email_login'];
$password = $_POST['password_login'];

$q = "SELECT * FROM users WHERE email = :email";
$query = $dbConnect->prepare($q);
$query->bindParam(":email", $email);
$ret = $query->execute();
// If the user exists, compare the two password hashes.
if ($ret && $query->rowCount() > 0) {
	$retData = $query->fetch(PDO::FETCH_ASSOC);
	// If user logs in successfully, return a session ID.
	if ($retData['password'] == crypt($password, $email)) {
		$_SESSION['msg'] = 'Login successful!';
		$_SESSION['loggedIn'] = true;
		$_SESSION['uid'] = $retData['id'];
		$_SESSION['email'] = $retData['email'];
		$_SESSION['fname'] = $retData['fname'];
		$_SESSION['lname'] = $retData['lname'];
		$_SESSION['area'] = $retData['area'];
		$_SESSION['bio'] = $retData['bio'];
		$_SESSION['acc_type'] = $retData['acc_type'];
	}
	else {
		$_SESSION['msg'] = 'Error: Incorrect password.';
	}
}
else {
	$_SESSION['msg'] = 'Error: User does not exist.';
}

?>

<!DOCTYPE html>
<html>
	<head>
		<script type="text/javascript">
			function redirect() {
				window.location.href = "../index.php";
			}
		</script>
	</head>
	<body onload="redirect()">
	</body>
</html>
