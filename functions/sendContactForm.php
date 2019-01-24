<?php
	session_start();
	if (!isset($_POST['submit']) ||
	    !isset($_POST['emailaddress']) ||
	    !isset($_POST['firstname']) ||
	    !isset($_POST['lastname']) ||
		!isset($_POST['subject']) ||
		!isset($_POST['contact_message'])
	   ) {
		$_SESSION['msg'] = "Please fill out all fields.";
		exit();
	}
	
//	$to = "runbuddy@mail.com";
//	$from = $_POST['emailaddress'];
//	$fname = $_POST['firstname'];
//	$lname = $_POST['lastname'];
//	$subject = $_POST['subject'];
//	$message = $_POST['contact_message'];
//	
//	$composedMessage = $fname . " " . $lname
//		. " has contacted you via RunBuddy with the following message:\n\n"
//		. $message;
//	$headers = "From:" . $from;
//	$ret = mail($to, $from, $composedMessage, $headers);
//	if ($ret) { $_SESSION['msg'] = "Message sent successfully!"; }
//	else { $_SESSION['msg'] = "Error sending message."; }

	$_SESSION['msg'] = "The mail server feature requires external configuration on your server.";
?>

<!-- Redirect to index.php -->
<!DOCTYPE html>
<html>
	<head>
		<script type="text/javascript">
			function redirect() {
				window.location.href = "../contact.php";
			}
		</script>
	</head>
	<body onload="redirect()">
	</body>
</html>