<?php
  if(!isset($_SESSION)){
      session_start();
  }
  if(!isset($_SESSION['uName'])) {
		$errmessage="Please login to Rainbow Island to access this page.";
		header("Location: loginform.php?errmessage=$errmessage");
		die();
	}

    $catalogId =  trim( $_REQUEST['id']) ;

    include 'db.php';

    $query = "SELECT * FROM catalog WHERE catalog_id='$catalogId'";

    $mysqli->select_db("project");

    if ($result = $mysqli->query($query)) {
      while ($result_ar = mysqli_fetch_assoc($result)) {
        $catalog_id = $result_ar['catalog_id'];
        $name = $result_ar['name'];
        $description = $result_ar['description'];
        $price = $result_ar['price'];
        $weight = $result_ar['weight'];
        $shipping = $result_ar['shipping'];
        $discount = $result_ar['discount'];
        $image_file = $result_ar['image_file'];
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
    <form name="oneform" method="post"  enctype="multipart/form-data">
    <div class="div-main">
    	<table>
        <tr>
          <td>
          	Catalog Id :
          </td>
          <td>
            <?php echo $catalog_id;?>
          </td>
        </tr>
    		<tr>
          <td>
          	Item Name :
          </td>
          <td>
            <input name="name" type="text" value="<?php echo $name;?>" required maxlength="20"/>
          </td>
        </tr>
        <tr>
          	<td>
              Description :
            </td>
            <td>
              <textarea name="description" required  rows="4" cols="50" maxlength="200"/><?php echo $description;?></textarea>
            </td>
        </tr>
  			<tr>
          	<td>
              Price($) :
            </td>
            <td>
              <input name="price" type="number"  step="any" min="0" max="100" value="<?php echo $price;?>" required/>
            </td>
        </tr>
  			<tr>
          	<td>
              Weight(lb) :
            </td>
            <td>
              <input name="weight" type="number" step="any" min="0" max="100"  value="<?php echo $weight;?>" required/>
            </td>
        </tr>
  			<tr>
          	<td>
              Shipping($) :
            </td>
            <td>
              <input name="shipping" type="number"  step="any" min="0" max="100" value="<?php echo $shipping;?>" required/>
            </td>
        </tr>
  			<tr>
          	<td>
              Discount($) :
            </td>
            <td>
              <input name="discount" type="number"  step="any" min="0" max="100" value="<?php echo $discount;?>" required/>
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
        $catalog_id = $catalogId;
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

  	      $query = "UPDATE catalog
            SET
              name = '$name',
              description = '$description',
              price = '$price',
              weight = '$weight',
              shipping = '$shipping',
              discount = '$discount',
              image_file = '$file_name'
            WHERE catalog_id = $catalog_id";

  	      if (move_uploaded_file($_FILES['image']['tmp_name'], $target_path) && $result = $mysqli->query($query)) {
  	          echo "<p class=\"p-message\">Your item has been updated.</P>";
  						echo "<br><br><p class=\"p-message\"><a href='index_admin.php?p=catalog_management.php'>Catalog Management</a></p>";
  	      }
  	      else
  	      {
  	          echo "<br><br><p class=\"p-error\">Error has occurred while updating this item, please try again later.</p>";
  	      }
  	      $mysqli->close();
  			}
    	}
      ?>
  </form>
  </main>
</body>
</html>
