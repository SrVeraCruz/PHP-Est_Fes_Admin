<?php 

  session_start();
  include('../config/db.php');

  if(isset($_POST['login_btn'])) {
    // Login Verification
    $email = mysqli_real_escape_string($con,$_POST['email']);
    $password = mysqli_real_escape_string($con,$_POST['password']);

    if(!$email) {
      $_SESSION['message'] = 'Please enter your email';

    } elseif(strlen($password) < 8) {
      $_SESSION['message'] = 'Password Should be 8+ characters';
    
    } else {
      $user_query = "SELECT * FROM users 
      WHERE email = '$email' Limit 1";
      
      $user_result = mysqli_query($con,$user_query);
  
      if(mysqli_num_rows($user_result) > 0) {
        $user_data = mysqli_fetch_assoc($user_result);
        $hash_password = $user_data['password'];
  
        if(password_verify($password,$hash_password)) {
          // Role Verification
          if($user_data['role_as'] === '1' || $user_data['role_as'] === '2') {
            // Redirect to Dashboard
            $_SESSION['auth'] = true;
            $_SESSION['auth_role'] = $user_data['role_as']; // 0=user, 1=admin, 2=super_admin
            $_SESSION['auth_user'] = [
              'user_id' => $user_data['id'],  
              'user_name' => $user_data['fname'].' '.$user_data['lname'],  
              'user_email' => $user_data['email'],  
              'user_img' => $user_data['avatar'],  
            ];
            
          } else {
            // No Permition to access Dashboard
            $_SESSION['message'] = 'Permission denied. Please visite the school website';
          }
          
        } else {
          // Credentials does not match
          $_SESSION['message'] = 'Invalid Email or Password';
        }
  
      } else {
        // Credentials does not match
        $_SESSION['message'] = 'Invalid Email or Password';
      }
    }


    if(isset($_SESSION['message'])) {
      // Redirect if exist an error message
      $_SESSION['login_email_data'] = $_POST['email'];
      header('Location: ../login.php');
      exit();
    
    } else {
      $_SESSION['message'] = 'Welcomme to Dashboard';
      header('Location: ../index.php');
      exit();
    }
  
  } else {
    // No Permition
    $_SESSION['message'] = 'No Permission to access';
    header('Location: ../index.php');
    exit();

  }

?>