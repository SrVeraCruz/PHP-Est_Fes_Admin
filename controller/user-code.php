<?php

session_start();
require '../middleware/isSuperAdminRequest.php';
require '../config/db.php';

if (isset($_POST['add_user_btn'])) {
  // Add User
  $fname = mysqli_real_escape_string($con, $_POST['fname']);
  $lname = mysqli_real_escape_string($con, $_POST['lname']);
  $email = mysqli_real_escape_string($con, $_POST['email']);
  $birth = mysqli_real_escape_string($con, $_POST['birth']);
  $sex = mysqli_real_escape_string($con, $_POST['sex']);
  $password = mysqli_real_escape_string($con, $_POST['password']);
  $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
  $status = mysqli_real_escape_string($con, $_POST['status'] ?? null) == 'on' ? '1' : '0';
  $role = mysqli_real_escape_string($con, $_POST['role_as']);
  $avatar_name = mysqli_real_escape_string($con, $_FILES['avatar']['name']);
  $avatar_info = $_FILES['avatar'];

  $todaysDate = new DateTime();
  $BirthDate = new DateTime($birth);
  $interval = $todaysDate->diff($BirthDate);

  // Inputs Verification
  if (!$fname) {
    $_SESSION['message-warning'] = 'Please enter the user first name';
  } elseif (!$lname) {
    $_SESSION['message-warning'] = 'Please enter the user last name';
  } elseif (!$email) {
    $_SESSION['message-warning'] = 'Please enter the user email';
  } elseif ((strlen($password)) < 8 || (strlen($cpassword)) < 8) {
    $_SESSION['message-warning'] = 'Password Should be 8+ characters';
  } elseif ($interval->y < 18) {
    $_SESSION['message-warning'] = 'The user must be over 18+';
  } elseif (!$sex) {
    $_SESSION['message-warning'] = 'Please choose the user gender';
  } elseif ($role == '') {
    $_SESSION['message-warning'] = 'Please choose the user role';
  } else {
    // Check passwords
    if ($password == $cpassword) {
      // Email verification
      $email_query = "SELECT * FROM users WHERE email = '$email'";
      $email_result = mysqli_query($con, $email_query);

      if (mysqli_num_rows($email_result) == 0) {
        $hash_password = password_hash($password, PASSWORD_DEFAULT);

        // Work on avatar
        if ($avatar_name == null || $avatar_name == '') {
          $avatar_to_upload = '';
        } else {
          $allowed_files = ['png', 'jpg', 'jpeg', 'webp'];
          $avatar_extention = pathinfo($avatar_name, PATHINFO_EXTENSION);

          if (in_array($avatar_extention, $allowed_files)) {
            if ($avatar_info['size'] <= 1000000) {
              $time = time();
              $avatar_to_upload = $time . $avatar_name;
              $avatar_destination_path = '../uploads/users/' . $avatar_to_upload;

              if ((move_uploaded_file($avatar_info["tmp_name"], $avatar_destination_path)) == false) {
                $_SESSION['message-warning'] = "Sommething went wrong on uploading Avatar";
              }
            } else {
              $_SESSION['message-warning'] = "File size too big. Should be less than 1Mb";
            }
          } else {
            $_SESSION['message-warning'] = "File Should be 'png','jpg','jpeg','webp'";
          }
        }
      } else {
        $_SESSION['message-warning'] = 'Email alread exist';
      }
    } else {
      $_SESSION['message-warning'] = 'Password and Confirm Password does no Match';
    }
  }

  if ($_SESSION['message-warning']) {
    // Redirect if have an error message
    $_SESSION['add_user_data'] = $_POST;
    header('Location: ../user-add.php');
    exit();
  } else {
    // Continue to Add user
    $add_user_query = "INSERT INTO users (fname,lname,birth,sex,email,password,role_as,status,avatar) 
      VALUES('$fname','$lname','$birth','$sex','$email','$hash_password','$role','$status','$avatar_to_upload')";
    $add_user_result = mysqli_query($con, $add_user_query);

    if ($add_user_result) {
      if ($role == '1') {
        $_SESSION['message-success'] = "Admin added successfully";
      } else {
        $_SESSION['message-success'] = "User added successfully";
      }
      header('Location: ../user-view.php');
      exit();
    } else {
      $_SESSION['message-warning'] = "Sommething went wrong";
      header('Location: ../user-add.php');
      exit();
    }
  }
}
if (isset($_POST['edit_user_btn'])) {
  // Update User
  $user_id = mysqli_real_escape_string($con, $_POST['user_id']);
  $fname = mysqli_real_escape_string($con, $_POST['fname']);
  $lname = mysqli_real_escape_string($con, $_POST['lname']);
  $email = mysqli_real_escape_string($con, $_POST['email']);
  $birth = mysqli_real_escape_string($con, $_POST['birth']);
  $sex = mysqli_real_escape_string($con, $_POST['sex']);
  $password = mysqli_real_escape_string($con, $_POST['password']);
  $status = mysqli_real_escape_string($con, $_POST['status'] ?? null) == 'on' ? '1' : '0';
  $role = mysqli_real_escape_string($con, $_POST['role_as']);
  $avatar_old_name = mysqli_real_escape_string($con, $_POST['avatar_old_name']);
  $avatar_name = mysqli_real_escape_string($con, $_FILES['avatar']['name']);
  $avatar_info = $_FILES['avatar'];

  $todaysDate = new DateTime();
  $BirthDate = new DateTime($birth);
  $interval = $todaysDate->diff($BirthDate);

  // Inputs Verification
  if (!$fname) {
    $_SESSION['message-warning'] = 'Please enter the user first name';
  } elseif (!$lname) {
    $_SESSION['message-warning'] = 'Please enter the user last name';
  } elseif (!$email) {
    $_SESSION['message-warning'] = 'Please enter the user email';
  } elseif ((strlen($password)) < 8) {
    $_SESSION['message-warning'] = 'Password Should be 8+ characters';
  } elseif ($interval->y < 18) {
    $_SESSION['message-warning'] = 'The user must be over 18+';
  } elseif (!$sex) {
    $_SESSION['message-warning'] = 'Please choose the user gender';
  } elseif ($role == '') {
    $_SESSION['message-warning'] = 'Please choose the user role';
  } else {
    // Check the password status
    $user_query = "SELECT password,avatar FROM users WHERE id = '$user_id' LIMIT 1";
    $user_result = mysqli_query($con, $user_query);
    $user_data = mysqli_fetch_assoc($user_result);

    if ($password == $user_data['password']) {
      $hash_password = $password;
    } else {
      // New Password
      $hash_password = password_hash($password, PASSWORD_DEFAULT);
    }

    // Email verification
    $email_query = "SELECT id FROM users WHERE email = '$email' LIMIT 1";
    $email_result = mysqli_query($con, $email_query);

    if (mysqli_num_rows($email_result)) {
      $email_data = mysqli_fetch_assoc($email_result);

      if ($email_data['id'] !== $user_id) {
        $_SESSION['message-warning'] = 'Email alread exist';
      }
    }

    // Check avatar status
    if ($avatar_name == null || $avatar_name == '') {
      $avatar_to_upload = $avatar_old_name;
    } else {
      $allowed_files = ['png', 'jpg', 'jpeg', 'webp'];
      $avatar_extention = pathinfo($avatar_name, PATHINFO_EXTENSION);

      if (in_array($avatar_extention, $allowed_files)) {
        if ($avatar_info['size'] <= 1000000) {
          $time = time();
          $avatar_to_upload = $time . $avatar_name;
          $avatar_destination_path = '../uploads/users/' . $avatar_to_upload;
        } else {
          $_SESSION['message-warning'] = "File size too big. Should be less than 1Mb";
        }
      } else {
        $_SESSION['message-warning'] = "File Should be 'png','jpg','jpeg','webp'";
      }
    }
  }

  if ($_SESSION['message-warning']) {
    // Redirect if have an error message
    $_SESSION['edit_user_data'] = $_POST;
    header('Location: ../user-edit.php?id=' . $user_id);
    exit();
  } else {
    // Continue to Update user
    $update_user_query = "UPDATE users SET fname = '$fname', lname = '$lname', birth = '$birth', sex = '$sex', email = '$email', password = '$hash_password', role_as = '$role', status = '$status', avatar = '$avatar_to_upload' WHERE id = '$user_id'";
    $update_user_result = mysqli_query($con, $update_user_query);

    if ($update_user_result) {
      if ($avatar_name != null || $avatar_name != '') {
        $avatar_old_destination_path = '../uploads/users/' . $avatar_old_name;

        if (file_exists('../uploads/users/' . $avatar_old_name)) {
          unlink($avatar_old_destination_path);
        }

        if ((move_uploaded_file($avatar_info["tmp_name"], $avatar_destination_path)) == false) {
          $_SESSION['message-warning'] = "Sommething went wrong on uploading Avatar";
          $_SESSION['edit_user_data'] = $_POST;
          header('Location: ../user-edit.php?id=' . $user_id);
          exit();
        }
      }

      if ($role == '1') {
        $_SESSION['message-success'] = "Admin Updated successfully";
      } else {
        $_SESSION['message-success'] = "User Updated successfully";
      }
      header('Location: ../user-view.php');
      exit();
    } else {
      $_SESSION['message-warning'] = "Sommething went wrong";
      header('Location: ../user-edit.php?id=' . $user_id);
      exit();
    }
  }
} elseif (isset($_POST['confirm_del_user_btn'])) {
  // Get user data to confirm delete
  $user_id = mysqli_real_escape_string($con, $_POST['confirm_del_user_btn']);

  $user_query = "SELECT id,fname,lname,avatar,role_as FROM users WHERE id = $user_id LIMIT 1";
  $user_result = mysqli_query($con, $user_query);

  if (mysqli_num_rows($user_result) > 0) {
    $user_data = mysqli_fetch_assoc($user_result);

    $_SESSION['del-user-data'] = $user_data;
    header('Location: ../user-view.php');
    exit();
  } else {
    $_SESSION['message-error'] = 'Sommething went wrong';
    header('Location: ../user-view.php');
    exit();
  }
} elseif (isset($_POST['delete_user_btn'])) {
  // Delete user
  $user_id = mysqli_real_escape_string($con, $_POST['delete_user_btn']);
  $user_avatar_name = mysqli_real_escape_string($con, $_POST['delete_user_avatar_name']);
  $user_role = mysqli_real_escape_string($con, $_POST['delete_user_role']);

  $delete_user_query = "DELETE FROM users 
    WHERE id = '$user_id' LIMIT 1";

  $delete_user_result = mysqli_query($con, $delete_user_query);

  if ($delete_user_result) {
    $avatar_old_destination_path = '../uploads/users/' . $user_avatar_name;
    if (file_exists($avatar_old_destination_path)) {
      unlink($avatar_old_destination_path);
    }

    if ($user_role == '1') {
      $_SESSION['message-success'] = 'Admin deleted successfully';
    } else {
      $_SESSION['message-success'] = 'User deleted successfully';
    }
    header('Location: ../user-view.php');
    exit();
  } else {
    $_SESSION['message-warning'] = 'Sommething went wrong';
    header('Location: ../user-view.php');
    exit();
  }
} else {
  $_SESSION['message-error'] = 'No permission to access';
  header('Location: ../user-view.php');
  exit();
}
