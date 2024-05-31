<?php
require_once 'middleware/redirect-user.php';
require_once 'includes/header.php';
?>

<section class=" flex flex-col items-center justify-center w-full h-full px-16 sm:px-8">

  <?php require_once 'includes/message.php' ?>

  <div class="bg-white shadow-xl sm:m-4 p-2 pb-5 rounded-md text-softDark flex w-full max-w-[30rem]">

    <form id="formUserRegister" class="m-6 sm:m-2 sm:mx-4 mx-8 w-full h-full">
      <h1 class="text-center text-[2rem] xs:text-2xl font-semibold border-b-2 pb-2 mb-6">Register</h1>
      <div class="px-7 text-[.9rem] flex flex-col gap-5">
        <div class="flex flex-col">
          <label class="font-bold">First-name:</label>
          <input type="text" name="fname" placeholder="Enter your first name" class="shadow-md p-3 outline-none text-[.9rem] rounded-md">
        </div>
        <div class="flex flex-col">
          <label class="font-bold">Last-name:</label>
          <input type="text" name="lname" placeholder="Enter your last name" class="shadow-md p-3 outline-none text-[.9rem] rounded-md">
        </div>
        <div class="flex flex-col">
          <label class="font-bold">Email:</label>
          <input type="email" name="email" autocomplete="email" placeholder="Enter your email" class="shadow-md p-3 outline-none text-[.9rem] rounded-md">
        </div>
        <div class="flex flex-col">
          <label class="font-bold">Password:</label>
          <input type="password" name="password" autocomplete="new-password" placeholder="Enter your password" class="shadow-md p-3 outline-none rounded-md">
        </div>
        <div class="flex flex-col">
          <label class="font-bold">Confirm Password:</label>
          <input type="password" name="cpassword" autocomplete="new-password" placeholder="Confirm your password" class="shadow-md p-3 outline-none rounded-md">
        </div>
        <div class="flex items-center justify-between sm:flex-col sm:items-start">
          <label class="font-bold">Birth:</label>
          <input type="Date" name="birth" placeholder="Enter your birth" class="flex-[0.6] sm:w-full shadow-md p-3 outline-none text-[.9rem] rounded-md">
        </div>
        <div class="flex flex-col gap-2">
          <label class="font-bold">Sex:</label>
          <div class="flex flex-col">
            <label>
              <input type="radio" name="sex" value="m" class="w-auto">
              Male
            </label>
            <label>
              <input type="radio" name="sex" value="f" class="w-auto">
              Female
            </label>
          </div>
        </div>

        <div class="flex flex-col">
          <label class="font-bold">Avatar:</label>
          <input type="file" name="avatar" class="shadow-md p-3 outline-none rounded-md">
        </div>

        <button type="submit" class="bg-primary p-3 rounded-md text-white uppercase mt-3 sm:mt-0 font-semibold hover:bg-primary/90 transition duration-200 ease-in-out sm:text-xs" name="register_btn">Register now</button>

        <div>
          <span>
            Alread have an account?
            <a href="login.php" class="font-bold">Sign In</a>
          </span>
        </div>
      </div>

    </form>

  </div>
</section>

<?php
require_once 'includes/footer.php';
?>