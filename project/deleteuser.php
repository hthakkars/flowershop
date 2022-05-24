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
    $userId =  trim( $_REQUEST['id']) ;

    include 'db.php';

    $query = "DELETE FROM user
      WHERE user_id = $userId";

    if ($result = $mysqli->query($query)) {
        echo "<p class=\"p-message\">Your record has been successfully deleted.</P>";
        echo "<br><br><p class=\"p-message\"><a href='index_admin.php?p=user_management.php'>User Management</a></p>";
    }
    else
    {
        echo "<br><br><p class=\"p-error\">Error has occurred while deleting this record, please try again later.</p>";
    }
    $mysqli->close();

      ?>
  </main>
</body>
</html>
