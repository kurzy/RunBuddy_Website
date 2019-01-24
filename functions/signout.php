<?php
	// Erase session cookie, $_SESSION array, and sign out the user.
	session_start();
	if (isset($_COOKIE[session_name()])) {
		unset($_COOKIE[session_name()]);
		setcookie(session_name(), NULL, -1, '/');
	}
	session_unset();
	session_destroy();
	session_start();
	$_SESSION['msg'] = "Signed out successfully";
?>

<!-- Redirect to index.php -->
<!DOCTYPE html>
<html>
	<head>
		<script type="text/javascript">
			function redirect() {
				window.location.href = "../index.php";
			}
		</script>
	</head>
	<body onload="redirect()">
	</body>
</html>