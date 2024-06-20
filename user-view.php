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

  <div id="confirmDelBox" class="fixed top-[50%] translate-y-[-50%] left-[50%] translate-x-[-50%] bg-white p-20 px-14 rounded-2xl border border-gray-200 shadow-lg flex-col gap-4 items-center justify-center text-center transition-all duration-200 ease-in-out z-[61] hidden">

    <h2>
      Do you want to delete the user
      <span id="confirmDelUserName" class="font-semibold">Username</span>
    </h2>
    <div class="flex gap-2">
      <button id="cancelDelete" class="btn-primary">
        No
      </button>
      <form id="formConfirmUserDelete">
        <input type="hidden" id="confirmDelUserRole" name="delete_user_role">
        <input type="hidden" id="confirmDelUserAvatar" name="delete_user_avatar_name">
        <button type="submit" id="confirmDelUserId" name="delete_user_btn" class="btn-red">
          Yes
        </button>
      </form>
    </div>
  </div>

  <div id="sideOutDelete" class="min-w-full min-h-screen bg-dark/50 fixed top-0 left-0 z-[60] cursor-pointer hidden">

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