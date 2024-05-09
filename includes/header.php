<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Est-fes - Admin</title>

  <link rel="stylesheet" href="./assets/css/style.css">
  <script src="./assets/js/script.js" defer ></script>

</head>
<body class="bg-bgGray max-w-[100vw]">

<?php 

  include('navbar.php');
  
?>

<div class="flex w-full">
  <?php include('aside.php') ?>
  <main class="p-4 <?=isset($_SESSION['auth']) ? 'ml-[12.8925rem]' : 'md:ml-0' ?> min-h-[calc(100vh-10.05rem)] w-full min-w-0">
