<?php
	include_once('functions/functions.php');
	session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>RunBuddy | Contact Us</title>
		<meta charset="utf-8" />
		<meta name="author" content="Jack Kearsley">
		<meta name="description" content="RunBuddy Website">
		<link rel="icon" type="image/png" href="img/map_marker_favicon.png">
		<link rel="stylesheet" href="css/global.css" type="text/css">
		<link rel="stylesheet" href="css/contact.css" type="text/css">
		<script type="application/javascript" src="js/visuals.js"></script>
		<script type="application/javascript" src="js/ajax.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script>
			window.onload = function() {
				getUserMenu();
			}
		</script>
	</head>
	
	<body>
		<div id="bg_image_container">
		<img src="img/runner2.jpg" alt="background image" id="bg_image">
		</div>
		<div id="top_section">
			<div id="banner">
				<h1>RunBuddy <span class="subtitle">| Contact Us</span></h1>
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
			if (isset($_SESSION['msg'])) {
				echo "<div class='session_msg'><p>" . $_SESSION['msg'] . "</p></div>";
				unset($_SESSION['msg']);
			}
		?>
		<!------------------------- END top_section ------------------------------>
			
		<div id="content_container">
			<div id="form_container">
				<h3>Contact Form</h3>
				<p>
					Let us know what's working and what's not.
					We appreciate all of your feedback and will get back to you as soon as possible!
				</p>
				<form method="post" action="functions/sendContactForm.php">
					<input type="text" name="firstname" placeholder="First Name"><br>
					<input type="text" name="lastname" placeholder="Last Name"><br>
					<input type="text" name="emailaddress" placeholder="Email Address"><br>
					<input type="text" name="subject" placeholder="Subject"><br>
					<textarea id="contact_message" cols="80" rows="7" name="contact_message" placeholder="Message"></textarea><br>
					<input type="submit" name="submit" value="Send Email">
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