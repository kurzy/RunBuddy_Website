<?php
// Adds a new user to the 'users' table.

session_start();
include_once('functions.php');

// Check if form was submitted completely.
if (!isset($_POST['email']) ||
	!isset($_POST['fname']) ||
	!isset($_POST['lname']) ||
	!isset($_POST['area']) ||
	!isset($_POST['password']) ||
	!isset($_POST['bio'])
   ) 
{
	echo "Please fill out all fields";
	http_response_code(400);
	exit();
}

// Make sure password length over 4 characters.
if (strlen($_POST['password']) <= 4) {
	echo "Password length must be greater than 4 characters";
	exit();
}

// Connect to database.
$dbConnect = dbLink();
if ($dbConnect == NULL) {
	$_SESSION['msg'] = "Error: could not connect to database";
	return false;
}

$email = $_POST['email'];
$password = crypt($_POST['password'], $email);
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$area = $_POST['area'];
$bio = $_POST['bio'];

// First, make sure a user with this email doesn't already exist.
$check = "SELECT * FROM users WHERE email = :email";
$checkQuery = $dbConnect->prepare($check);
$checkQuery->bindParam(":email", $email);
$checkQuery->execute();
if ($checkQuery->rowCount() > 0) {
	echo "Email address already in use.";
	http_response_code(404);
	exit();
}
// Prepare and execute the SQL insertion command.
$q = "INSERT INTO users (id, email, password, acc_type, creation_date, fname, lname, area, bio)
VALUES (NULL, :email, :password, NULL, NOW(), :fname, :lname, :area, :bio)";
$query = $dbConnect->prepare($q);
$query->bindParam(":email", $email);
$query->bindParam(":password", $password);
$query->bindParam(":fname", $fname);
$query->bindParam(":lname", $lname);
$query->bindParam(":area", $area);
$query->bindParam(":bio", $bio);
$result = $query->execute();
if ($result) {
	echo "Account added successfully!";
	if (!isset($_SESSION['loggedIn']) || !$_SESSION['loggedIn']) {
		$_SESSION['loggedIn'] = true;
		$_SESSION['email'] = $email;
		$_SESSION['fname'] = $fname;
		$_SESSION['lname'] = $lname;
		$_SESSION['area'] = $area;
		$_SESSION['bio'] = $bio;
		$_SESSION['acc_type'] = NULL;
	}
}
else {
	echo "Error adding account to database";
	http_response_code(400);
	exit();
}



?>