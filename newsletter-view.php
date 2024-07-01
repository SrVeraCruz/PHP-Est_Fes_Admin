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
    <h1 class=" text-[2rem] text-dark/75 font-semibold">
      Newsletter
    </h1>
    <ul id="pageIndicator" class=" text-dark/65 flex gap-1">
      <li>
        <a href="index.php">Dashboard</a>
      </li>/
      <li>
        <a href="#">Subscription</a>
      </li>/
    </ul>
  </div>

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