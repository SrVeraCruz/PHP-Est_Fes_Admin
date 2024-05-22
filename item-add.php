<?php

include('middleware/authentication.php');
include('includes/header.php');

$name = $_SESSION['add_item_data']['name'] ?? null;
$title = $_SESSION['add_item_data']['title'] ?? null;
$category_id = $_SESSION['add_item_data']['category_id'] ?? null;
$slug = $_SESSION['add_item_data']['slug'] ?? null;
$data_content_title = $_SESSION['add_item_data']['data_content_title'] ?? null;
$data_content_desc = $_SESSION['add_item_data']['data_content_desc'] ?? null;
$meta_title = $_SESSION['add_item_data']['meta_title'] ?? null;
$status = $_SESSION['add_item_data']['status'] ?? null;

unset($_SESSION['add_item_data']);


?>

<?php include('includes/message.php') ?>

<section class="bg-white shadow-md p-4 pb-8 flex flex-col gap-4 rounded-md">
  <div>
    <h1 class=" text-[2rem] text-dark/75  font-semibold">Items</h1>
    <ul class=" text-dark/65 flex gap-1">
      <li>
        <a href="index.php">Dashboard</a>
      </li>/
      <li>
        <a href="item-view.php">Item</a>
      </li>/
      <li>
        <a href="#">Add</a>
      </li>
    </ul>
  </div>


  <div class="text-softDark flex flex-col w-full">
    <div class="flex w-full justify-end">
      <a href="item-view.php" class="btn btn-default !bg-highlight">
        Back
      </a>
    </div>

    <form action="controller/item-code.php" method="post" enctype="multipart/form-data" class="w-full h-full">

      <div class="px-7 text-[.9rem] flex flex-col gap-5">
        <div class="flex flex-col w-full">
          <label class="font-bold">Item Name:</label>
          <input type="text" name="name" value="<?= $name ?>" placeholder="e.g: informatique" class="shadow-md p-3 outline-none text-[.9rem] rounded-md">
        </div>
        <div class="flex flex-col">
          <label class="font-bold">Item title:</label>
          <div class="flex sm:flex-col gap-2">
            <input type="text" name="title" value="<?= $title ?>" placeholder="e.g: Informatique" class=" p-3 outline-none text-[.9rem] rounded-md">
            <select name="category_id">
              <option value="">No category</option>
              <?php
              $category_query = "SELECT * FROM categories WHERE status != '2'";
              $category_result = mysqli_query($con, $category_query);

              if (mysqli_num_rows($category_result) > 0) {
              ?>
                <?php foreach ($category_result as $category) : ?>
                  <option value="<?= $category['id'] ?>" <?= $category['id'] === $category_id ? 'selected' : '' ?>><?= $category['name'] ?></option>
                <?php endforeach ?>
              <?php
              }
              ?>

            </select>
          </div>

        </div>
        <div class="flex sm:flex-col gap-2">
          <div class="flex flex-col w-full">
            <label class="font-bold">Slug(URL):</label>
            <input type="text" name="slug" value="<?= $slug ?>" placeholder="e.g: informatique-dut" class="shadow-md p-3 outline-none text-[.9rem] rounded-md">
          </div>
          <div class="flex flex-col w-full">
            <label class="font-bold">Meta Title:</label>
            <input type="text" name="meta_title" value="<?= $meta_title ?>" placeholder="e.g: Informatique | Est-Fes" class="shadow-md p-3 outline-none rounded-md">
          </div>
        </div>

        <div class="mt-2 flex flex-col gap-2">
          <h2 class="text-center -mb-2 text-lg font-semibold ">Page Content</h2>
          <div id="item_content_list" class="border-b-2 border-t-2 py-1 pb-2 flex flex-col gap-2">
            <div id="items">
              <?php
              if ($data_content_desc) {
                for ($i = 0; $i < sizeof($data_content_desc); $i++) {
              ?>
                  <div id="item">
                    <button id="delItem" onclick="handleDeleteItem()" type="button">
                      <span></span>
                      <span></span>
                    </button>
                    <div id="element">
                      <label>Sub-title:</label>
                      <input type="text" name="data_content_title[]" value="<?= $data_content_title[$i] ?>" placeholder="e.g: Presentation">
                    </div>
                    <div id="element">
                      <label>Description:</label>
                      <textarea class="summernote" name="data_content_desc[]"><?= $data_content_desc[$i] ?></textarea>
                    </div>
                  </div>
                <?php
                }
              } else {
                ?>
                <div id="item">
                  <button id="delItem" onclick="handleDeleteItem(event)" type="button">
                    <span></span>
                    <span></span>
                  </button>
                  <div id="element">
                    <label>Sub-title:</label>
                    <input type="text" name="data_content_title[]" placeholder="e.g: Presentation">
                  </div>
                  <div id="element">
                    <label>Description:</label>
                    <textarea name="data_content_desc[]" class="summernote"></textarea>
                  </div>
                </div>
              <?php
              }
              ?>
            </div>

            <div class="flex items-center justify-center">
              <button type="button" onclick="handleAddItem()">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
              </button>
            </div>

          </div>
          <div class="flex flex-col w-full">
            <label class="font-bold">File:</label>
            <input type="file" name="file" class="shadow-md p-3 outline-none rounded-md">
          </div>
        </div>

        <div class="flex flex-col items-start -mt-2">
          <label class="font-bold">Status:</label>
          <div class="flex items-center gap-2">
            <input type="checkbox" name="status" class="w-auto">
            (cheked=hidden, unchecked=visible)
          </div>
        </div>

        <button type="submit" class="bg-primary p-3 rounded-md text-white uppercase mt-3 sm:mt-0 font-semibold hover:bg-primary/90 transition duration-200 ease-in-out sm:text-xs" name="add_item_btn">Add item</button>

      </div>

    </form>

  </div>

</section>

<?php

include('includes/footer.php')

?>