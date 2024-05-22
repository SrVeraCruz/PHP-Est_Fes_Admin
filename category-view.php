<?php

include('middleware/authentication.php');
include('includes/header.php');

$editing = false;
if (isset($_SESSION['edit-category-data'])) {
  $editing = true;
}

$category_id = $_SESSION['edit-category-data']['id'] ?? null;
$category_name = $_SESSION['edit-category-data']['name'] ?? null;
$category_title = $_SESSION['edit-category-data']['title'] ?? null;
$parent_category_id = $_SESSION['edit-category-data']['parent_category_id'] ?? null;
$navbar_status = $_SESSION['edit-category-data']['navbar_status'] ?? ($_SESSION['add-category-data']['navbar_status'] ?? null) === 'on' ? '1' : '0';
$logo_name = $_SESSION['edit-category-data']['logo'] ?? null;
unset($_SESSION['edit-category-data']);

if (isset($_SESSION['add-category-data'])) {
  $category_name = $_SESSION['add-category-data']['name'] ?? null;
  $category_title = $_SESSION['add-category-data']['title'] ?? null;
  $parent_category_id = $_SESSION['add-category-data']['parent_category_id'] ?? null;
  $navbar_status = ($_SESSION['add-category-data']['navbar_status'] ?? null) === 'on' ? '1' : '0';
  unset($_SESSION['add-category-data']);
}

$confirm_delete = false;
if (isset($_SESSION['del-category-data'])) {
  $confirm_delete = true;
}

$del_category_id = $_SESSION['del-category-data']['id'] ?? null;
$del_category_name = $_SESSION['del-category-data']['name'] ?? null;
$del_category_logo_name = $_SESSION['del-category-data']['logo'] ?? null;
unset($_SESSION['del-category-data']);


?>

<?php include('includes/message.php') ?>

<section class="bg-white shadow-md p-4 pb-8 flex flex-col gap-4 rounded-md">


  <div>
    <h1 class=" text-[2rem] text-dark/75  font-semibold">Categories</h1>
    <ul class=" text-dark/65 flex gap-1">
      <li>
        <a href="index.php">Dashboard</a>
      </li>/
      <li>
        <a href="#">Category</a>
      </li>
      <?php if ($editing) : ?>
        /<li>
          <a href="#">Edit</a>
        </li>
      <?php elseif ($confirm_delete) : ?>
        /<li>
          <a href="#">Delete</a>
        </li>
      <?php endif ?>
    </ul>
  </div>

  <?php if ($confirm_delete) : ?>
    <div id="deleteBox" class="fixed top-[50%] translate-y-[-50%] left-[50%] translate-x-[-50%] bg-white p-20 px-14 rounded-2xl border border-gray-200 shadow-lg flex flex-col gap-4 items-center justify-center text-center transition-all duration-200 ease-in-out z-[61]">

      <h2>
        Do you want to delete the category
        <span class="font-semibold"><?= $del_category_name ?></span>
      </h2>
      <div class="flex gap-2">
        <button onclick="handleCancel()" class="btn-primary">
          No
        </button>
        <form action="controller/category-code.php" method="post">
          <input type="hidden" name="del_category_logo_name" value="<?= $del_category_logo_name ?>">
          <button name="delete_cat_btn" value="<?= $del_category_id ?>" class="btn-red">
            Yes
          </button>
        </form>
      </div>
    </div>

    <div class="min-w-full min-h-screen bg-dark/50 fixed top-0 left-0 z-[60] cursor-pointer" onclick="handleCancel()">

    </div>
  <?php endif ?>

  <div>
    <form action="controller/category-code.php" method="post" enctype="multipart/form-data" class="flex flex-col gap-3">
      <div class="flex flex-col gap-4">
        <div>
          <label>
            <?= $editing ? 'Edit category ' . $category_name : 'New category name' ?>
          </label>

          <div class="flex gap-1.5">
            <input type="text" name="name" value="<?= $category_name ?>" placeholder="e.g: E-L">
            <select name="parent_category_id">
              <option value="">No parent category</option>
              <?php
              $category_query = "SELECT * FROM categories WHERE status != '2'";
              $category_result = mysqli_query($con, $category_query);

              if (mysqli_num_rows($category_result) > 0) {
              ?>
                <?php foreach ($category_result as $category) : ?>
                  <option value="<?= $category['id'] ?>" <?= $parent_category_id === $category['id'] ? 'selected' : '' ?> class="<?= $category_id === $category['id'] ? 'hidden' : '' ?>"><?= $category['name'] ?></option>
                <?php endforeach ?>
              <?php
              }
              ?>

            </select>
          </div>
        </div>

        <div class="flex flex-col w-full">
          <label>Category title</label>
          <input type="text" name="title" value="<?= $category_title ?>" placeholder="e.g: E-Learning">
        </div>
        <div class="flex flex-col w-full">
          <label>Category logo</label>
          <?php if ($editing) : ?>
            <input type="hidden" name="old_cat_logo_name" value="<?= $logo_name ?>">
          <?php endif ?>
          <input type="file" name="category_logo">
        </div>

        <div class="flex flex-col items-start -mt-2">
          <label>Navbar</label>
          <div class="flex items-center gap-2 text-sm text-softDark">
            <input type="checkbox" name="navbar_status" <?= $navbar_status === '1' ? 'checked' : '' ?> class="w-auto">
            (cheked=hidden, unchecked=visible)
          </div>
        </div>
      </div>
      <div>
        <?php
        if ($editing) {
        ?>
          <button type="button" onclick="handleCancel()" class="btn-default">
            Cancel
          </button>
          <button type="submit" name="edit_category_btn" class="btn-primary self-start">
            Update
          </button>
          <input type="hidden" value="<?= $category_id ?>" name="id">

        <?php
        } else {
        ?>
          <button type="submit" name="add_category_btn" class="btn-primary self-start">
            Save
          </button>
        <?php
        }
        ?>
      </div>
    </form>
  </div>

  <div id="table-wrapper" class="">
    <table id="myDataTable">
      <thead>
        <tr>
          <th>Category</th>
          <th>Parent</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $category_query = "SELECT c1.*, c2.name AS parent_name, c2.status AS parent_status FROM categories c1 
        LEFT JOIN categories c2 
        ON c2.id = c1.parent_category_id 
        WHERE c1.status != '2'";
        $category_result = mysqli_query($con, $category_query);
        if (mysqli_num_rows($category_result) > 0) {
        ?>
          <?php foreach ($category_result as $category) : ?>
            <tr>
              <td><?= $category['name'] ?></td>
              <td>
                <?= $category['parent_name'] ?>&nbsp;<?= $category['parent_status'] === '2' ? '(Deleted)' : '' ?>
              </td>
              <td><?= $category['navbar_status'] === '1' ? 'Hidden' : 'Visible' ?></td>
              <td class="flex gap-1.5">
                <form action="controller/category-code.php" method="post">
                  <button type="submit" name="get_cat_data_btn" value="<?= $category['id'] ?>" class="btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                      <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                    </svg>
                    edit
                  </button>
                </form>

                <?php if ($_SESSION['auth_role'] === '2') : ?>
                  <form action="controller/category-code.php" method="post">
                    <button type="submit" name="confirm_del_cat_btn" value="<?= $category['id'] ?>" class="btn-red">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                      </svg>
                      delete
                    </button>
                  </form>
                <?php endif ?>
              </td>
            </tr>
          <?php endforeach ?>
        <?php
        } else {
        ?>
          <td colspan="4">No Record Found</td>
        <?php
        }
        ?>

      </tbody>
    </table>
  </div>

</section>

<script>
  const handleCancel = () => {
    location.reload();
  }
</script>

<?php
include('includes/footer.php')

?>