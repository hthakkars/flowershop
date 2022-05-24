<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Hetal Thakkar | WEB 250 | Rainbow Island</title>
	<link href="styles/style.css" rel="stylesheet" type="text/css"/>
	<script src="scripts/validation.js"></script>
</head>
<body>
<header>
	<div class="logoHeader">
	<img id ="logo" alt = "Logo" src="images/logo.png" class="logo"/>
	<i class="logoline">Rainbow Island</i>
	<i class="tagline">Experience with breeze and blossom</i>
	</div>
</header>

<main>

<form name="oneform" method="post">
  <div class="div-main">
    <h2>New Account Registration</h2>

  	<table>
  		<tr>
        <td>
        	User Name :
        </td>
        <td>
          <input name="uName" type="text" value="" required maxlength="20"/>
        </td>
      </tr>
      <tr>
        	<td>
            Password :
          </td>
          <td>
            <input name="password" type="password" value="" required maxlength="20"/>
          </td>
      </tr>
			<tr>
        	<td>
            First Name :
          </td>
          <td>
            <input name="fName" type="text" value="" required  maxlength="20"/>
          </td>
      </tr>
			<tr>
        	<td>
            Last Name :
          </td>
          <td>
            <input name="lName" type="text" value="" required   maxlength="20"/>
          </td>
      </tr>
			<tr>
        	<td>
            Address :
          </td>
          <td>
            <input name="address" type="text" value="" required   maxlength="100"/>
          </td>
      </tr>
			<tr>
        	<td>
            Email :
          </td>
          <td>
            <input name="email" type="text" value="" required  maxlength="50"/>
          </td>
      </tr>
			<tr>
        	<td>
            Phone Number :
          </td>
          <td>
            <input name="phone" type="text" value="" required  maxlength="12"/>
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

      $user_name =  trim( $_REQUEST['uName']) ;
      $password =  trim( $_REQUEST['password']) ;
      $first_name =  trim( $_REQUEST['fName']) ;
      $last_name =  trim( $_REQUEST['lName']) ;
      $address =  trim( $_REQUEST['address']) ;
      $email =  trim( $_REQUEST['email']) ;
      $phone =  trim( $_REQUEST['phone']) ;

      include 'db.php';

      $query = "INSERT INTO user
        (user_name, password, first_name, last_name, address, email, phone, role)
         VALUES (
         '$user_name',
         '$password',
         '$first_name',
         '$last_name',
         '$address',
         '$email',
         '$phone',
         'U'
          )";

      if ($result = $mysqli->query($query)) {
          echo "<p class=\"p-message\">Your account has been successfully created.</P> <a href=\"loginform.php\" >Login</a>";
      }
      else
      {
          echo "<br><br><p class=\"p-error\">Error has occurred while creating this account, please try again later.</p>";
      }
      $mysqli->close();
  	}
	?>
</form>

</main>
</html>
