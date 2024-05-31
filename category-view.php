<?php
require_once 'middleware/authentication.php';
require_once 'includes/header.php';
?>

<?php require_once 'includes/message.php' ?>

<section class="bg-white shadow-md p-4 pb-8 flex flex-col gap-5 rounded-md">

  <div>
    <h1 class=" text-[2rem] text-dark/75  font-semibold">Categories</h1>
    <ul id="pageIndicator" class=" text-dark/65 flex gap-1">
      <li>
        <a href="index.php">Dashboard</a>
      </li>/
      <li>
        <a href="#">Category</a>
      </li>/
    </ul>
  </div>

  <div id="confirmDelBox" class="fixed top-[50%] translate-y-[-50%] left-[50%] translate-x-[-50%] bg-white p-20 px-14 rounded-2xl border border-gray-200 shadow-lg flex-col gap-4 items-center justify-center text-center transition-all duration-200 ease-in-out z-[61] hidden">

    <h2>
      Do you want to delete the category
      <span id="confirmDelCatName" class="font-semibold">Category&nbsp;Name</span>
    </h2>
    <div class="flex gap-2">
      <button id="cancelDelete" class="btn-primary">
        No
      </button>
      <form id="FormConfirmCatDelete">
        <input type="hidden" id="confirmDelCatLogo" name="delete_cat_logo">
        <button type="submit" id="confirmDelCatId" name="delete_cat_id" class="btn-red">
          Yes
        </button>
      </form>
    </div>
  </div>

  <div id="sideOutDelete" class="min-w-full min-h-screen bg-dark/50 fixed top-0 left-0 z-[60] cursor-pointer hidden">

  </div>

  <div>
    <form id="formCat" class="flex flex-col gap-3">
      <div class="flex flex-col gap-4">
        <div>
          <label id="catLabel">
            New category name
          </label>

          <div class="flex gap-1.5">
            <input type="text" id="catName" name="name" placeholder="e.g: E-L">
            <select id="selectCat" name="parent_category_id">
              <option value="0">No parent category</option>
            </select>
          </div>
        </div>

        <div class="flex gap-1.5">
          <div class="flex flex-col w-full">
            <label>Category title</label>
            <input type="text" id="catTitle" name="title" placeholder="e.g: E-Learning">
          </div>
          <div class="flex flex-col w-full">
            <label>Slug(URL)</label>
            <input type="text" id="catSlug" name="slug" placeholder="e.g: espace-etudiant-el">
          </div>
        </div>

        <div class="flex flex-col w-full">
          <label>Category logo</label>
          <input type="file" name="logo">
        </div>

        <div class="flex flex-col items-start -mt-2">
          <label>Navbar</label>
          <div class="flex items-center gap-2 text-sm text-softDark">
            <input type="checkbox" id="catStatus" name="navbar_status" class="w-auto">
            (cheked=hidden, unchecked=visible)
          </div>
        </div>
      </div>
      <div>
        <button type="button" id="catBtnCancel" class="btn-default hidden">
          Cancel
        </button>

        <button type="submit" id="catBtnSave" name="add_category_btn" class="btn-primary self-start">
          Save
        </button>
      </div>
    </form>
  </div>

  <div id="table-wrapper">
    <table id="myDataTable">
      <thead>
        <tr>
          <th>Category</th>
          <th>Parent</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody id="tableCatData">

      </tbody>
    </table>
  </div>

</section>

<?php
require_once 'includes/footer.php';
?>