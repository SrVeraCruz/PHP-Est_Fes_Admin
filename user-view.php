<?php
require_once 'middleware/authentication.php';
require_once 'includes/header.php';
?>

<section class="bg-white shadow-md p-4 pb-8 flex flex-col gap-4 rounded-md">
  <div>
    <h1 class=" text-[2rem] text-dark/75  font-semibold">Users</h1>
    <ul id="pageIndicator" class=" text-dark/65 flex gap-1">
      <li>
        <a href="index.php">Dashboard</a>
      </li>/
      <li>
        <a href="#">User</a>
      </li>/

    </ul>
  </div>

  <div class="flex w-full justify-end">
    <a href="user-add.php" class="btn btn-primary">
      Add User
    </a>
  </div>

  <div id="table-wrapper">
    <table id="myDataTable">
      <thead>
        <tr>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Email</th>
          <th>Roles</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody id="tableUserData">

      </tbody>
    </table>
  </div>

</section>

<?php
require_once 'includes/footer.php';
?>