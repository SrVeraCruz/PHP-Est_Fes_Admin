<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Est-fes - Admin</title>

  <!-- Local Links -->
  <link rel="stylesheet" href="./assets/css/style.css">
  <script src="./assets/js/script.js" defer></script>
  <!-- Local Links -->

  <!-- Summernote Css -->
  <!-- <link href="./assets/css/summernote-lite.min.css" rel="stylesheet"> -->
  <link 
    href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet"
  >
  <!-- Summernote Css -->

  <!-- Data table Css Link -->
  <link rel="stylesheet" href="./assets/css/dataTables.dataTables.min.css">
  <!-- Data table Css Link -->

  <!-- Axios Link -->
  <script src="./assets/js/axios.min.js"></script>
  <!-- Axios Link -->

  <!-- Toaster Link -->
  <link href="./assets/css/toastr.min.css" rel="stylesheet" />
  <script src="./assets/js/jquery.min.js"></script>
  <script src="./assets/js/toastr.min.js"></script>
  <!-- Toaster Link -->


</head>

<body class="bg-bgGray max-w-[100vw]">

  <?php include('navbar.php') ?>

  <div class="flex w-full">

    <?php include('aside.php') ?>

    <main 
      class="p-4 md:ml-0 min-h-[calc(100vh-10.05rem)] w-full min-w-0 
        <?= 
          isset($_SESSION['auth']) 
          ? 'ml-[12.8925rem]' : '' 
        ?>
      "
      >