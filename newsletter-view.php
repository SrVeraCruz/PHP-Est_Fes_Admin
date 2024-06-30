<?php
require_once 'middleware/authentication.php';
require_once 'includes/header.php';
?>

<section 
  class="bg-white shadow-md p-4 pb-8
    flex flex-col gap-5 rounded-md
  "
>

  <div>
    <h1 class=" text-[2rem] text-dark/75 font-semibold">Newsletter</h1>
    <ul id="pageIndicator" class=" text-dark/65 flex gap-1">
      <li>
        <a href="index.php">Dashboard</a>
      </li>/
      <li>
        <a href="#">Subscription</a>
      </li>/
    </ul>
  </div>

  <div 
    id="confirmDelBox" 
    class="fixed top-[50%] translate-y-[-50%] 
      left-[50%] translate-x-[-50%] bg-white 
      p-20 px-14 rounded-2xl border border-gray-200 
      shadow-lg flex-col gap-4 items-center 
      justify-center text-center transition-all 
      duration-200 ease-in-out z-[61] hidden
    "
  >

    <h2>
      Do you want to unsubscribe the user
      <span id="confirmDelTitle" class="font-semibold">User email</span>
    </h2>
    <div class="flex gap-2">
      <button id="cancelDelete" class="btn-primary">
        No
      </button>
      <form id="FormConfirmDelete">
        <button 
          id="confirmDelId"
          name="delete_id"
          type="submit" 
          class="btn-red"
        >
          Yes
        </button>
      </form>
    </div>
  </div>

  <div 
    id="sideOutDelete" 
    class="min-w-full min-h-screen bg-dark/50 
      fixed top-0 left-0 z-[60] cursor-pointer hidden
    "
  ></div>

  <div>
    <form id="formSub" class="flex flex-col gap-3">
      <div class="flex flex-col gap-4">
        <div>
          <label id="editLabel">
            User email
          </label>
          <input 
            type="email" 
            id="subEmail" 
            name="email" 
            placeholder="e.g: user@gmail.com"

          />
        </div>

        <div 
          class="flex items-center gap-2 
            text-sm text-softDark
          "
        >
          <input 
            type="checkbox" 
            id="subStatus" 
            name="status" 
            class="w-auto"
          />
          (cheked=inactive, unchecked=active)
        </div>
      </div>
      <div>
        <button 
          type="button" 
          id="subBtnCancel" 
          class="btn-default hidden"
        >
          Cancel
        </button>

        <button 
          type="submit" 
          id="subBtnSave" 
          class="btn-primary self-start"
        >
          Subscribe
        </button>
      </div>
    </form>
  </div>

  <div id="table-wrapper">
    <table id="myDataTable">
      <thead>
        <tr>
          <th>Email</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody id="tableSub">

      </tbody>
    </table>
  </div>

</section>

<?php
require_once 'includes/footer.php';
?>