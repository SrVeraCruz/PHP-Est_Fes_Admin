<?php 

  session_start();

  if(isset($_SESSION['auth'])) {
    if($_SESSION['auth_role'] === '0') {
      // No Permission to access Dashboard
      $_SESSION['message'] = 'Please Visite the School Website';
      header('Location: login.php');
      exit();
    
    }
  
  } else {
    // No Permission
    $_SESSION['message'] = 'Please login to access Dashboard';
    header('Location: login.php');
    exit();
  }

?>