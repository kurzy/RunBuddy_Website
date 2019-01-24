<?php
	include_once('functions/functions.php');
	session_start();
	if (!isset($_SESSION['acc_type']) || $_SESSION['acc_type'] != "admin") {
		header('Location: index.php');
		exit();
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>RunBuddy | Admin</title>
		<meta charset="utf-8" />
		<meta name="author" content="Jack Kearsley">
		<meta name="description" content="RunBuddy website">
		<link rel="icon" type="image/png" href="img/map_marker_favicon.png">
		<link rel="stylesheet" href="css/global.css" type="text/css">
		<link rel="stylesheet" href="css/admin.css" type="text/css">
		<script type="application/javascript" src="js/visuals.js"></script>
		<script type="application/javascript" src="js/ajax.js"></script>
		<script type="text/javascript">
			function initAdminPage() {
				var uid = <?php echo $_SESSION['uid']; ?>;
				fillFormUserInfo(uid);
				getUserSelection(document.getElementById("user_del_select"));
				getUserSelection(document.getElementById("user_mod_select"));
				getUserMenu();
			}
		</script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	</head>
	
	<body onload="initAdminPage()">
		<div id="bg_image_container">
		<img src="img/runner2.jpg" alt="background image" id="bg_image">
		</div>
		<div id="top_section">
			<div id="banner">
				<h1>RunBuddy <span class="subtitle" style="font-family:Courier">| Admin</span></h1>
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
		<?php // Display any messages set by a PHP execution.
			displayServerMessage();
		?>
		<!------------------------- END top_section ------------------------------>
			
		<div id="content_container">
			<div id="admin_controls">
				<h3>Admin Controls</h3>
				<table>
					<tr>
						<td id="add_user">
							<p>Add User</p>
							<form method="post" onsubmit="addUser(this); return false;">
								<input type="text" name="add_fname" placeholder="First Name">
								<input type="text" name="add_lname" placeholder="Last Name">
								<input type="text" name="add_email" placeholder="Email Address">
								<input type="password" name="add_password" placeholder="Password">
								<input type="text" name="add_area" placeholder="Suburb or Area">
								<textarea id="aboutme" name="add_bio" cols="60" rows="5" placeholder="About"></textarea>
								<br>
								<input type="submit" value="Add User">
							</form>
						</td>
						<td id="modify_user">
							<p>Modify User Info</p>
							<form method="post" onsubmit="modifyUserInfo(this.userMod.value, this); return false;">
								<label>User:</label>
								<select name="userMod" id="user_mod_select" onchange="fillFormUserInfo(this.value)">
								</select>
								<br>
								<label>First Name:</label>
								<input type="text" name="modify_fname" placeholder="First Name"><br>
								<label>Last Name:</label>
								<input type="text" name="modify_lname" placeholder="Last Name"><br>
								<label>Email:</label>
								<input type="text" name="modify_email" placeholder="Email Address"><br>
								<label>Area:</label>
								<input type="text" name="modify_area" placeholder="Suburb or Area"><br>
								<label>Bio:</label>
								<textarea cols="60" rows="5" name="modify_bio" placeholder="About Me"></textarea>
								<input type="hidden" name="modify_uid" value="<?php echo $_SESSION['uid']; ?>">
								<br>
								<input type="submit" value="Modify User">
							</form>
						</td>
					</tr>
					<tr>
						<td id="delete_user">
							<p>Delete User</p>
							<form method="post" onsubmit="deleteUser(this.userDel.value); getUserSelection(this.userDel); return false;">
								<select name="userDel" id="user_del_select">
								</select>
								<br>
								<input type="submit" value="Delete User">
							</form>
						</td>
					</tr>
				</table>
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