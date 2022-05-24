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
  $query = "SELECT *, o.user_id user_id FROM `order` o inner join `user` u using (user_id) ORDER BY o.received_dt desc";
  /* Try to insert the new car into the database */
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
  echo "<th>Received Dt</th>";
  echo "<th>User Id</th>";
  echo "<th>Name</th>";
  echo "<th>Address</th>";
  echo "<th>Phone</th>";
  echo "<th>Email</th>";
  echo "<th>Order Total</th>";
  echo "<th>Shipping</th>";
  echo "<th>Discount</th>";
  echo "<th>Status</th>";
  echo "<th></th>";
  echo "<th></th>";
  echo "</tr>";

  while ($result_ar = mysqli_fetch_assoc($result)) {
     echo "<tr>";
     echo "<td>" . $result_ar['order_id'] . "</td>";
     echo "<td>" . $result_ar['received_dt'] . "</td>";
     echo "<td>" . $result_ar['user_id'] . "</td>";
     echo "<td>" . $result_ar['first_name'] ." " .$result_ar['last_name'] . "</td>";
     echo "<td>" . $result_ar['address'] . "</td>";
     echo "<td>" . $result_ar['phone'] . "</td>";
     echo "<td>" . $result_ar['email'] . "</td>";
     echo "<td>" . $result_ar['total_amount'] . "</td>";
     echo "<td>" . $result_ar['shipping'] . "</td>";
     echo "<td>" . $result_ar['discount'] . "</td>";
     echo "<td>" . $result_ar['status'] . "</td>";
     echo "<td align=\"center\"><a href=\"viewOrder.php?id=" .$result_ar['order_id']. "\"><img src=\"images/view.png\"/></a></td>";
     echo "<td align=\"center\"><a href=\"editOrder.php?id=" .$result_ar['order_id']. "\"><img src=\"images/edit.png\"/></a></td>";
     echo "</tr>";
  }
  echo "</table>";
  echo "</div>";
  $mysqli->close();
?>
