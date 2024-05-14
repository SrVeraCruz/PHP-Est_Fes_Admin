<?php

session_start();
include('../config/db.php');

if (isset($_POST['add_item_btn'])) {
  // Add item
  $name = mysqli_real_escape_string($con, $_POST['name']);
  $title = mysqli_real_escape_string($con, $_POST['title']);
  $category_id = mysqli_real_escape_string($con, $_POST['category_id']);
  $slug = mysqli_real_escape_string($con, $_POST['slug']);
  $meta_title = mysqli_real_escape_string($con, $_POST['meta_title']);
  $data_content_title = $_POST['data_content_title'];
  $data_content_desc = $_POST['data_content_desc'];

  // Inputs Verification
  if (!$name) {
    $_SESSION['message-warning'] = 'Please enter the item name';
  } elseif (!$title) {
    $_SESSION['message-warning'] = 'Please enter the item title';
  } elseif (!$category_id) {
    $_SESSION['message-warning'] = 'Please enter the item category';
  } elseif (!$slug) {
    $_SESSION['message-warning'] = 'Please enter the slug of the item';
  } elseif (!$meta_title) {
    $_SESSION['message-warning'] = 'Please enter the item meta-title';
  } elseif ((trim($data_content_title[0])) === '') {
    $_SESSION['message-warning'] = 'The item need 1+ subtitle';
  } elseif ((trim($data_content_desc[0])) === '') {
    $_SESSION['message-warning'] = 'The item need 1+ description';
  } else {
    $data_content = [];

    for ($i = 0; $i < sizeof($data_content_title); $i++) {
      $data = [
        'title' => $data_content_title[$i],
        'description' => $data_content_desc[$i],
      ];

      array_push($data_content, $data);
    }

    $data_content_json = json_encode($data_content);
    $escaped_data_content_json = addslashes($data_content_json);
  }

  if (isset($_SESSION['message-warnings'])) {
    // Redirect if have an error message
    $_SESSION['add_item_data'] = $_POST;
    header('Location: ../item-add.php');
    exit();
  } else {
    $item_query = "INSERT INTO items (category_id,name,title,slug,data_content,meta_title) 
      VALUES ('$category_id','$name','$title','$slug','$escaped_data_content_json','$meta_title') LIMIT 1";

    $item_result = mysqli_query($con, $item_query);

    if ($item_result) {
      $_SESSION['message-success'] = 'Item added successfully';
      header('Location: ../item-view.php');
      exit();
    } else {
      $_SESSION['message-warning'] = 'Sommething went wrong';
      $_SESSION['add_item_data'] = $_POST;
      header('Location: ../item-add.php');
      exit();
    }
  }
} elseif (isset($_POST['edit_item_btn'])) {
  // Edit item
  $item_id = mysqli_real_escape_string($con, $_POST['item_id']);
  $name = mysqli_real_escape_string($con, $_POST['name']);
  $title = mysqli_real_escape_string($con, $_POST['title']);
  $category_id = mysqli_real_escape_string($con, $_POST['category_id']);
  $slug = mysqli_real_escape_string($con, $_POST['slug']);
  $meta_title = mysqli_real_escape_string($con, $_POST['meta_title']);
  $data_content_title = $_POST['data_content_title'];
  $data_content_desc = $_POST['data_content_desc'];
  $status = mysqli_real_escape_string($con, $_POST['status'] ?? null) == 'on' ? '1' : '0';

  // Inputs Verification
  if (!$name) {
    $_SESSION['message-warning'] = 'Please enter the item title';
  } elseif (!$title) {
    $_SESSION['message-warning'] = 'Please enter the item title';
  } elseif (!$category_id) {
    $_SESSION['message-warning'] = 'Please enter the item category';
  } elseif (!$slug) {
    $_SESSION['message-warning'] = 'Please enter the slug of the item';
  } elseif (!$meta_title) {
    $_SESSION['message-warning'] = 'Please enter the item meta-title';
  } elseif ((trim($data_content_title[0])) === '') {
    $_SESSION['message-warning'] = 'The item need 1+ subtitle';
  } elseif ((trim($data_content_desc[0])) === '') {
    $_SESSION['message-warning'] = 'The item need 1+ description';
  } else {
    $data_content = [];

    for ($i = 0; $i < sizeof($data_content_title); $i++) {
      $data = [
        'title' => $data_content_title[$i],
        'description' => $data_content_desc[$i],
      ];

      array_push($data_content, $data);
    }

    $data_content_json = json_encode($data_content);
    $escaped_data_content_json = addslashes($data_content_json);
  }

  if (isset($_SESSION['message-warning'])) {
    // Redirect if have an error message
    $_SESSION['message-warning'] = 'Sommething went wrong';
    $_SESSION['edit_item_data'] = $_POST;
    header('Location: ../item-edit.php?id=' . $item_id);
    exit();
  } else {
    $item_query = "UPDATE items SET category_id = '$category_id', name = '$name', title = '$title', slug = '$slug',data_content = '$escaped_data_content_json', meta_title = '$meta_title', status = '$status' WHERE id = '$item_id' LIMIT 1";

    $item_result = mysqli_query($con, $item_query);

    if ($item_result) {
      $_SESSION['message-success'] = 'Item updated successfully';
      header('Location: ../item-view.php');
      exit();
    } else {
      $_SESSION['edit_item_data'] = $_POST;
      //var_dump($_POST, $item_result, $data_content_json);
      $_SESSION['message-warning'] = 'Sommething went wrong';
      header('Location: ../item-edit.php?id=' . $item_id);
      exit();
    }
  }
} elseif (isset($_POST['confirm_del_item_btn'])) {
  // Get item to confirm delete
  $item_id = mysqli_real_escape_string($con, $_POST['confirm_del_item_btn']);

  $item_query = "SELECT id,title FROM items WHERE id = $item_id LIMIT 1";
  $item_result = mysqli_query($con, $item_query);

  if (mysqli_num_rows($item_result) > 0) {
    $item_data = mysqli_fetch_assoc($item_result);

    $_SESSION['del-item-data'] = $item_data;
    header('Location: ../item-view.php');
    exit();
  } else {
    $_SESSION['message-warning'] = 'Sommething went wrong';
    header('Location: ../item-view.php');
    exit();
  }
} elseif (isset($_POST['delete_item_btn'])) {
  // Delete item
  $item_id = mysqli_real_escape_string($con, $_POST['delete_item_btn']);

  $delete_item_query = "DELETE FROM items WHERE id = '$item_id' LIMIT 1";

  $delete_item_result = mysqli_query($con, $delete_item_query);

  if ($delete_item_result) {
    $_SESSION['message-success'] = 'Item deleted successfully';
    header('Location: ../item-view.php');
    exit();
  } else {
    $_SESSION['message-warning'] = 'Sommething went wrong';
    header('Location: ../item-view.php');
    exit();
  }
} else {
  $_SESSION['message-error'] = 'No permission to access';
  header('Location: ../item-view.php');
  exit();
}
