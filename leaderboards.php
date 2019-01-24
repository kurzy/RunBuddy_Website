<?php
	include_once('functions/functions.php');
	session_start();
	checkLoggedIn();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>RunBuddy | Leaderboards</title>
		<meta charset="utf-8">
		<meta name="author" content="Jack Kearsley">
		<meta name="description" content="RunBuddy Leaderboards">
		<link rel="icon" type="image/png" href="img/map_marker_favicon.png">
		<link rel="stylesheet" href="css/global.css" type="text/css">
		<link rel="stylesheet" href="css/leaderboards.css" type="text/css">
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
				<h1>RunBuddy <span class="subtitle">| Leaderboards</span></h1>
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
			<div id="search_bar">
				<form onsubmit="getLeaderboard(this); return false;">
					<input type="text" name="search_area" placeholder="Search An Area">
					<input type="submit" name="submit" value="Search">
				</form>
			</div>
			
			<div id="search_results">
				<h3 id="search_results_title"></h3>
				<ul id="search_results_ul" class="hidden">
				</ul>
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