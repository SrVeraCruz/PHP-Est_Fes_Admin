<?php 

  session_start();
  
  if(isset($_POST['logout_btn'])) {
    // Delete Session
    unset($_SESSION['auth']);
    unset($_SESSION['auth_role']);
    unset($_SESSION['auth_user']);

    $_SESSION['message'] = 'Logged Out Succesfully';
    header('Location: ../login.php');
    exit();

  } else {
    // No Permition
    $_SESSION['message'] = 'No Permission to access';
    header('Location: ../index.php');
    exit();
  }

?>