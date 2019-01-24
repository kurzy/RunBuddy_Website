// Javascript functions for changing visual elements of the website. 

// Open/close animation when user menu is clicked.
function toggleUserMenu() {
	$("#user_dropdown_menu").toggle(100);	
}

// Changes user menu color when mouse hovers over.
function hoverUserMenu(hover) {
	if (hover) {
		$("#top_button").css("background-color", "#ff9400");
	}
	else {
		$("#top_button").css("background-color", "#ffbc5e");
	}
}

// Redirects user to another webpage.
// This function is used to make the <tr> and <td> tags link to other pages,
// because these tags cannot be enclosed within <a> tags.
function goToPage(url) {
	window.location.assign(url);
}

// Toggles between the 'Log In' and 'Sign Up' forms within the popup window.
function toggleLoginForm(btn) {
	var on_button, on_form, off_button, off_form;
	on_button = btn;
	if (btn.id == "switch_login") {
		on_form = document.getElementById("login_form");
		off_button = document.getElementById("switch_signup");
		off_form = document.getElementById("signup_form");
	}
	else if (btn.id == "switch_signup") {
		on_form = document.getElementById("signup_form");
		off_button = document.getElementById("switch_login");
		off_form = document.getElementById("login_form");
		
	}
	on_button.classList.remove("hidden_switcher");
	on_button.classList.add("active_switcher");
	on_form.classList.remove("hidden");
	on_form.classList.add("visible");
	off_button.classList.remove("active_switcher");
	off_button.classList.add("hidden_switcher");
	off_form.classList.remove("visible");
	off_form.classList.add("hidden");	
}

// Open or close the popup window for logging in.
// Open popup when (opening == false).
// Close popup when (opening == true).
function toggleLoginPopup(opening) {
	var lg = document.getElementById("login_div");
	if (opening) {
		lg.classList.remove("hidden");
		lg.classList.add("visible");
		lg.classList.add("fade_in_switch");
	}
	else {
		lg.classList.remove("fade_in_switch");
		lg.classList.remove("visible");
		lg.classList.add("hidden");
	}
}

// Changes the displayed slider photo forwards or backwards.
function changeSliderPhoto(forward) {
	if (forward) pIndex++;
	else pIndex--;
	var img = document.getElementById("current_photo");
	img.src = photoURL[Math.abs(pIndex) % photoURL.length];	
}

// Toggle the animations on the banner images on home page.
function bannerAnimations() {
	var sduration = 5500;
	var btm_delay = 3000;

	var top1 = document.getElementById("top_banner_1");
	var top2 = document.getElementById("top_banner_2");	
	var topInterval1 = setInterval(function() {
		top2.classList.add("banner_fade_out");
		top1.classList.remove("banner_fade_out");
	}, sduration);
	var topInterval2 = setInterval(function() {
		top1.classList.add("banner_fade_out");
		top2.classList.remove("banner_fade_out");
	}, sduration * 2);
	
	var btm1 = document.getElementById("btm_banner_1");
	var btm2 = document.getElementById("btm_banner_2");
	
	// Delay the bottom banner by 'btm_delay'.
	setTimeout(function() {
		var btmInterval1 = setInterval(function() {
			btm2.classList.add("banner_fade_out");
			btm1.classList.remove("banner_fade_out");
		}, sduration);
		var btmInterval2 = setInterval(function() {
			btm1.classList.add("banner_fade_out");
			btm2.classList.remove("banner_fade_out");
		}, sduration * 2);
	}, btm_delay);
}









			