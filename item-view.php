<?php
require_once 'middleware/authentication.php';
require_once 'includes/header.php';
?>

<section class="bg-white shadow-md p-4 pb-8 flex flex-col gap-4 rounded-md ">
  <div>
    <h1 class=" text-[2rem] text-dark/75  font-semibold">Items</h1>
    <ul id="pageIndicator" class=" text-dark/65 flex gap-1">
      <li>
        <a href="index.php">Dashboard</a>
      </li>/
      <li>
        <a href="#">Item</a>
      </li>/
    </ul>
  </div>

  <div id="confirmDelBox" class="fixed top-[50%] translate-y-[-50%] left-[50%] translate-x-[-50%] bg-white p-20 px-14 rounded-2xl border border-gray-200 shadow-lg flex-col gap-4 items-center justify-center text-center transition-all duration-200 ease-in-out z-[61] hidden">

    <h2>
      Do you want to delete the item
      <span id="confirmDelItemName" class="font-semibold">Item name</span>
    </h2>
    <div class="flex gap-2">
      <button id="cancelDelete" class="btn-primary">
        No
      </button>
      <form id="FormConfirmItemDelete">
        <input type="hidden" id="confirmDelItemLogo" name="delete_item_logo_name">
        <input type="hidden" id="confirmDelItemFile" name="delete_item_file_name">
        <button type="submit" id="confirmDelItemId" name="delete_item_id" class="btn-red">
          Yes
        </button>
      </form>
    </div>
  </div>

  <div id="sideOutDelete" class="min-w-full min-h-screen bg-dark/50 fixed top-0 left-0 z-[60] cursor-pointer hidden">

  </div>

  <div class="flex w-full justify-end">
    <a href="item-add.php" class="btn btn-primary">
      Add Item
    </a>
  </div>

  <div id="table-wrapper">
    <table id="myDataTable">
      <thead>
        <tr>
          <th>Name</th>
          <th>Title</th>
          <th>Category</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody id="tableItemData">

      </tbody>
    </table>
  </div>

</section>

<?php
require_once 'includes/footer.php';
?>