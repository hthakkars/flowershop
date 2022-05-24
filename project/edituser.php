<?php
  if(!isset($_SESSION)){
      session_start();
  }
  if(!isset($_SESSION['uName'])) {
		$errmessage="Please login to Rainbow Island to access this page.";
		header("Location: loginform.php?errmessage=$errmessage");
		die();
	}

    $userId =  trim( $_REQUEST['id']) ;

    include 'db.php';

    $query = "SELECT * FROM user WHERE user_id='$userId'";

    $mysqli->select_db("project");

    if ($result = $mysqli->query($query)) {
      while ($result_ar = mysqli_fetch_assoc($result)) {
        $userId = $result_ar['user_id'];
        $userName = $result_ar['user_name'];
        $password = $result_ar['password'];
        $firstName = $result_ar['first_name'];
        $lastName = $result_ar['last_name'];
        $address = $result_ar['address'];
        $email = $result_ar['email'];
        $phone = $result_ar['phone'];
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
          	User Id :
          </td>
          <td>
            <?php echo $userId;?>
          </td>
        </tr>
    		<tr>
          <td>
          	User Name :
          </td>
          <td>
            <input name="uName" type="text" value="<?php echo $userName;?>" required  maxlength="20"/>
          </td>
        </tr>
        <tr>
          	<td>
              Password :
            </td>
            <td>
              <input name="password" type="password" value="<?php echo $password;?>" required  maxlength="20"/>
            </td>
        </tr>
  			<tr>
          	<td>
              First Name :
            </td>
            <td>
              <input name="fName" type="text" value="<?php echo $firstName;?>" required  maxlength="20"/>
            </td>
        </tr>
  			<tr>
          	<td>
              Last Name :
            </td>
            <td>
              <input name="lName" type="text" value="<?php echo $lastName;?>" required   maxlength="20"/>
            </td>
        </tr>
  			<tr>
          	<td>
              Address :
            </td>
            <td>
              <input name="address" type="text" value="<?php echo $address;?>" required   maxlength="100"/>
            </td>
        </tr>
  			<tr>
          	<td>
              Email :
            </td>
            <td>
              <input name="email" type="text" value="<?php echo $email;?>" required  maxlength="50"/>
            </td>
        </tr>
  			<tr>
          	<td>
              Phone Number :
            </td>
            <td>
              <input name="phone" type="text" value="<?php echo $phone;?>" required  maxlength="12"/>
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
        $user_id =  $userId ;
          $user_name =  trim( $_REQUEST['uName']) ;
          $password =  trim( $_REQUEST['password']) ;
          $first_name =  trim( $_REQUEST['fName']) ;
          $last_name =  trim( $_REQUEST['lName']) ;
          $address =  trim( $_REQUEST['address']) ;
          $email =  trim( $_REQUEST['email']) ;
          $phone =  trim( $_REQUEST['phone']) ;

          $userName = $user_name;
          $firstName = $first_name;
          $lastName = $last_name;

          include 'db.php';

          $query = "UPDATE user
            SET
              user_name = '$user_name',
              password = '$password',
              first_name = '$first_name',
              last_name = '$last_name',
              address = '$address',
              email = '$email',
              phone = '$phone'
            WHERE user_id = $user_id";

          if ($result = $mysqli->query($query)) {
              echo "<p class=\"p-message\">Your record has been successfully updated.</P>";
              echo "<br><br><p class=\"p-message\"><a href='index_admin.php?p=user_management.php'>User Management</a></p>";
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
