<?php
require_once 'middleware/authentication.php';
require_once 'includes/header.php';
?>

<?php require_once 'includes/message.php' ?>

<section class="bg-white shadow-md p-4 pb-8 flex flex-col gap-4 rounded-md">
  <div>
    <h1 class=" text-[2rem] text-dark/75  font-semibold">Est-Admin</h1>
    <ul class=" text-dark/65 flex gap-1">
      <li>
        <a href="index.php">Dashboard</a>
      </li>/
    </ul>
  </div>

  <div class="grid grid-cols-4 xl:grid-cols-2 md:grid-cols-1 gap-5">
    <div class="p-4 shadow-md bg-highlight/40 rounded-md min-h-28 hover:bg-highlight/75 hover:shadow-lg transition duration-200 ease-in-out hover:scale-[1.03] ">
      <a href="user-view.php">
        <div>
          <h5 class=" text-base font-medium text-dark/80">Total Users</h5>
          <span id="usersQte" class="text-dark/75 font-semibold text-2xl">0</span>
        </div>
      </a>
    </div>
    <div class="p-4 shadow-md bg-highlight/40 rounded-md min-h-28 hover:bg-highlight/75 hover:shadow-lg transition duration-200 ease-in-out hover:scale-105 ">
      <a href="user-view.php">
        <div>
          <h5 class=" text-base font-medium text-dark/80">Total Blocked Users</h5>
          <span id="usersBlockQte" class="text-dark/75 font-semibold text-2xl">0</span>
        </div>
      </a>
    </div>
    <div class="p-4 shadow-md bg-highlight/40 rounded-md min-h-28 hover:bg-highlight/75 hover:shadow-lg transition duration-200 ease-in-out hover:scale-105 ">
      <a href="category-view.php">
        <div>
          <h5 class=" text-base font-medium text-dark/80">Total Categories</h5>
          <span id="catsQte" class="text-dark/75 font-semibold text-2xl">0</span>
        </div>
      </a>
    </div>
    <div class="p-4 shadow-md bg-highlight/40 rounded-md min-h-28 hover:bg-highlight/75 hover:shadow-lg transition duration-200 ease-in-out hover:scale-105 ">
      <a href="item-view.php">
        <div>
          <h5 class=" text-base font-medium text-dark/80">Total Items</h5>
          <span id="itemsQte" class="text-dark/75 font-semibold text-2xl">0</span>
        </div>
      </a>
    </div>
</section>

<?php
require_once 'includes/footer.php'
?>