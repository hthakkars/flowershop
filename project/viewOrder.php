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
  $orderId =  trim( $_REQUEST['id']) ;

  include 'db.php';
  $query = "SELECT *, od.catalog_id catalog_id, od.discount discount FROM `order_detail` od inner join `catalog` c using (catalog_id) WHERE od.order_id = $orderId ORDER BY od.catalog_id desc";

	if ($result = $mysqli->query($query)) {
    // Don't do anything if successful.
  }
  else
  {
     echo "Error getting order from the database: " . mysql_error()."<br>";
  }

  echo "  <div class=\"div-main\"> <h2>Order Management</h2>";

  echo "<table class=\"UMLTable\"><tr>";
  echo "<th>Order Id</th>";
  echo "<th>Catalog Id</th>";
  echo "<th>Item Name</th>";
  echo "<th>Quantity</th>";
  echo "<th>Amount</th>";
  echo "<th>Discount</th>";
  echo "<th></th>";
  echo "</tr>";

  while ($result_ar = mysqli_fetch_assoc($result)) {
     echo "<tr>";
     echo "<td>" . $result_ar['order_id'] . "</td>";
     echo "<td>" . $result_ar['catalog_id'] . "</td>";
     echo "<td>" . $result_ar['name'] . "</td>";
     echo "<td>" . $result_ar['quantity'] . "</td>";
     echo "<td>" . $result_ar['amount'] . "</td>";
     echo "<td>" . $result_ar['discount'] . "</td>";
     $target_path = "./uploads/" .$result_ar['image_file'];
     echo "<td><img src='$target_path' width='100' height='100'></td>";
     echo "</tr>";
  }
  echo "</table>";
  echo "</div>";

  echo "<br><br><p class=\"p-message\"><a href='index_admin.php?p=order_management.php'>Order Management</a><p>";
  $mysqli->close();
?>
</main>
</body>
</html>
