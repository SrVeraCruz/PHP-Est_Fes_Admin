<?php
require_once 'middleware/authentication.php';
require_once 'includes/header.php';
?>

<section 
  class="bg-white shadow-md p-4 pb-8 
    flex flex-col gap-4 rounded-md
  "
>
  <div>
    <h1 class=" text-[2rem] text-dark/75 font-semibold">News</h1>
    <ul class=" text-dark/65 flex gap-1">
      <li>
        <a href="index.php">Dashboard</a>
      </li>/
      <li>
        <a href="news-view.php">News</a>
      </li>/
      <li>
        <a href="#">Edit</a>
      </li>
    </ul>
  </div>

  <div class="text-softDark flex flex-col w-full">
    <div class="flex w-full justify-end">
      <a 
        href="news-view.php" 
        class="btn btn-default !bg-highlight"
      >
        Back
      </a>
    </div>

    <form id="formNewsUpdate" class="w-full h-full">

      <div class="px-7 text-[.9rem] flex flex-col gap-5">
        <div class="flex flex-col w-full">
          <label class="font-bold">News title:</label>
          <input 
            type="text" 
            id="title"
            name="title" 
            placeholder="e.g: Retrait de la cart" 
            class="shadow-md p-3 outline-none 
              text-[.9rem] rounded-md
            "
          />
        </div>

        <div class="flex flex-col w-full">
          <label class="font-bold">Meta title:</label>
          <input 
            type="text" 
            id="metaTitle"
            name="meta_title" 
            placeholder="e.g: News | Est-Fes" 
            class="shadow-md p-3 outline-none rounded-md"
          />
        </div>

        <div class="flex flex-col w-full">
          <label class="font-bold">Thumbnail:</label>
          <input 
            type="hidden" 
            id="oldThumbnail" 
            name="old_thumbnail" 
          />
          <input 
            type="file" 
            id="thumbnail"
            name="thumbnail" 
            class="shadow-md p-3 outline-none 
              text-[.9rem] rounded-md
            "
          />
        </div>

        <div class="mt-2 flex flex-col gap-4">
          <h2 class="text-center -mb-2 text-lg font-semibold ">
            Page Content
          </h2>
          <div 
            id="item_content_list" 
            class="border-b-2 border-t-2 py-1 pb-2 flex flex-col gap-2"
          >
            <div id="items">
              <div id="item">
                <div id="element">
                  <label>Description:</label>
                  <textarea id="contentPage" name="content" class="summernote"></textarea>
                </div>
              </div>
            </div>

          </div>
          <div class="flex flex-col w-full">
            <label class="font-bold">File:</label>
            <input type="hidden" id="oldFile" name="old_file" >
            <input 
              type="file" 
              id="file"
              name="file" 
              class="shadow-md p-3 outline-none rounded-md"
            />
          </div>
        </div>

        <div class="flex flex-col items-start">
          <label class="font-bold">Status:</label>
          <div class="flex items-center gap-2">
            <input type="checkbox" id="status" name="status" class="w-auto">
            (cheked=hidden, unchecked=visible)
          </div>
        </div>

        <button 
          type="submit" 
          class="bg-primary p-3 rounded-md text-white 
            uppercase mt-3 sm:mt-0 font-semibold 
            hover:bg-primary/90 transition duration-200 
            ease-in-out sm:text-xs
          " 
        >
          Update news
        </button>

      </div>

    </form>

  </div>
</section>

<?php
require_once 'includes/footer.php';
?>