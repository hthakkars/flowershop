<?php
	session_start();
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
<header>
	<div class="logoHeader">
		<img id ="logo" alt = "Logo" src="images/logo.png" class="logo"/>
		<i class="logoline">Rainbow Island</i>
		<i class="tagline">Experience with breeze and blossom</i>
	</div>
</header>

<main style="height:500px;">
  <form name="oneform" method="post" action="loginresult.php">
    <div class="div-login">
      <h2>Login</h2>

    	<table>
    		<tr>
          <td>
          	User Name :
          </td>
          <td>
            <input name="uName" type="text" />
          </td>
        </tr>
        <tr>
          	<td>
              Password :
            </td>
            <td>
              <input name="password" type="password" />
            </td>
        </tr>
        <tr>
          <td colspan="2">
            <input name="submit1" type="submit" value="Login" style="align:center;"/>
          </td>
        </tr>
				<!--<tr>
          <td colspan="2" style="align:right;">
						<a href="create_account.php" >
							<span class="glyphicon glyphicon-log-out"></span> Create New Account
						</a>
          </td>
        </tr>-->
    	</table>
			<br/>
			<?php
				if (isset($_SESSION['uName'])){
						session_destroy();
				}

	      if(isset($_REQUEST['errmessage'])){
	        $errmessage =  trim( $_REQUEST['errmessage']) ;
	        echo "<p>$errmessage</P>";
	      }
	    ?>
    </div>
  </form>
</main>
<?php
	include("footer.php");
 ?>
</html>
