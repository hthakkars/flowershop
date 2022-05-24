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
<form name="oneform" method="post">

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

  echo "  <div class=\"div-main\"> <h2>Rainbow Island Catalog</h2>";

  echo "<table class=\"UMLTable\"><tr>";
  echo "<th>Catalog Id</th>";
  echo "<th>Item Name</th>";
  echo "<th>Description</th>";
  echo "<th>Price ($)</th>";
  echo "<th>Weight (lb)</th>";
  echo "<th>Shipping ($)</th>";
  echo "<th>Discount ($)</th>";
  echo "<th>Image</th>";
  echo "<th>Quantity</th>";
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
     echo "<td><img src='$target_path' width='50' height='50'></td>";
     echo "<td align=\"center\"><input type=\"text\" name=\"quantity[".$result_ar['catalog_id']."]\" id=\"".$result_ar['catalog_id']."\" value=\"1\" min=\"1\" max=\"10\" size=\"1\"/>&nbsp;<input type=\"checkbox\" name=\"addOrder[]\" value=\"".$result_ar['catalog_id']."\"/></td>";
     echo "</tr>";
  }
  echo "</table>";
  $mysqli->close();
?>
<br/>
Payment: <input name="card" type="text" required value="card number"/>&nbsp;<input name="cvv" type="text" required value="security code"/>&nbsp;<input name="cvv" type="text" required value="expiry date"/>
<br/>
<input name="submit" type="submit" value="Order" style="align:center;"/>
</div>

<?php
if (isset($_POST["submit"])) {
			$user_id = $_SESSION['user_id'] ;
			$total_amount=0;
			$total_shipping = 0;
			$total_discount=0;
			$status='O';
			$array = array();
			if( isset($_POST['addOrder']) && count($_POST['addOrder']) >  0 )
			{
					foreach ($_POST['addOrder'] as $selected) {
						$quantity = $_POST['quantity'][$selected];
						$item_amount = 0;
						$item_discount = 0;
						$item_shipping = 0;

						include 'db.php';

						$query = "SELECT * FROM catalog WHERE catalog_id = $selected ORDER BY catalog_id";
						/* Try to insert the new car into the database */
						if ($result = $mysqli->query($query)) {
							while ($result_ar = mysqli_fetch_assoc($result)) {
								$item_amount = $result_ar['price']  * $quantity;
								$item_discount = $result_ar['discount']  * $quantity;
								$item_shipping = $result_ar['shipping']  * $quantity;
							}
						}

						$total_amount = $total_amount + $item_amount;
						$total_shipping = $total_shipping + $item_shipping;
						$total_discount = $total_discount + $item_discount;

						$array[$selected] = array();
						$array[$selected]['catalog_id'] = $selected;
						$array[$selected]['quantity'] = $quantity;
						$array[$selected]['item_amount'] = $item_amount;
						$array[$selected]['item_discount'] = $item_discount;
						$array[$selected]['item_shipping'] = $item_shipping;
					}

					$query = "INSERT INTO `order`
						(user_id, total_amount, shipping, discount, status)
						 VALUES (
							 $user_id,
							 $total_amount,
							 $total_shipping,
							 $total_discount,
							 '$status'
							)";

					if ($result = $mysqli->query($query)) {
							$order_id = $mysqli->insert_id;

							foreach ($array as $catalog_item) {

								$catalog_id = $catalog_item['catalog_id'];
								$item_quantity = $catalog_item['quantity'];
								$item_amount = $catalog_item['item_amount'];
								$item_discount = $catalog_item['item_discount'];

								$query1 = "INSERT INTO `order_detail`
									(order_id, catalog_id, quantity, amount, discount)
									 VALUES (
										 $order_id,
										 $catalog_id,
										 $item_quantity,
										 $item_amount,
										 $item_discount
										)";


										if ($result = $mysqli->query($query1)) {
										} else {
											echo "Error has occurred while adding this item to order detail, please try again later.";
										}
							}

							echo "<p class=\"p-message\">Your items have been ordered. Order number - ". $order_id ."</P>";
							echo "<br><br><p class=\"p-message\"><a href='index_user.php?p=user_order.php'>Orders</a></p>";
					}
					else
					{
							echo "<br><br><p class=\"p-error\">Error has occurred while adding this item to order, please try again later.</p>";
					}
					$mysqli->close();
			}
			else
			{
			    echo "<br><br><p class=\"p-error\">No catalog item selected; please select atleast one item to order.</p>";
			}
		}
	?>

</form>
