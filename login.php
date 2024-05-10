<?php 

  session_start();
  include('middleware/redirect-user.php');
  include('includes/header.php');

  $email = $_SESSION['login_email_data'] ?? null;

  unset($_SESSION['login_email_data']);

?>
    
    <section 
    class=" flex flex-col items-center justify-center w-full h-full"
    >
      <?php include('includes/message.php')?>
      <div class="bg-white shadow-xl mx-16 sm:m-8 p-2 pb-5 rounded-sm text-softDark flex w-full max-w-[30rem]">
        
        <form action="controller/login-code.php" method="post" class="m-6 mx-8 sm:m-2 sm:mx-4 w-full h-full">
          <h1 class="text-center text-[2rem] xs:text-2xl font-semibold border-b-2 pb-2 mb-6">Login</h1>
          <div class="px-7 text-[.9rem] flex flex-col gap-5">
            <div class="flex flex-col">
              <label class="font-bold">Email:</label>
              <input type="Email" name="email" value="<?=$email?>" placeholder="Enter your email" class="shadow-md p-3 outline-none text-[.9rem] rounded-md">
            </div>

            <div class="flex flex-col">
              <label class="font-bold">Password:</label>
              <input type="password" name="password" placeholder="Enter your password" class="shadow-md p-3 outline-none rounded-md">
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
  
  include('includes/footer.php')
  
  ?>