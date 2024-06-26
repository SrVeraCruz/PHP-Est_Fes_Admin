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
    <h1 class=" text-[2rem] text-dark/75 font-semibold">Events</h1>
    <ul class=" text-dark/65 flex gap-1">
      <li>
        <a href="index.php">Dashboard</a>
      </li>/
      <li>
        <a href="event-view.php">Event</a>
      </li>/
      <li>
        <a href="#">Add</a>
      </li>
    </ul>
  </div>

  <div class="text-softDark flex flex-col w-full">
    <div class="flex w-full justify-end">
      <a 
        href="event-view.php" 
        class="btn btn-default !bg-highlight"
      >
        Back
      </a>
    </div>

    <form id="formAddEvent" class="w-full h-full">

      <div class="px-7 text-[.9rem] flex flex-col gap-5">

        <div class="flex flex-col w-full">
          <label class="font-bold">Event title</label>
          <input 
            type="text" 
            name="title" 
            placeholder="e.g: L'étudiant face au marché de l'emploi" 
            class="shadow-md p-3 outline-none 
              text-[.9rem] rounded-md
            "
          />
        </div>
        <div class="flex flex-col w-full">
          <label class="font-bold">Meta title</label>
          <input 
            type="text" 
            name="meta_title" 
            placeholder="e.g: Event | Est - Fes" 
            class="shadow-md p-3 outline-none rounded-md"
          />
        </div>
        
        <div class="flex sm:flex-col gap-2">
          <div class="flex flex-col w-full">
            <label class="font-bold">Date</label>
            <input 
              type="date" 
              name="date" 
              class="shadow-md p-3 outline-none 
                text-[.9rem] rounded-md
              "
            />
          </div>
          <div class="flex flex-col w-full">
            <label class="font-bold">Location</label>
            <input 
              type="text" 
              name="location" 
              placeholder="e.g: Salle D11-D12" 
              class="shadow-md p-3 outline-none rounded-md"
            />
          </div>
        </div>

        <div class="flex sm:flex-col gap-2">
          <div class="flex flex-col w-full">
            <label class="font-bold">start</label>
            <input 
              type="time" 
              id="timeStart"
              name="time_start" 
              class="shadow-md p-3 outline-none rounded-md"
            />
          </div>
          <div class="flex flex-col w-full">
            <label class="font-bold">end</label>
            <input 
              type="time" 
              id="timeEnd"
              name="time_end" 
              class="shadow-md p-3 outline-none rounded-md"
            />
          </div>
        </div>

        <div class="mt-2 flex flex-col gap-4">
          <h2 class="text-center -mb-2 text-lg font-semibold ">
            Page Content
          </h2>
          <div 
            class="border-b-2 border-t-2 py-3 flex flex-col gap-2"
          >
            <div id="items">
              <div id="item">
                <div id="element">
                  <label class="font-bold">Description</label>
                  <textarea id="contentPage" name="content" class="summernote"></textarea>
                </div>
              </div>
            </div>

          </div>
          <div class="flex flex-col w-full">
            <label class="font-bold">File</label>
            <input 
              type="file" 
              name="file" 
              class="shadow-md p-3 outline-none rounded-md"
            />
          </div>
        </div>

        <div class="flex flex-col items-start">
          <label class="font-bold">Status</label>
          <div class="flex items-center gap-2">
            <input type="checkbox" name="status" class="w-auto">
            (cheked=hidden, unchecked=visible)
          </div>
        </div>

        <button 
          type="submit" 
          name="update_event_btn"
          class="bg-primary p-3 rounded-md text-white 
            uppercase mt-3 sm:mt-0 font-semibold 
            hover:bg-primary/90 transition duration-200 
            ease-in-out sm:text-xs
          " 
        >
          Add event
        </button>

      </div>
    </form>
  </div>
</section>

<?php
require_once 'includes/footer.php';
?>