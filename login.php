<?php
require_once 'middleware/redirect-user.php';
require_once 'includes/header.php';
?>

<section class=" flex flex-col items-center justify-center w-full h-full px-16 sm:px-8">

  <?php require_once 'includes/message.php' ?>

  <div class="bg-white shadow-xl sm:m-4 p-2 pb-5 rounded-lg text-softDark flex w-full max-w-[30rem]">

    <form id="formUserLogin" class="m-4 mx-8 sm:m-2 sm:mx-4 w-full h-full">
      <h1 class="text-center text-[2rem] xs:text-2xl font-semibold border-b-2 pb-2 mb-6">Login</h1>
      <div class="px-7 text-[.9rem] flex flex-col gap-5">
        <div class="flex flex-col">
          <label class="font-bold">Email:</label>
          <input type="Email" name="email" placeholder="Enter your email" class="shadow-md p-3 outline-none text-[.9rem] rounded-md">
        </div>

        <div class="flex flex-col">
          <label class="font-bold">Password:</label>
          <input type="password" name="password" autocomplete="new-password" placeholder="Enter your password" class="shadow-md p-3 outline-none rounded-md">
        </div>

        <button type="submit" class="bg-primary p-3 rounded-md text-white uppercase mt-3 font-semibold hover:bg-primary/90 transition duration-200 ease-in-out sm:text-xs" name="login_btn">Login now</button>

        <div>
          <span>
            Don't have an account?
            <a href="register.php" class="font-bold">Sign Up</a>
          </span>
        </div>
      </div>
    </form>

  </div>
</section>

<?php
require_once 'includes/footer.php';
?>