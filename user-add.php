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
    <h1 class=" text-[2rem] text-dark/75  font-semibold">Users</h1>
    <ul class=" text-dark/65 flex gap-1">
      <li>
        <a href="index.php">Dashboard</a>
      </li>/
      <li>
        <a href="user-view.php">User</a>
      </li>/
      <li>
        <a href="#">Add</a>
      </li>
    </ul>
  </div>

  <div class="text-softDark flex flex-col w-full">
    <div class="flex w-full justify-end">
      <a 
        href="user-view.php" 
        class="btn btn-default !bg-highlight"
      >
        Back
      </a>
    </div>

    <form 
      id="formAddUser"
      class="m-6 sm:m-2 sm:mx-4 mx-8 h-full"
    >
      <h1 
        class="text-center text-[2rem] xs:text-2xl 
          font-semibold border-b-2 pb-2 mb-6
        "
      >
        Add Admin/User
      </h1>
      <div class="px-7 text-[.9rem] flex flex-col gap-5">
        <div class="flex flex-col">
          <label class="font-bold">First-name:</label>
          <input 
            type="text" 
            name="fname" 
            placeholder="Enter your first name" 
            class="shadow-md p-3 outline-none 
              text-[.9rem] rounded-md
            "
          />
        </div>
        <div class="flex flex-col">
          <label class="font-bold">Last-name:</label>
          <input 
            type="text" 
            name="lname" 
            placeholder="Enter your last name" 
            class="shadow-md p-3 outline-none 
              text-[.9rem] rounded-md
            "
          />
        </div>
        <div class="flex flex-col">
          <label class="font-bold">Email:</label>
          <input 
            type="email" 
            name="email" 
            autocomplete="email" 
            placeholder="Enter your email" 
            class="shadow-md p-3 outline-none 
            text-[.9rem] rounded-md"
          />
        </div>
        <div class="flex flex-col">
          <label class="font-bold">Password:</label>
          <input 
            type="password" 
            name="password" 
            autocomplete="new-password" 
            placeholder="Enter your password" 
            class="shadow-md p-3 outline-none rounded-md"
          />
        </div>
        <div class="flex flex-col">
          <label class="font-bold">Confirm Password:</label>
          <input 
            type="password" 
            name="cpassword" 
            autocomplete="new-password" 
            placeholder="Confirm your password" 
            class="shadow-md p-3 outline-none rounded-md"
          />
        </div>
        <div 
          class="flex items-center justify-between 
            sm:flex-col sm:items-start
          "
        >
          <label class="font-bold">Birth:</label>
          <input 
            type="Date" 
            name="birth" 
            placeholder="Enter your birth" 
            class="flex-[0.6] sm:w-full shadow-md p-3 
              outline-none text-[.9rem] rounded-md
            "
          />
        </div>
        <div class="flex justify-between gap-2">
          <div class="flex flex-col gap-2">
            <label class="font-bold">Sex:</label>
            <div class="flex flex-col">
              <label>
                <input 
                  type="radio" 
                  name="sex" 
                  value="m" 
                  class="w-auto"
                />
                Male
              </label>
              <label>
                <input 
                  type="radio" 
                  name="sex" 
                  value="f" 
                  class="w-auto"
                />
                Female
              </label>
            </div>
          </div>
          <div class="flex flex-col items-start">
            <label class="font-bold">Status:</label>
            <input type="checkbox" name="status" class="w-auto">
          </div>
          <div class="flex flex-col">
            <label class="font-bold">Role as:</label>
            <select 
              name="role_as" 
              class="shadow-md p-3 outline-none rounded-md"
            >
              <option value="">--Select Role--</option>
              <option value="1">Admin</option>
              <option value="0">User</option>
            </select>
          </div>
        </div>
        <div class="flex flex-col">
          <label class="font-bold">Avatar:</label>
          <input 
            type="file" 
            name="avatar" 
            class="shadow-md p-3 outline-none rounded-md"
          />
        </div>

        <button 
          type="submit" 
          class="bg-primary p-3 rounded-md text-white 
            uppercase mt-3 sm:mt-0 font-semibold 
            hover:bg-primary/90 transition duration-200
            ease-in-out sm:text-xs
          "
          name="add_user_btn"
        >
          Add User
        </button>

      </div>

    </form>

  </div>

</section>

<?php
require_once 'includes/footer.php';
?>