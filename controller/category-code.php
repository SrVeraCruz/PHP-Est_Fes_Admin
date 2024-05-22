<?php

session_start();
include('../config/db.php');

if (isset($_POST['add_category_btn'])) {
  // Add category
  $category_name = mysqli_real_escape_string($con, $_POST['category_name']);
  $parent_category_id = mysqli_real_escape_string($con, $_POST['parent_category_id']);
  $navbar_status = mysqli_real_escape_string($con, $_POST['navbar_status'] ?? null) == 'on' ? '1' : '0';

  if (!$category_name) {
    $_SESSION['message-warning'] = 'Please enter the category name';
    header('Location: ../category-view.php');
    exit();
  }

  $add_cat_query = "INSERT INTO categories (parent_category_id,name,navbar_status) 
    VALUES ('$parent_category_id','$category_name','$navbar_status') LIMIT 1";
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
} elseif (isset($_POST['get_cat_data_btn'])) {
  // Get Category data to edit
  $category_id = mysqli_real_escape_string($con, $_POST['get_cat_data_btn']);

  $cat_query = "SELECT id,name,parent_category_id,navbar_status 
  FROM categories 
  WHERE id = $category_id LIMIT 1";
  $cat_result = mysqli_query($con, $cat_query);

  if (mysqli_num_rows($cat_result) > 0) {
    $cat_data = mysqli_fetch_assoc($cat_result);

    $_SESSION['category-data'] = $cat_data;
    header('Location: ../category-view.php');
    exit();
  } else {
    $_SESSION['message-warning'] = 'Sommething went wrong';
    header('Location: ../category-view.php');
    exit();
  }
} elseif (isset($_POST['edit_category_btn'])) {
  // Edit category
  $category_id = mysqli_real_escape_string($con, $_POST['category_id']);
  $category_name = mysqli_real_escape_string($con, $_POST['category_name']);
  $parent_category_id = mysqli_real_escape_string($con, $_POST['parent_category_id']);
  $navbar_status = mysqli_real_escape_string($con, $_POST['navbar_status'] ?? null) == 'on' ? '1' : '0';

  if (!$category_name) {
    $_SESSION['message-warning'] = 'Please enter the category name';
    header('Location: ../category-view.php');
    exit();
  }

  $update_cat_query = "UPDATE categories 
    SET parent_category_id = '$parent_category_id', name = '$category_name', navbar_status = '$navbar_status' WHERE id = '$category_id' LIMIT 1";

  $update_cat_result = mysqli_query($con, $update_cat_query);
  var_dump($update_cat_result);

  if ($update_cat_result) {
    $_SESSION['message-success'] = 'Category updated successfully';
    header('Location: ../category-view.php');
    exit();
  } else {
    $_SESSION['message-warning'] = 'Sommething went wrong';
    header('Location: ../category-view.php');
    exit();
  }
} elseif (isset($_POST['confirm_del_cat_btn'])) {
  $category_id = mysqli_real_escape_string($con, $_POST['confirm_del_cat_btn']);

  $cat_query = "SELECT id,name FROM categories WHERE id = $category_id LIMIT 1";
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
  $category_id = mysqli_real_escape_string($con, $_POST['delete_cat_btn']);

  $delete_cat_query = "UPDATE categories 
    SET status = '2' 
    WHERE id = '$category_id' LIMIT 1";

  $delete_cat_result = mysqli_query($con, $delete_cat_query);

  if ($delete_cat_result) {
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
