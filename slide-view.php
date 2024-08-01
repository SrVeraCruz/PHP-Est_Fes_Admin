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
    <h1 class=" text-[2rem] text-dark/75  font-semibold">
      Slides
    </h1>
    <ul class=" text-dark/65 flex gap-1">
      <li>
        <a href="index.php">Dashboard</a>
      </li>/
      <li>
        <a href="#">Slide</a>
      </li>/
    </ul>
  </div>

  <div>
    <form id="formSlide" class="flex flex-col gap-3">
      <div class="flex flex-col gap-4">
        
        <div>
          <label>Slide type</label>
          <select id="slideType" name="type">
            <option value="">Select type</option>
            <option value="main">Main</option>
            <option value="secondary">Secondary</option>
          </select>
        </div>
        <div class="flex gap-1.5">
          <div class="flex flex-col w-full">
            <label>Title</label>
            <input 
              type="text" 
              id="slideTitle" 
              name="title" 
              class="flex-1"
              placeholder="e.g: Bienvenu EST de Fés"
            />
          </div>
          <div class="flex flex-col w-full">
            <label>Image</label>
            <input type="file" name="image">
          </div>
        </div>

        <div class="flex flex-col items-start -mt-2">
          <label>Status</label>
          <div 
            class="flex items-center gap-2 
              text-sm text-softDark
            "
          >
            <input 
              type="checkbox" 
              id="slideStatus" 
              name="status" 
              class="w-auto"
            />
            (cheked=hidden, unchecked=visible)
          </div>
        </div>
      </div>
      <div>
        <button 
          type="button" 
          id="catBtnCancel" 
          class="btn-default hidden"
        >
          Cancel
        </button>

        <button 
          type="submit" 
          id="catBtnSave" 
          name="add_category_btn" 
          class="btn-primary self-start"
        >
          Add
        </button>
      </div>
    </form>
  </div>

  <div class="mt-2">
    <h3 class="font-bold text-sm text-dark/80">Main Slide</h3>
    <div class="w-full border-t-2 py-2 overflow-hidden">
      <div id="mainSlide" class="flex gap-3 overflow-auto">
        <span class="text-sm text-softDark">No data yet</span>
      </div>
    </div>
  </div>
  
  <div>
    <h3 class="font-bold text-sm text-dark/80">Secondary Slide</h3>
    <div id="secondarySlide" class="w-full border-t-2 py-2">
      <span class="text-sm text-softDark">No data yet</span>
    </div>
  </div>

</section>

<?php
require_once 'includes/footer.php';
?>