<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Est-fes - Admin</title>

  <link rel="stylesheet" href="./assets/css/style.css">
  <script src="./assets/js/script.js" defer ></script>

  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>


</head>
<body class="bg-bgGray max-w-[100vw]">

<?php 

  include('navbar.php');
  
?>

<div class="flex w-full">
  <?php include('aside.php') ?>
  <main class="p-4 md:ml-0 <?=isset($_SESSION['auth']) ? 'ml-[12.8925rem]' : '' ?> min-h-[calc(100vh-10.05rem)] w-full min-w-0">
