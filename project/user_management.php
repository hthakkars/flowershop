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
  $query = "SELECT * FROM user where role='U' ORDER BY user_id";
  /* Try to insert the new car into the database */
  if ($result = $mysqli->query($query)) {
    // Don't do anything if successful.
  }
  else
  {
     echo "Error getting users from the database: " . mysql_error()."<br>";
  }

  echo "  <div class=\"div-main\"> <h2>User Management</h2>";

  echo "<table class=\"UMLTable\"><tr>";
  echo "<th>User Id</th>";
  echo "<th>User Name</th>";
  echo "<th>Password</th>";
  echo "<th>First Name</th>";
  echo "<th>Last_Name</th>";
  echo "<th>Address</th>";
  echo "<th>Email</th>";
  echo "<th>Phone Number</th>";
  echo "<th></th>";
  echo "</tr>";

  while ($result_ar = mysqli_fetch_assoc($result)) {
     echo "<tr>";
     echo "<td>" . $result_ar['user_id'] . "</td>";
     echo "<td>" . $result_ar['user_name'] . "</td>";
     echo "<td>" . $result_ar['password'] . "</td>";
     echo "<td>" . $result_ar['first_name'] . "</td>";
     echo "<td>" . $result_ar['last_name'] . "</td>";
     echo "<td>" . $result_ar['address'] . "</td>";
     echo "<td>" . $result_ar['email'] . "</td>";
     echo "<td>" . $result_ar['phone'] . "</td>";
     echo "<td align=\"center\"><a href=\"editUser.php?id=" .$result_ar['user_id']. "\"><img src=\"images/edit.png\"/></a><a href=\"deleteUser.php?id=" .$result_ar['user_id']. "\"><img src=\"images/trash.png\"/></a></td>";
     echo "</tr>";
  }
  echo "</table>";
  echo "</div>";
  $mysqli->close();
?>
