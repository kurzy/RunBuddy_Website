<?php
	session_start();
	include_once('functions/functions.php');
	checkLoggedIn();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>RunBuddy | My Dashboard</title>
		<meta charset="utf-8" />
		<meta name="author" content="Jack Kearsley">
		<meta name="description" content="RunBuddy website">
		<link rel="icon" type="image/png" href="img/map_marker_favicon.png">
		<link rel="stylesheet" href="css/global.css" type="text/css">
		<link rel="stylesheet" href="css/dashboard.css" type="text/css">
		<!-- Leaflet maps API -->
		 <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css"
   integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
   crossorigin=""/>
		<script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js"
   integrity="sha512-nMMmRyTVoLYqjP9hrbed9S+FzjZHW5gY1TWCHA5ckwXZBadntCNs8kEqAWdrb9O7rxbCaA4lKTIWjDXZxflOcA=="
   crossorigin=""></script>
		<script type="text/javascript">
			// Store the URLs of images for the picture slider element.
			var photoURL = [];
			var pIndex = 0;
			// The map
			var mymap;
			function initDashboardPage() {
				var uid = <?php echo $_SESSION['uid']; ?>;
				getUserMenu();
				initMap();
				getUserRoutes(uid);
				getUserAchievements(uid);
				getUserPhotos(uid);
			}
			function openUploadPopup() {
				document.getElementById("upload_photo_input").click();
			}
		</script>
		<script type="text/javascript" src="js/visuals.js"></script>
		<script type="text/javascript" src="js/ajax.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	</head>
	
	<body onload="initDashboardPage()">
		<div id="bg_image_container">
		<img src="img/runner2.jpg" alt="background image" id="bg_image">
		</div>
		<div id="top_section">
			<div id="banner">
				<h1>RunBuddy <span class="subtitle">| My Dashboard</span></h1>
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
					<td id="maps_cell" rowspan="2">
						<h3>Recent Runs</h3>
						<select id="recent_runs_select" name="recent_runs_select" onchange="getRouteMap(this.value)">
							<option value="" disabled selected>Select A Recent Run</option>
							<!-- Filled by AJAX call -->
						</select>
						<div id="map_div">
						</div>
					</td>
					<td id="ach_cell">
						<h3 id="ach_title">Achievements</h3>
						<!-- Filled by AJAX call -->
					</td>
				</tr>
				<tr>
					<td id="photo_slider_cell">
						<h3>Photos</h3>
						<div id="photo_slider">
							<img class="slider_arrow" id="slider_left_arrow" src="img/slider_left.png" alt="slider_left" onclick="changeSliderPhoto(false)" title="Previous Photo">
							<img id="current_photo" src="" alt="Image slider" class=" displayed_photo">
							<img class="slider_arrow" id="slider_right_arrow" src="img/slider_right.png" alt="slider_right" onclick="changeSliderPhoto(true)" title="Next Photo">
							<img id="upload_photo_img" src="img/upload_photo_img.png" alt="Upload Photo" onclick="openUploadPopup()" title="Upload Photo">
							<form method="post" action="functions/uploadPhoto.php" enctype="multipart/form-data">
								<input id="upload_photo_input" type="file" name="photo_file" class="hidden" onchange="this.form.submit.click()">
								<input type="hidden" name="back_page" value="dashboard.php">
								<input type="submit" name="submit" class="hidden">
							</form>
						</div>
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