<?php

// Return a PDO object that connects with the 's5007230' database.
function dbLink() {
	$db_user = "advweb";
	$db_pass = "password";
	$db_host = "localhost";
	$db = "s5007230";
	try {
		$db = new PDO("mysql:host=$db_host;dbname=$db", $db_user, $db_pass);
	} catch (Exception $e) {
		echo "Unable to access database";
		exit;
	}
	error_reporting(0);
	return $db;
}


// If user is logged in, the user menu will display a menu when clicked.
// If user is not logged in, the user menu will display a login/signup prompt when clicked.
function buildUserMenu() {
	if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) {
		echo '
					<div id="top_button" onmouseover="hoverUserMenu(true)" onmouseout="hoverUserMenu(false)">
						<table id="top_table" onclick="toggleUserMenu()">
							<tr>
								<td><img src="img/default_user_icon.png" alt="profile pic" id="default_user_img"></td>
								<td>' . $_SESSION['fname'] . '</td>
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
					</div>
			';
	}
	else {
		echo "
			<div id=\"top_button\">
				<table id=\"top_table\" onclick=\"toggleLoginPopup(true)\" onmouseover=\"hoverUserMenu(true)\" onmouseout=\"hoverUserMenu(false)\">
					<tr>
						<td><img src=\"img/default_user_icon.png\" alt=\"profile pic\" id=\"default_user_img\"></td>
						<td>" . 'Log In' . "</td>
					</tr>
				</table>
			</div>
		";
	}
}


// Admin accounts will receive an additional link to the admin page on the nav bar.
function buildNavBar() {
	echo '<ul>
			<a href="index.php"><li>Home</li></a>
			<a href="faq.php"><li>How It Works</li></a>
			<a href="contact.php"><li>Contact Us</li></a>
		';
	if (isset($_SESSION['acc_type']) && $_SESSION['acc_type'] == "admin") {
		echo '<a href="admin.php"><li>Admin</li></a>';
	}
	echo '</ul>';
}


function buildFooter() {
	echo '<div id="footer">
			<div id="footer_inner">
				<p>&copy; Jack Kearsley, 2018.
					<a href="mailto:jack.kearsley@griffithuni.edu.au?Subject=RunBuddy" target="_blank">
						jack.kearsley@griffithuni.edu.au
					</a>
				</p>
			</div>
		</div>';
}

function buildLoginSwitcher() {
	echo '<div id="login_div" class="hidden">
			<div id="exit_button" onclick="toggleLoginPopup(false)">
				<img src="img/cross.png" alt="exit">
			</div>
			<div id="login_title">
				<h3>Let\'s get to it!</h3>
			</div>
			<table id="login_switchers">
				<tr>
					<td id="switch_login" class="active_switcher" 
						onclick="toggleLoginForm(this)">
						Login
					</td>
					<td id="switch_signup" class="hidden_switcher" 
						onclick="toggleLoginForm(this)">
						Sign Up
					</td>
				</tr>
			</table>
			<form method="post" id="signup_form" class="hidden_form" onsubmit="addUser(this); toggleLoginPopup(false); return false;">
				<input type="text" name="add_fname" placeholder="First Name">
				<input type="text" name="add_lname" placeholder="Last Name">
				<input type="text" name="add_email" placeholder="Email Address">
				<input type="password" name="add_password" placeholder="Password">
				<input type="text" name="add_area" placeholder="Suburb or Area">
				<textarea id="aboutme" cols="60" rows="5" name="add_bio" placeholder="About Me"></textarea>
				<br>
				<input type="submit" value="Sign Up">
			</form>
			
			<form method="post" id="login_form" class="active_form" action="functions/loginUser.php">
				<input type="text" name="email_login" placeholder="Email Address">
				<input type="password" name="password_login" placeholder="Password">
				<input type="submit" value="Log In">
			</form>
		</div>';
}

// Display any messages sent back from server in the $_SESSION['msg'] variable.
function displayServerMessage() {
	if (isset($_SESSION['msg'])) {
		date_default_timezone_set("Australia/Brisbane");
		echo "<div class='session_msg'><p>" . $_SESSION['msg'] . " (" . date('H:i:s') . ") " . "</p></div>";
		unset($_SESSION['msg']);
	}
}

// If a public user tries to access a private/registered user page, redirect them to the index page.
function checkLoggedIn() {
	if (!isset($_SESSION['loggedIn']) || !$_SESSION['loggedIn']) {
		$_SESSION['msg'] = "Please login to access '" . basename($_SERVER['PHP_SELF']) . "'.";
		header("Location: index.php");
		exit();
	}
}


?>