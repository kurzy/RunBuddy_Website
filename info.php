<?php
	session_start();
	include_once('functions/functions.php');
	checkLoggedIn();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>RunBuddy | My Info</title>
		<meta charset="utf-8" />
		<meta name="author" content="Jack Kearsley">
		<meta name="description" content="Track your running activity">
		<link rel="icon" type="image/png" href="img/map_marker_favicon.png">
		<link rel="stylesheet" href="css/global.css" type="text/css">
		<link rel="stylesheet" href="css/info.css" type="text/css">
		<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
		<script type="application/javascript" src="js/visuals.js"></script>
		<script type="application/javascript" src="js/ajax.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script type="text/javascript">
			function initInfoPage() {
				var uid = <?php echo $_SESSION['uid']; ?>;
				getUserMenu();
				fillFormUserInfo(uid);
			}
		</script>
	</head>
	
	<body onload="initInfoPage()">
		<div id="bg_image_container">
		<img src="img/runner2.jpg" alt="background image" id="bg_image">
		</div>
		<div id="top_section">
			<div id="banner">
				<h1>RunBuddy <span class="subtitle">| My Info</span></h1>
			</div>

			<div id="outer_navbar_container">
				<div id="inner_navbar_public">
					<?php
						buildNavBar();
					?>
				</div>
				<div id="user_menu_button" class="unselectable">
				</div>
			</div>
		</div> 
		<?php 
			// Display any messages set by a PHP execution.
			displayServerMessage();
		?>
		<!------------------------- END top_section ------------------------------>
			
		<div id="content_container">
			<div class="form_container" id="modify_info_container">
				<p>Update your information</p>
				<form method="post" id="modify_info_form" onsubmit="modifyUserInfo(<?php echo $_SESSION['uid']; ?>, this); return false;">
					<label>First Name:</label>
					<input type="text" name="modify_fname" placeholder="First Name">
					<label>Last Name:</label>
					<input type="text" name="modify_lname" placeholder="Last Name">
					<label>Email:</label>
					<input type="text" name="modify_email" placeholder="Email Address">
					<label>Area</label>
					<input type="text" name="modify_area" placeholder="Suburb or Area">
					<label>About Me:</label>
					<textarea cols="60" rows="5" name="modify_bio" placeholder="About Me"></textarea>
					<br>
					<input type="submit" value="Update Info">
				</form>
			</div>
			<div class="form_container" id="modify_password_container">
				<p>Change your password</p>
				<form method="post" id="modify_password_form" onsubmit="modifyUserPassword(<?php echo $_SESSION['uid']; ?>, this); return false;">
					<label>Password:</label>
					<input type="password" name="modify_password" placeholder="Password">
					<input type="password" name="modify_password_confirm" placeholder="Confirm Password">
					<input type="submit" value="Update Password">
				</form>
			</div>
			<div class="form_container" id="modify_profile_photo_container">
				<p>Upload profile photo</p>
				<form method="post" action="functions/uploadPhoto.php" enctype="multipart/form-data">
					<input id="upload_photo_input" type="file" name="photo_file">
					<input type="hidden" name="back_page" value="info.php">
					<input type="hidden" name="profile_photo" value="true">
					<input type="submit" name="submit" value="Upload">
				</form>
			</div>
		</div>
		
		<?php
			buildLoginSwitcher();
		?>
		<?php
			buildFooter();
		?>
	</body>
</html>