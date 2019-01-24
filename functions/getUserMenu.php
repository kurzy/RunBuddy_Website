<?php
// Builds the user menu. If a user has a profile picture set, this profile picture
// becomes the thumbnail image.

session_start();
include_once('functions.php');

$dbConnect = dbLink();
if ($dbConnect == NULL) {
	$_SESSION['msg'] = "Error: could not connect to database";
	header("Location index.php");
	exit();
}

// If user is not logged in.
if (!isset($_SESSION['uid'])) {
	echo "<div id=\"top_button\">
			<table id=\"top_table\" onclick=\"toggleLoginPopup(true)\" onmouseover=\"hoverUserMenu(true)\" onmouseout=\"hoverUserMenu(false)\">
				<tr>
					<td><img src=\"img/default_user_icon.png\" alt=\"profile pic\" id=\"default_user_img\"></td>
					<td>" . 'Log In' . "</td>
				</tr>
			</table>
		</div>";
}
// If user is logged in.
else {
	// Get profile picture from database.
	$q = "SELECT photos.URL
	FROM photos, user_profile_photo
	WHERE user_profile_photo.userID = photos.userID
	AND user_profile_photo.imageID = photos.ID
	AND photos.userID = :uid";
	$query = $dbConnect->prepare($q);
	$query->bindParam(":uid", $_SESSION['uid']);
	$result = $query->execute();
	
	$imgURL = "";
	$fname = $_SESSION['fname'];
	// If user has profile picture
	if ($result && $query->rowCount() > 0) {
		$retData = $query->fetch(PDO::FETCH_ASSOC);
		$imgURL = $retData['URL'];
	}
	else {
		$imgURL = "img/default_user_icon.png";
	}

	echo '<div id="top_button" onmouseover="hoverUserMenu(true)" onmouseout="hoverUserMenu(false)">
			<table id="top_table" onclick="toggleUserMenu()">
				<tr>
					<td><img src="' . $imgURL . '" alt="profile pic" id="default_user_img"></td>
					<td>' . $fname . '</td>
					<td><img src="img/down_arrow.png" alt="down arrow" id="down_arrow_img"></td>
				</tr>
			</table>
		</div>
		<div id="user_dropdown_menu" class=\'hidden\'>
			<table>
				<tr onclick="goToPage(\'dashboard.php\')">
					<td><img src="img/speedo.png" alt="dash"></td>
					<td>My Dashboard</td>
				</tr>
				<tr onclick="goToPage(\'leaderboards.php\')">
					<td><img src="img/trophy.png" alt="trophy"></td>
					<td>Leaderboards</td>
				</tr>
				<tr onclick="goToPage(\'info.php\')">
					<td><img src="img/info.png" alt="info"></td>						
					<td>My Info</td>
				</tr>
				<tr onclick="goToPage(\'functions/signout.php\')">
					<td><img src="img/standby.png" alt="sign out"></td>
					<td>Sign Out</td>
				</tr>
			</table>
		</div>';
}




?>