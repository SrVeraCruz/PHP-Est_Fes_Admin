<?php

session_start();
// include('config/db.php');

if (isset($_SESSION['auth'])) {
  if ($_SESSION['auth_role'] === '0') {
    // No Permission to access Dashboard
    $_SESSION['message-error'] = 'Permission denied. Please Visite the School Website';
    header('Location: login.php');
    exit();
  }
} else {
  // No Permission
  $_SESSION['message-warning'] = 'Please login to access Dashboard';
  header('Location: login.php');
  exit();
}
