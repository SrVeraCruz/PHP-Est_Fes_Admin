<?php

session_start();
require '../middleware/isSuperAdminRequest.php';
require '../config/db.php';

if (isset($_POST['add_category_btn'])) {
  // Add category
  $category_name = mysqli_real_escape_string($con, $_POST['name']);
  $parent_category_id = mysqli_real_escape_string($con, $_POST['parent_category_id']);
  $category_title = mysqli_real_escape_string($con, $_POST['title']);
  $category_slug = mysqli_real_escape_string($con, $_POST['slug']);
  $file_info = $_FILES['category_logo'];
  $file_name = mysqli_real_escape_string($con, $_FILES['category_logo']['name']);
  $navbar_status = mysqli_real_escape_string($con, $_POST['navbar_status'] ?? null) == 'on' ? '1' : '0';

  if (!$category_name) {
    $_SESSION['message-warning'] = 'Please enter the category name';
  } elseif (!$category_title) {
    $_SESSION['message-warning'] = 'Please enter the category title';
  } else {

    // Work on Logo
    if ($file_name == null || $file_name == '') {
      $file_to_upload = '';
    } else {
      $allowed_files = ['png', 'jpg', 'jpeg', 'webp', 'avif', 'svg'];
      $file_extention = pathinfo($file_name, PATHINFO_EXTENSION);

      if (in_array($file_extention, $allowed_files)) {
        if ($file_info['size'] <= 1000000) {
          $time = time();
          $file_to_upload = $time . $file_name;
          $file_destination_path = '../uploads/categories/' . $file_to_upload;

          if ((move_uploaded_file($file_info["tmp_name"], $file_destination_path)) == false) {
            $_SESSION['message-warning'] = "Sommething went wrong on uploading File";
          }
        } else {
          $_SESSION['message-warning'] = "File size too big. Should be less than 10Mb";
        }
      } else {
        $_SESSION['message-warning'] = "File Should be 'png','jpg','jpeg','webp','avif','svg'";
      }
    }
  }

  if (isset($_SESSION['message-warning'])) {
    // Redirect if have an error message
    $_SESSION['add-category-data'] = $_POST;
    header('Location: ../category-view.php');
    exit();
  } else {
    $add_cat_query = "INSERT INTO categories (parent_category_id,name,title,slug,logo,navbar_status) 
      VALUES ('$parent_category_id','$category_name','$category_title','$category_slug','$file_to_upload','$navbar_status') LIMIT 1";
    $add_cat_result = mysqli_query($con, $add_cat_query);

    if ($add_cat_result) {
      $_SESSION['message-success'] = 'Category added successfully';
      header('Location: ../category-view.php');
      exit();
    } else {
      $_SESSION['message-warning'] = 'Sommething went wrong';
      header('Location: ../category-view.php');
      exit();
    }
  }
} elseif (isset($_POST['get_cat_data_btn'])) {
  // Get Category data to edit
  $category_id = mysqli_real_escape_string($con, $_POST['get_cat_data_btn']);

  $cat_query = "SELECT id,name,title,slug,logo,parent_category_id,navbar_status 
  FROM categories 
  WHERE id = $category_id LIMIT 1";
  $cat_result = mysqli_query($con, $cat_query);

  if (mysqli_num_rows($cat_result) > 0) {
    $cat_data = mysqli_fetch_assoc($cat_result);

    $_SESSION['edit-category-data'] = $cat_data;
    header('Location: ../category-view.php');
    exit();
  } else {
    $_SESSION['message-warning'] = 'Sommething went wrong';
    header('Location: ../category-view.php');
    exit();
  }
} elseif (isset($_POST['edit_category_btn'])) {
  // Edit category
  $category_id = mysqli_real_escape_string($con, $_POST['id']);
  $category_name = mysqli_real_escape_string($con, $_POST['name']);
  $category_title = mysqli_real_escape_string($con, $_POST['title']);
  $category_slug = mysqli_real_escape_string($con, $_POST['slug']);
  $parent_category_id = mysqli_real_escape_string($con, $_POST['parent_category_id']);
  $file_old_name = mysqli_real_escape_string($con, $_POST['old_cat_logo_name']);
  $file_name = mysqli_real_escape_string($con, $_FILES['category_logo']['name']);
  $file_info = $_FILES['category_logo'];
  $navbar_status = mysqli_real_escape_string($con, $_POST['navbar_status'] ?? null) == 'on' ? '1' : '0';

  if (!$category_name) {
    $_SESSION['message-warning'] = 'Please enter the category name';
  } elseif (!$category_title) {
    $_SESSION['message-warning'] = 'Please enter the category title';
  } else {

    // Check file status
    if ($file_name == null || $file_name == '') {
      $file_to_upload = $file_old_name;
    } else {
      $allowed_files = ['png', 'jpg', 'jpeg', 'webp', 'avif', 'svg'];
      $file_extention = pathinfo($file_name, PATHINFO_EXTENSION);

      if (in_array($file_extention, $allowed_files)) {
        if ($file_info['size'] <= 1000000) {
          $time = time();
          $file_to_upload = $time . $file_name;
          $file_destination_path = '../uploads/categories/' . $file_to_upload;
        } else {
          $_SESSION['message-warning'] = "File size too big. Should be less than 1Mb";
        }
      } else {
        $_SESSION['message-warning'] = "File Should be 'png','jpg','jpeg','webp','avif','svg'";
      }
    }
  }

  if (isset($_SESSION['message-warning'])) {
    // Redirect if have an error message
    $_SESSION['edit-category-data'] = $_POST;
    header('Location: ../category-view.php');
    exit();
  } else {
    $update_cat_query = "UPDATE categories 
      SET parent_category_id = '$parent_category_id', name = '$category_name',title = '$category_title', slug = '$category_slug', logo = '$file_to_upload', navbar_status = '$navbar_status' WHERE id = '$category_id' LIMIT 1";

    $update_cat_result = mysqli_query($con, $update_cat_query);

    if ($update_cat_result) {
      if ($file_name != null || $file_name != '') {
        $file_old_destination_path = '../uploads/categories/' . $file_old_name;

        if (file_exists($file_old_destination_path)) {
          unlink($file_old_destination_path);
        }

        if ((move_uploaded_file($file_info["tmp_name"], $file_destination_path)) == false) {
          $_SESSION['message-warning'] = "Sommething went wrong on uploading File";
          $_SESSION['edit-category-data'] = $_POST;
          header('Location: ../category-view');
          exit();
        }
      }

      $_SESSION['message-success'] = 'Category updated successfully';
      header('Location: ../category-view.php');
      exit();
    } else {
      $_SESSION['message-warning'] = 'Sommething went wrong';
      header('Location: ../category-view.php');
      exit();
    }
  }
} elseif (isset($_POST['confirm_del_cat_btn'])) {
  // Get Category data to delete
  $category_id = mysqli_real_escape_string($con, $_POST['confirm_del_cat_btn']);

  $cat_query = "SELECT id,name,logo FROM categories WHERE id = $category_id LIMIT 1";
  $cat_result = mysqli_query($con, $cat_query);

  if (mysqli_num_rows($cat_result) > 0) {
    $cat_data = mysqli_fetch_assoc($cat_result);

    $_SESSION['del-category-data'] = $cat_data;
    header('Location: ../category-view.php');
    exit();
  } else {
    $_SESSION['message-warning'] = 'Sommething went wrong';
    header('Location: ../category-view.php');
    exit();
  }
} elseif (isset($_POST['delete_cat_btn'])) {
  // Delete category
  $category_id = mysqli_real_escape_string($con, $_POST['delete_cat_btn']);
  $del_category_logo_name = mysqli_real_escape_string($con, $_POST['del_category_logo_name']);

  $delete_cat_query = "UPDATE categories 
    SET status = '2' 
    WHERE id = '$category_id' LIMIT 1";

  $delete_cat_result = mysqli_query($con, $delete_cat_query);

  if ($delete_cat_result) {
    $file_old_destination_path = '../uploads/categories/' . $del_category_logo_name;
    if (file_exists($file_old_destination_path)) {
      unlink($file_old_destination_path);
    }

    $_SESSION['message-success'] = 'Category deleted successfully';
    header('Location: ../category-view.php');
    exit();
  } else {
    $_SESSION['message-warning'] = 'Sommething went wrong';
    header('Location: ../category-view.php');
    exit();
  }
} else {
  $_SESSION['message-error'] = 'No permission to access';
  header('Location: ../category-view.php');
  exit();
}
