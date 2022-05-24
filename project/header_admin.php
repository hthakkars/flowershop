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
<header>
	<div class="logoHeader">
		<img id ="logo" alt = "Logo" src="images/logo.png" class="logo"/>
		<i class="logoline">Rainbow Island</i>
		<i class="tagline">Experience with breeze and blossom</i>
		<div class="input-right">
			<a href="loginform.php" >
				<span class="glyphicon glyphicon-log-out"></span> Log out
			</a>
		</div>
	</div>
	<ul class="ul-menu">
		<li class="li-menu"><a class="li-a-menu" href="index_admin.php?p=catalog_management.php">Catalog Management</a></li>
		<li class="li-menu"> || </li>
		<li class="li-menu"><a class="li-a-menu" href="index_admin.php?p=order_management.php">Order Management</a></li>
<!--		<li class="li-menu"> || </li>
		<li class="li-menu"><a class="li-a-menu" href="index_admin.php?p=user_management.php">User Management</a></li>-->
	</ul>
</header>
