<?php
  if(!isset($_SESSION)){
      session_start();
  }

  $userName =  trim( $_REQUEST['uName']) ;
  $password = trim( $_REQUEST['password']) ;

  include 'db.php';

  $query = "SELECT user_id, role FROM user WHERE user_name='$userName' and password='$password'";

  if ($result = $mysqli->query($query)) {
    while ($result_ar = mysqli_fetch_assoc($result)) {
      $user_id = $result_ar['user_id'];
      $role = $result_ar['role'];
    }

    if(!is_null($user_id) && !is_null($role)){
      session_start();
      $_SESSION['uName'] = $userName;
      $_SESSION['user_id'] = $user_id;
      $_SESSION['role'] = $role;

      if($role=='U') {
        $errmessage="You have successfully entered into Rainbow Island.";
        header("Location: index_user.php?errmessage=$errmessage");
      }
      else if($role=='A') {
        $errmessage="You have successfully entered into Rainbow Island.";
        header("Location: index_admin.php?errmessage=$errmessage");
      }
    } else {
      $errmessage="Your user name and/or password is incorrect; please check and try again.";
      header("Location: loginform.php?errmessage=$errmessage");
    }
  }
  else
  {
      echo "Error has occurred during validation, please try again later.";
  }
  $mysqli->close();
?>
