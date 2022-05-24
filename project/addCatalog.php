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
	<link href="styles/style.css" rel="stylesheet" type="text/css"/>
	<script src="scripts/validation.js"></script>
</head>
<body>
  <?php
  	include("header_admin.php");
   ?>
<main>

<form name="oneform" method="post" enctype="multipart/form-data">
  <div class="div-main">
    <h2>New Catalog Item</h2>

  	<table>
  		<tr>
        <td>
        	Item Name :
        </td>
        <td>
          <input name="name" type="text" value="" required maxlength="20"/>
        </td>
      </tr>
      <tr>
        	<td>
            Description :
          </td>
          <td>
            <textarea name="description" required rows="4" cols="50" maxlength="200"></textarea>
          </td>
      </tr>
			<tr>
        	<td>
            Price($) :
          </td>
          <td>
            <input name="price" type="number" step="any" min="0" max="100" value="" required/>
          </td>
      </tr>
			<tr>
        	<td>
            Weight(lb) :
          </td>
          <td>
            <input name="weight" type="number" step="any" min="0" max="100"  value="" required/>
          </td>
      </tr>
			<tr>
        	<td>
            Shipping($) :
          </td>
          <td>
            <input name="shipping" type="number" step="any" min="0" max="100"  value="" required/>
          </td>
      </tr>
			<tr>
        	<td>
            Discount($) :
          </td>
          <td>
            <input name="discount" type="number" step="any" min="0" max="100"  value="" required/>
          </td>
      </tr>
			<tr>
        	<td>
            Image File :
          </td>
          <td>
            <input name="image" type="file" required />
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

      $name =  trim( $_REQUEST['name']) ;
      $description =  trim( $_REQUEST['description']) ;
      $price =  trim( $_REQUEST['price']) ;
      $weight =  trim( $_REQUEST['weight']) ;
      $shipping =  trim( $_REQUEST['shipping']) ;
      $discount =  trim( $_REQUEST['discount']) ;

      include 'db.php';

			if(isset($_FILES["image"])) {
				$file_name =  $_FILES["image"]["name"];
				$target_path = getcwd() ."/uploads/" .basename( $_FILES['image']['name']);

	      $query = "INSERT INTO catalog
	        (name, description, price, weight, shipping, discount, image_file)
	         VALUES (
	         '$name',
	         '$description',
	         $price,
	         $weight,
	         $shipping,
	         $discount,
	         '$file_name'
	          )";

	      $mysqli->select_db("project");

	      if (move_uploaded_file($_FILES['image']['tmp_name'], $target_path) && $result = $mysqli->query($query)) {
	          echo "<p class=\"p-message\">Your item has been added.</P>";
						echo "<br><br><p class=\"p-message\"><a href='index_admin.php?p=catalog_management.php'>Catalog Management</a></p>";
	      }
	      else
	      {
	          echo "<br><br><p class=\"p-error\">Error has occurred while adding this item, please try again later.</p>";
	      }
	      $mysqli->close();
			}
  	}
	?>
</form>

</main>
</html>
