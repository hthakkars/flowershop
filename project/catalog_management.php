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
<?php
  include 'db.php';
  $query = "SELECT * FROM catalog ORDER BY catalog_id";
  /* Try to insert the new car into the database */
  if ($result = $mysqli->query($query)) {
    // Don't do anything if successful.
  }
  else
  {
     echo "Error getting catalog from the database: " . mysql_error()."<br>";
  }

  echo "  <div class=\"div-main\"> <h2>Catalog Management</h2><a href='addCatalog.php'>Add New Item</a>";

  echo "<table class=\"UMLTable\"><tr>";
  echo "<th>Catalog Id</th>";
  echo "<th>Item Name</th>";
  echo "<th>Description</th>";
  echo "<th>Price ($)</th>";
  echo "<th>Weight (lb)</th>";
  echo "<th>Shipping ($)</th>";
  echo "<th>Discount ($)</th>";
  echo "<th></th>";
  echo "<th></th>";
  echo "</tr>";

  while ($result_ar = mysqli_fetch_assoc($result)) {
     echo "<tr>";
     echo "<td>" . $result_ar['catalog_id'] . "</td>";
     echo "<td>" . $result_ar['name'] . "</td>";
     echo "<td>" . $result_ar['description'] . "</td>";
     echo "<td>" . $result_ar['price'] . "</td>";
     echo "<td>" . $result_ar['weight'] . "</td>";
     echo "<td>" . $result_ar['shipping'] . "</td>";
     echo "<td>" . $result_ar['discount'] . "</td>";
     $target_path = "./uploads/" .$result_ar['image_file'];
     echo "<td><img src='$target_path' width='100' height='100'></td>";
     echo "<td align=\"center\"><a href=\"editCatalog.php?id=" .$result_ar['catalog_id']. "\"><img src=\"images/edit.png\"/></a><a href=\"deleteCatalog.php?id=" .$result_ar['catalog_id']. "\"><img src=\"images/trash.png\"/></a></td>";
     echo "</tr>";
  }
  echo "</table>";
  echo "</div>";
  $mysqli->close();
?>
