<?php
	include_once('functions/functions.php');
	session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>RunBuddy | Home</title>
		<meta charset="utf-8" />
		<meta name="author" content="Jack Kearsley">
		<meta name="description" content="RunBuddy - Track your running activity">
		<link rel="icon" type="image/png" href="img/map_marker_favicon.png">
		<link rel="stylesheet" href="css/global.css" type="text/css">
		<link rel="stylesheet" href="css/index.css" type="text/css">
		<script type="application/javascript" src="js/visuals.js"></script>
		<script type="application/javascript" src="js/ajax.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script type="text/javascript">
			function initIndexPage() {
				getUserMenu();
				bannerAnimations();
			}
		</script>
	</head>
	
	<body onload="initIndexPage()">
		<div id="bg_image_container">
		<img src="img/runner2.jpg" alt="background image" id="bg_image">
		</div>
		<div id="top_section">
			<div id="banner">
				<h1>RunBuddy</h1>
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
					<td id="top_banner">
						<img src="img/banner_runner11.jpg" alt="Runner" id="top_banner_1">
						<img src="img/banner_runner7.jpg" alt="Runner" id="top_banner_2">
					</td>
				</tr>
				<tr>
					<td>
						<h3 id="banner_heading">
							RunBuddy. Challenge Yourself.
						</h3>
						<p>
							The latest innovation in wearable tech.
						</p>
					</td>
				</tr>
				<tr>
					<td id="btm_banner">
						<img src="img/banner_runner10.jpg" alt="Runner" id="btm_banner_1">
						<img src="img/banner_runner4.jpg" alt="Runner" id="btm_banner_2">
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