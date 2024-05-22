<?php
if ($_SESSION['auth_role'] != '2') {
  $_SESSION['message-error'] = 'You are not Authorised as Super Admin';
  header('Location: ../index.php');
  exit();
}
