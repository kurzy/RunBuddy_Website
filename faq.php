<?php
	include_once('functions/functions.php');
	session_start();


?>

<!DOCTYPE html>
<html>
	<head>
		<title>RunBuddy | How It Works</title>
		<meta charset="utf-8" />
		<meta name="author" content="Jack Kearsley">
		<meta name="description" content="Runbuddy - How It Works">
		<link rel="icon" type="image/png" href="img/map_marker_favicon.png">
		<link rel="stylesheet" href="css/global.css" type="text/css">
		<link rel="stylesheet" href="css/faq.css" type="text/css">
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
				<h1>RunBuddy <span class="subtitle">| How It Works</span></h1>
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
			<table>
				<tr>
					<td>
						<h3>Making Fitness Fun</h3>
						<p id="para1">
							RunBuddy allows you to track the routes and distance of your runs using a GPS-enabled smart phone or smart watch. Keep running to earn acheivements and work your way to the top of your local leaderboard.
						</p>
					</td>
					<td>
						<img src="img/smart_watch.jpg" alt="Smart Watch">
					</td>
				</tr>
				<tr>
					<td>
						<h3>How To Get Started</h3>
						<ol>
							<li>Download the RunBuddy app for your smart phone or smart watch.</li>	
							<li>Sign up or log in to your account in the RunBuddy app.</li>
							<li>Allow RunBuddy to access GPS information while using the app.</li>
							<li>Lace up your running shoes, tap '<i>Start Route</i>' and get to it!</li>
						</ol>
					</td>
					<td>
						<img src="img/map_example.png" alt="Map Route">
					</td>
				</tr>
			</table>
		</div>
		<?php
			buildLoginSwitcher();
		?>
		<?php
			buildFooter();
		?>
	</body>
</html>