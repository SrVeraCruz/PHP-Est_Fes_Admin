<?php
session_start();

if (isset($_SESSION['auth'])) {
  if ($_SESSION['auth_role'] === '1' || $_SESSION['auth_role'] === '2') {
    // Alread Logged in
    $_SESSION['message-warning'] = 'You are alread Logged in';
    header('Location: index.php');
    exit();
  }
}
