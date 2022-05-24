<?php
  if(!isset($_SESSION)){
      session_start();
  }
  if(!isset($_SESSION['uName'])) {
		$errmessage="Please login to Rainbow Island to access this page.";
		header("Location: loginform.php?errmessage=$errmessage");
		die();
	}

  $orderId =  trim( $_REQUEST['id']) ;

  include 'db.php';

  $query = "SELECT *, o.user_id user_id FROM `order` o inner join `user` u using (user_id) WHERE o.order_id = $orderId ORDER BY o.received_dt desc";

  $mysqli->select_db("project");

  if ($result = $mysqli->query($query)) {
    while ($result_ar = mysqli_fetch_assoc($result)) {
      $order_id = $result_ar['order_id'];
      $received_dt = $result_ar['received_dt'];
      $user_id = $result_ar['user_id'];
      $user_name = $result_ar['first_name'] . " " . $result_ar['last_name'];
      $address = $result_ar['address'];
      $phone = $result_ar['phone'];
      $email = $result_ar['email'];
      $total_amount = $result_ar['total_amount'];
      $shipping = $result_ar['shipping'];
      $discount = $result_ar['discount'];
      $status = $result_ar['status'];
    }
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
    <form name="oneform" method="post">
    <div class="div-main">
    	<table>
        <tr>
          <td>
          	Order Id :
          </td>
          <td>
            <?php echo $order_id;?>
          </td>
        </tr>
    		<tr>
          <td>
          	Received Dt :
          </td>
          <td>
            <?php echo $received_dt;?>
          </td>
        </tr>
        <tr>
          	<td>
              Status :
            </td>
            <td>
              <select name="status" id="status">
                <option value="O" <?php echo $status == 'O'? "selected" : "";?>>Ordered</option>
                <option value="P" <?php echo $status == 'P'? "selected" : "";?>>In Progress</option>
                <option value="S" <?php echo $status == 'S'? "selected" : "";?>>In Shipping</option>
                <option value="H" <?php echo $status == 'H'? "selected" : "";?>>Shipped</option>
                <option value="D" <?php echo $status == 'D'? "selected" : "";?>>Delivered</option>
              </select>
            </td>
        </tr>
        <tr>
          	<td>
              User Id :
            </td>
            <td>
              <?php echo $user_id;?>
            </td>
        </tr>
  			<tr>
          	<td>
              Name :
            </td>
            <td>
              <?php echo $user_name;?>
            </td>
        </tr>
  			<tr>
          	<td>
              Address :
            </td>
            <td>
              <?php echo $address;?>
            </td>
        </tr>
  			<tr>
          	<td>
              Phone :
            </td>
            <td>
              <?php echo $phone;?>
            </td>
        </tr>
  			<tr>
          	<td>
              Email :
            </td>
            <td>
              <?php echo $email;?>
            </td>
        </tr>
  			<tr>
          	<td>
              Total Amount :
            </td>
            <td>
              <?php echo $total_amount;?>
            </td>
        </tr>
        <tr>
          	<td>
              Shipping :
            </td>
            <td>
              <?php echo $shipping;?>
            </td>
        </tr>
        <tr>
          	<td>
              Discount :
            </td>
            <td>
              <?php echo $discount;?>
            </td>
        </tr>
        <tr>
          	<td>
              Detail :
            </td>
            <td>
              <?php echo "<a href=\"viewOrder.php?id=" .$order_id. "\"><img src=\"images/view.png\"/></a>";?>
            </td>
        </tr>
        <tr>
          <td colspan="2">
            <input name="submit" type="submit" value="SUBMIT" style="align:center;"/>
          </td>
        </tr>
    	</table>
    </div>
    <?php
    if (isset($_POST["submit"])) {
        $order_id =  $orderId ;
        $status =  trim( $_REQUEST['status']) ;

          include 'db.php';

          $query = "UPDATE `order`
            SET
              status = '$status'
            WHERE order_id = $order_id";

          if ($result = $mysqli->query($query)) {
              echo "<p class=\"p-message\">Your record has been successfully updated.</P>";
              echo "<br><br><p class=\"p-message\"><a href='index_admin.php?p=order_management.php'>Order Management</a></p>";
          }
          else
          {
              echo "<br><br><p class=\"p-error\">Error has occurred while updating this record, please try again later.</p>";
          }
          $mysqli->close();
      	}
      ?>
  </form>
  </main>
</body>
</html>
