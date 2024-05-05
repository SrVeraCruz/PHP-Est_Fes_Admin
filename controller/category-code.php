<?php 

  session_start();
  include('../config/db.php');

  if(isset($_POST['add_category_btn'])) {
    $category_name = mysqli_real_escape_string($con,$_POST['category_name']);
    $parent_category_id = mysqli_real_escape_string($con,$_POST['parent_category_id']);

    $add_cat_query = "INSERT INTO categories (parent_category_id,name) 
    VALUES ('$parent_category_id','$category_name')";
    $add_cat_result = mysqli_query($con,$add_cat_query);

    if($add_cat_result) {
      $_SESSION['message_success'] = 'Category added successfully';
      header('Location: ../category-view.php');
      exit();

    } else {
      $_SESSION['message_warning'] = 'Sommething went wrong';
      header('Location: ../category-view.php');
      exit();

    }
  
  } elseif(isset($_POST['get_cat_data_btn'])) {
    $category_id = mysqli_real_escape_string($con,$_POST['get_cat_data_btn']);

    $cat_query = "SELECT * FROM categories WHERE id = $category_id LIMIT 1";
    $cat_result = mysqli_query($con,$cat_query);

    if(mysqli_num_rows($cat_result) > 0) {
      $cat_data = mysqli_fetch_assoc($cat_result);

      $_SESSION['category-data'] = $cat_data;
      header('Location: ../category-view.php');
      exit();

    } else {
      $_SESSION['message_error'] = 'Sommething went wrong';
      header('Location: ../category-view.php');
      exit();
    
    }

  } elseif(isset($_POST['edit_category_btn'])) {
    $category_name = mysqli_real_escape_string($con,$_POST['category_name']);
    $parent_category_id = mysqli_real_escape_string($con,$_POST['parent_category_id']);

    $update_cat_query = "UPDATE categories 
    SET parent_category_id = $parent_category_id, name = $category_name";
    $update_cat_result = mysqli_query($con,$update_cat_query);

    if($update_cat_result) {
      $_SESSION['message_success'] = 'Category updated successfully';
      header('Location: ../category-view.php');
      exit();

    } else {
      $_SESSION['message_warning'] = 'Sommething went wrong';
      header('Location: ../category-view.php');
      exit();

    }
    
  } else {
    $_SESSION['message_error'] = 'No permission';
    header('Location: ../category-view.php');
    exit();
  }

?>