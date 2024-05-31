<?php
session_start();
if ($_SESSION['auth_role'] != '2') {
  $_SESSION['message-error'] = 'You are not Authorised as Super Admin';
  header('Location: http://localhost/EST_FES_SITE-Refactored/admin_est-usmba.ac.ma/index.php');
  exit();
}
