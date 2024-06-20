<?php
require_once 'middleware/authentication.php';
require_once 'includes/header.php';
?>

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
        <a href="#">Edit</a>
      </li>
    </ul>
  </div>


  <div class="text-softDark flex flex-col w-full">
    <div class="flex w-full justify-end">
      <a href="item-view.php" class="btn btn-default !bg-highlight">
        Back
      </a>
    </div>

    <form id="formItemUpdate" class="w-full h-full">

      <div class="px-7 text-[.9rem] flex flex-col gap-5">
        <div class="flex flex-col">
          <label class="font-bold">Item Name:</label>
          <div class="flex sm:flex-col gap-2">
            <input type="text" id="name" name="name" placeholder="e.g: informatique" class="shadow-md p-3 outline-none text-[.9rem] rounded-md">
            <select name="category_id" id="selectCat" class="shadow-md p-3 outline-none text-[.9rem] rounded-md">
              <option value="">No category</option>

            </select>
          </div>
        </div>

        <div class="flex flex-col w-full">
          <label class="font-bold">Item title:</label>
          <input type="text" id="title" name="title" placeholder="e.g: Informatique" class="shadow-md p-3 outline-none text-[.9rem] rounded-md">
        </div>

        <div class="flex sm:flex-col gap-2">
          <div class="flex flex-col w-full">
            <label class="font-bold">Slug(URL):</label>
            <input type="text" id="slug" name="slug" placeholder="e.g: informatique-dut" class="shadow-md p-3 outline-none text-[.9rem] rounded-md">
          </div>
          <div class="flex flex-col w-full">
            <label class="font-bold">Meta Title:</label>
            <input type="text" id="metaTitle" name="meta_title" placeholder="e.g: Informatique | Est-Fes" class="shadow-md p-3 outline-none rounded-md">
          </div>
        </div>

        <div class="flex flex-col w-full">
          <label class="font-bold">Item logo:</label>
          <input type="hidden" id="logoOldName" name="logo_old_name">
          <input type="file" name="logo" class="shadow-md p-3 outline-none text-[.9rem] rounded-md">
        </div>

        <div class="mt-2 flex flex-col gap-2">
          <h2 class="text-center -mb-2 text-lg font-semibold ">Page Content</h2>
          <div id="item_content_list" class="border-b-2 border-t-2 py-1 pb-2 flex flex-col gap-2">
            <div id="items">
              <div id="item">
                <button id="removeContentItemBtn" type="button">
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
            </div>
            <div class="flex items-center justify-center">
              <button type="button" id="addContentItemBtn">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
              </button>
            </div>
          </div>
          <div class="flex flex-col w-full">
            <label class="font-bold">File:</label>
            <input type="hidden" id="fileOldName" name="file_old_name">
            <input type="file" name="file" class="shadow-md p-3 outline-none rounded-md">
          </div>
        </div>

        <div class="flex flex-col items-start -mt-2">
          <label class="font-bold">Status:</label>
          <div class="flex items-center gap-2">
            <input type="checkbox" name="status" id="status" class="w-auto">
            (cheked=hidden, unchecked=visible)
          </div>
        </div>

        <button type="submit" class="bg-primary p-3 rounded-md text-white uppercase mt-3 sm:mt-0 font-semibold hover:bg-primary/90 transition duration-200 ease-in-out sm:text-xs" name="edit_item_btn">Update item</button>

      </div>
    </form>

  </div>
</section>

<?php
require_once 'includes/footer.php';
?>