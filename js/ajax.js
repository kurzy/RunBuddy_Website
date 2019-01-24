// AJAX functions that interact with PHP server code.

// Returns an XMLHttpRequest object for most browsers that support it.
// If using IE, will return an ActiveXObject.
function getXMLHTTP() {
	var xmlhttp;
	if (window.XMLHttpRequest) {
		xmlhttp = new XMLHttpRequest();
	}
	else {
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	return xmlhttp;
}


// Get a list of all the user IDs in the 'users' table.
function getAllUserIDs() {
	var xmlhttp = getXMLHTTP();
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			var userInfo = JSON.parse(this.responseText);
		}
	}
	xmlhttp.open("GET", "functions/getAllUserIDs.php", true);
	xmlhttp.send();
}


// Get information about a user specified by their user ID.
// Then fill a form with the returned data.
function fillFormUserInfo(uid) {
	var xmlhttp = getXMLHTTP();
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			var userInfo = JSON.parse(this.responseText);
			document.getElementsByName("modify_fname")[0].value = userInfo.fname;
			document.getElementsByName("modify_lname")[0].value = userInfo.lname;
			document.getElementsByName("modify_email")[0].value = userInfo.email;
			document.getElementsByName("modify_area")[0].value = userInfo.area;
			document.getElementsByName("modify_bio")[0].value = userInfo.bio;
		}
	}
	var postData = "uid=" + uid;
	xmlhttp.open("POST", "functions/getUserInfo.php", true);
	xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	xmlhttp.send(postData);
}


// Modify a user's information in the 'users' table in the database.
function modifyUserInfo(uid, f) {
	var xmlhttp = getXMLHTTP();
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			insertMessage(this.responseText);
		}
	}
	var postData = "fname=" + f.modify_fname.value + 
					"&lname=" + f.modify_lname.value + 
					"&email=" + f.modify_email.value + 
					"&area=" + f.modify_area.value + 
					"&bio=" + f.modify_bio.value +
					"&uid=" + uid;
	xmlhttp.open("POST", "functions/modifyUserInfo.php", true);
	xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	xmlhttp.send(postData);
}


// Modify a user's password.
function modifyUserPassword(uid, f) {
	var xmlhttp = getXMLHTTP();
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
		}
		insertMessage(this.responseText);
	}
	// Make sure 'password' and 'confirm password' fields match.
	var pwd = f.modify_password.value;
	var confirm_pwd = f.modify_password_confirm.value;
	if (pwd.localeCompare(confirm_pwd) != 0) {
		insertMessage("Passwords do not match");
		return false;
	}
	var postData = "password=" + pwd +
				   "&uid=" + uid;
	xmlhttp.open("POST", "functions/modifyUserPassword.php", true);
	xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	xmlhttp.send(postData);	
}


// Delete a user, specified by their user ID.
function deleteUser(uid) {
	var xmlhttp = getXMLHTTP();
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
		}
		insertMessage(this.responseText);
	}
	// Open popup window to confirm the delete operation.
	if (!confirm("Are you sure you want to delete this user?")) {
		return false;
	}
	var postData = "uid=" + uid;
	xmlhttp.open("POST", "functions/deleteUser.php", true);
	xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	xmlhttp.send(postData);
	console.log(postData);
}


// Get a selection of all users in the 'users' table.
function getUserSelection(select) {
	var xmlhttp = getXMLHTTP();
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			select.innerHTML = this.responseText;
		}
	}
	xmlhttp.open("GET", "functions/getUserSelection.php", true);
	xmlhttp.send();	
}


// Add a new user to the database, using the provided form data.
function addUser(f) {
	var xmlhttp = getXMLHTTP();
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
		}
		insertMessage(this.responseText);
	}
	var postData = "fname=" + f.add_fname.value + 
					"&lname=" + f.add_lname.value + 
					"&email=" + f.add_email.value + 
					"&password=" + f.add_password.value +
					"&area=" + f.add_area.value + 
					"&bio=" + f.add_bio.value;
	xmlhttp.open("POST", "functions/addUser.php", true);
	xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	xmlhttp.send(postData);
}



// Insert a short text message into the HTML document.
// Used to display confirmation or error messages after database interaction.
function insertMessage(text) {
	// Remove any previous messages first.
	var existingMessage = document.getElementsByClassName("session_msg");
	if (existingMessage.length > 0) {
		for (var i = 0; i < existingMessage.length; i++) {
			existingMessage[0].parentNode.removeChild(existingMessage[0]);
		}
	}
	var div = document.createElement("div");
	var p = document.createElement("p");
	var date = new Date();
	var t = document.createTextNode(text + " (" + date.toLocaleTimeString() + ")");
	p.appendChild(t);
	div.appendChild(p);
	div.className = "session_msg";
	var cc = document.getElementById("content_container");
	var b = document.getElementsByTagName("body")[0];
	b.insertBefore(div, cc);
}



// Get all photos from database that are owned by the logged-in user.
// A list of photo URLs are stored in the 'photoURL' array.
function getUserPhotos(uid) {
	var xmlhttp = getXMLHTTP();
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			var userInfo = JSON.parse(this.responseText);
			photoURL = userInfo;
			changeSliderPhoto(photoURL[0]);
		}
		// If user has no photos.
		else if (this.readyState == 4 && this.status == 404) {
			document.getElementById("current_photo").classList.add("hidden");
			var p = document.createElement("p");
			p.appendChild(document.createTextNode("No photos yet!"));
			document.getElementById("photo_slider").appendChild(p);
		}
	}
	var postData = "uid=" + uid; 
	xmlhttp.open("POST", "functions/getUserPhotos.php", true);
	xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	xmlhttp.send(postData);
}

// Get a user's achievements.
function getUserAchievements(uid) {
	var xmlhttp = getXMLHTTP();
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			var ach = JSON.parse(this.responseText);
			// Insert achievements into a HTML unordered list.
			var list = document.createElement("ul");
			list.id = "ach_list"
			for (var a in ach) {
				// Create a list item and append the achievement's title.
				var item = document.createElement("li");
				var spn = document.createElement("span");
				spn.classList.add("blue_dot_underline");
				spn.appendChild(document.createTextNode(ach[a].title));
				item.appendChild(spn);
				// Append a description to each list item.
				// The description appears when the mouse hovers over an achievement title.
				var dv = document.createElement("div");
				dv.appendChild(document.createTextNode(ach[a].description));
				dv.classList.add("hidden");
				item.appendChild(dv);
				// Mouseover functions.
				item.onmouseenter = function() {
					this.lastChild.classList.add("ach_tooltip");
				}
				item.onmouseleave = function() {
					this.lastChild.classList.remove("ach_tooltip");
				}
				list.appendChild(item);
			}
			// Insert the achievements list after the 'Achievements' title.
			var ach_cell = document.getElementById("ach_cell");
			ach_cell.insertBefore(list, ach_cell.lastChild);	
		}
		// If user has no achievements.
		else if (this.readyState == 4 && this.status == 404) {
			var p = document.createElement("p");
			p.appendChild(document.createTextNode("No achievements yet!"));
			document.getElementById("ach_cell").appendChild(p);
		}
	}
	var postData = "uid=" + uid; 
	xmlhttp.open("POST", "functions/getUserAchievements.php", true);
	xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	xmlhttp.send(postData);
}


// Gets the running routes for a specified user.
// Inserts each route as an <option> within the <select> element in the dashboard page.
function getUserRoutes(uid) {
	var xmlhttp = getXMLHTTP();
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			var routes = JSON.parse(this.responseText);
			var sel = document.getElementById("recent_runs_select");
			// Append each route as an <option> in the drop-down menu.
			for (var r in routes) {
				var option = document.createElement("option");
				option.value = routes[r].routeID;
				var inText = document.createTextNode(routes[r].time + ' - ' + routes[r].notes);
				option.appendChild(inText);
				sel.appendChild(option);
			}
		}
	}
	var postData = "uid=" + uid; 
	xmlhttp.open("POST", "functions/getUserRoutes.php", true);
	xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	xmlhttp.send(postData);
	
}


function getRouteMap(routeID) {
	var xmlhttp = getXMLHTTP();
	xmlhttp.onreadystatechange = function() { 
		if (this.readyState == 4 && this.status == 200) {
			var resp = JSON.parse(this.responseText);
			drawRoute(resp);
		}
	}
	var postData = "routeID=" + routeID; 
	xmlhttp.open("POST", "functions/getRouteCoords.php", true);
	xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	xmlhttp.send(postData);	
}


// Draw a route (set of lat/long coordinates) on the map, 
// and reposition the map view based on these coordinates.
function drawRoute(resp) {
	// Format coordinates for map API.
	var coords = []
	for (var c in resp) {
		coords.push([resp[c].latitude, resp[c].longitude]);
	}
	// Format of line drawn between coordinates.
	lineFormat = {
		color: 'red',
		opacity: 0.6,
		dashArray: "4"
	};
	var polyline = L.polyline(coords, lineFormat).addTo(mymap);
	mymap.fitBounds(polyline.getBounds());
	
	// Draw red circle for each intermediate coordinate
	var circleFormat = {
		color: 'red',
		fillColor: 'red',
		fillOpacity: 0.7,
		opacity: 0.7,
		radius: 6
	};
	for (var c in coords) {
		var thisCirc = L.circle(coords[c], circleFormat).addTo(mymap);
		thisCirc.bindPopup(resp[c].time);
	}
	// Draw start and finish circles.
	var endCircleFormat = {
		color: 'blue',
		fillColor: 'blue',
		fillOpacity: 1.0,
		radius: 7
	};
	var startCirc = L.circle(coords[0], endCircleFormat).addTo(mymap);
	startCirc.bindPopup("<b>Start: </b>" + resp[0].time);
	var endCirc = L.circle(coords[coords.length-1], endCircleFormat).addTo(mymap);
	endCirc.bindPopup("<b>Finish: </b>" + resp[resp.length-1].time);	
}


// Initialise the embedded map.
function initMap() {
	// Place the map within the #map_div element, and initialise it to the Gold Coast region.
	mymap = L.map('map_div').setView([-27.99, 153.4], 10);
	L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
		maxZoom: 30,
		attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
			'<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
			'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
		id: 'mapbox.streets'
	}).addTo(mymap);
	L.control.scale().addTo(mymap);
}


// Get the leaderboard for a an area specified by a search term.
// Add the results back into the page as an unordered list.
function getLeaderboard(f) {
	var xmlhttp = getXMLHTTP();
	var ul = document.getElementById("search_results_ul");
	// Clear the previous search results.
	while (ul.firstChild) {
		ul.removeChild(ul.firstChild);
	}
	var stitle = document.getElementById("search_results_title");
	stitle.innerHTML = "";
	xmlhttp.onreadystatechange = function() { 
		if (this.readyState == 4 && this.status == 200) { 
			var sresults = JSON.parse(this.responseText);
			// Insert new search results.
			for (var p in sresults) {
				var li = document.createElement("li");
				var spn = document.createElement("span");
				spn.classList.add("name_result");
				spn.appendChild(document.createTextNode(sresults[p]['fname'] + " " + sresults[p]['lname']));
				li.appendChild(spn);
				var dist = parseFloat(sresults[p].dist).toFixed(2);
				li.appendChild(document.createTextNode(": " + dist + " km"));
				ul.appendChild(li);
			}
			$("#search_results_ul").fadeIn(100);
		}
		stitle.innerHTML = "Search Results for '" + encodeURI(f.search_area.value) + "':";
	}
	var postData = "search_area=" + f.search_area.value; 
	xmlhttp.open("POST", "functions/getLeaderboard.php", true);
	xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	xmlhttp.send(postData);
}


// Requests the user menu from the server.
// The server will set the menu's thumbnail as the user's profile picture, if one is provided.
function getUserMenu() {
	var xmlhttp = getXMLHTTP();
	xmlhttp.onreadystatechange = function() { 
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("user_menu_button").innerHTML = this.responseText;			
		}
	}
	xmlhttp.open("GET", "functions/getUserMenu.php", true);
	xmlhttp.send();
}

