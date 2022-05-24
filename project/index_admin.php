<?php
	if(!isset($_SESSION)){
			session_start();
	}
	if(!isset($_SESSION['uName'])) {
		$errmessage="Please login to Rainbow Island to access this page.";
		header("Location: loginform.php?errmessage=$errmessage");
		die();
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Hetal Thakkar | WEB 250 | Rainbow Island</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link href="styles/style.css" rel="stylesheet" type="text/css"/>
	<script src="scripts/validation.js"></script>
</head>
<body>
<?php
	include("header_admin.php");
 ?>
<main>
<?php
	if(isset($_GET["p"])) {
		$sPage = $_GET["p"];
		include($sPage);
	} else {
		echo "<div style=\"height:400px;\"/>";
		echo "<br/><p class=\"p-message\">You have successfully entered into Rainbow Island as an Administrator.</P>";
	}
?>
</main>
<?php
	include("footer.php");
 ?>
</body>
</html>
