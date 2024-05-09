<?php 

  session_start();
  include('../config/db.php');
  
  if(isset($_POST['register_btn'])) {
    $fname = mysqli_real_escape_string($con,$_POST['fname']);
    $lname = mysqli_real_escape_string($con,$_POST['lname']);
    $email = mysqli_real_escape_string($con,$_POST['email']);
    $birth = mysqli_real_escape_string($con,$_POST['birth']);
    $sex = mysqli_real_escape_string($con,$_POST['sex']);
    $password = mysqli_real_escape_string($con,$_POST['password']);
    $cpassword = mysqli_real_escape_string($con,$_POST['cpassword']);
    $avatar_name = mysqli_real_escape_string($con,$_FILES['avatar']['name']);
    $avatar_info = $_FILES['avatar'];
    
    $todaysDate = new DateTime();
    $BirthDate = new DateTime($birth);
    $interval = $todaysDate->diff($BirthDate);

    // Inputs Verification
    if(!$fname) {
      $_SESSION['message-warning'] = 'Please enter your first name';
    } elseif (!$lname) {
      $_SESSION['message-warning'] = 'Please enter your last name';
    } elseif (!$email) {
      $_SESSION['message-warning'] = 'Please enter your email';
    } elseif ((strlen($password)) < 8 || (strlen($cpassword)) < 8) {
      $_SESSION['message-warning'] = 'Password Should be 8+ characters';
    } elseif ($interval->y < 18) {
      $_SESSION['message-warning'] = 'You must be over 18+';
    } elseif (!$sex) {
      $_SESSION['message-warning'] = 'Please choose your gender';
    } else {
      // Check passwords
      if($password === $cpassword) {
        // Email verification
        $email_query = "SELECT * FROM users WHERE email = '$email'";
        $email_result = mysqli_query($con,$email_query);

        if(mysqli_num_rows($email_result) === 0) {
          $hash_password = password_hash($password,PASSWORD_DEFAULT);

          // Work on avatar
          if($avatar_name === null || $avatar_name === '') {
            $avatar_to_upload = '';
            
          } else { 
            $allowed_files = ['png','jpg','jpeg'];
            $avatar_extention = pathinfo($avatar_name,PATHINFO_EXTENSION);
  
            if(in_array($avatar_extention,$allowed_files)) {
              if($avatar_info['size'] <= 1000000){
                $time = time();
                $avatar_to_upload = $time . $avatar_name;
                $avatar_destination_path = '../uploads/users/' . $avatar_to_upload;
  
                if((move_uploaded_file($avatar_info["tmp_name"], $avatar_destination_path)) === false) {
                  $_SESSION['message-warning'] = "Sommething went wrong on uploading Avatar";
                }
                
              } else {
                $_SESSION['message-warning'] = "File size too big. Should be less than 1Mb";
              }
              
            } else {
              $_SESSION['message-warning'] = "File Should be 'png','jpg','jpeg'";
            }
          
          }

        } else {
          $_SESSION['message-warning'] = 'Email alread exist';
        }
        
      } else {
        $_SESSION['message-warning'] = 'Password and Confirm Password does not Match';
      }
      
    }

    if($_SESSION['message-warning'] || $_SESSION['message-error']) {
      // Redirect if have an error message
      $_SESSION['signup_data'] = $_POST;
      header('Location: ../register.php');
      exit();
    
    } else {
      // Registre user
      $regiter_query = "INSERT INTO users (fname,lname,birth,sex,email,password,avatar) 
      VALUES('$fname','$lname','$birth','$sex','$email','$hash_password','$avatar_to_upload')";
      $regiter_result = mysqli_query($con,$regiter_query);

      if($regiter_result) {
        $_SESSION['message-success'] = "Registration Succesful. Please log in";
        header('Location: ../login.php');
        exit();
        
      } else {
        $_SESSION['message-warning'] = "Sommething went wrong";
        header('Location: ../register.php');
        exit();

      }

    }
  
  } else {
    // No Permition
    $_SESSION['message-error'] = 'No Permission to access';
    header('Location: ../register.php');
    exit();
  
  }

?>