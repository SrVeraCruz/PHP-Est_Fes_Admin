<?php
require 'middleware/authentication.php';
require 'includes/header.php';
?>

<section class="bg-white shadow-md p-4 pb-8 flex flex-col gap-4 rounded-md">
  <div>
    <h1 class=" text-[2rem] text-dark/75  font-semibold">Settings</h1>
    <ul class=" text-dark/65 flex gap-1">
      <li>
        <a href="index.php">Dashboard</a>
      </li>/
      <li>
        <a href="#">Setting</a>
      </li>
    </ul>
  </div>

</section>

<?php
require 'includes/footer.php';
?>