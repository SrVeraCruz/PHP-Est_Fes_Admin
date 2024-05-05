<?php 

  include('middleware/authentication.php');
  include('includes/header.php')

?>

  <section 
    class="bg-white shadow-md p-4 pb-8 flex flex-col gap-4 rounded-sm"
  >
    <div>
      <h1 class=" text-[2rem] text-dark/75  font-semibold">Categories</h1>
      <ul class=" text-dark/65 flex gap-1">
        <li>
          <a href="index.php">Dashboard</a>
        </li>/
        <li>
          <a href="category-view.php">Category</a>
        </li>/
        <li>
          <a href="#">Add</a>
        </li>
      </ul>
    </div>

    <div class="text-softDark flex w-full mt-2">
      
      <form action="controller/register-code.php" method="post" enctype="multipart/form-data" class="w-full h-full">

        <div class="px-7 text-[.9rem] flex flex-col gap-5">
          <div class="flex flex-col">
            <label class="font-bold">Name:</label>
            <input type="text" name="name" placeholder="e.g: Déppertements" class="shadow-md p-3 outline-none text-[.9rem] rounded-md">
          </div>
          <div class="flex flex-col">
            <label class="font-bold">Slug(URL):</label>
            <input type="text" name="slug" placeholder="e.g: deppertements" class="shadow-md p-3 outline-none text-[.9rem] rounded-md">
          </div>
          <div class="flex flex-col">
            <label class="font-bold">Description:</label>
            <textarea name="description" rows="4" class="shadow-md p-3 outline-none text-[.9rem] rounded-md" ></textarea>
          </div>
          <div class="flex flex-col">
            <label class="font-bold">Meta Title:</label>
            <input type="text" name="meta_title" placeholder="e.g: Departement | Est-Fes" class="shadow-md p-3 outline-none rounded-md">
          </div>
          <div class="flex flex-col">
            <label class="font-bold">Meta_Description:</label>
            <textarea name="meta_description" rows="4" class="shadow-md p-3 outline-none text-[.9rem] rounded-md" ></textarea>
          </div>
          <div class="flex items-center justify-between sm:flex-col sm:items-start">
            <label class="font-bold">Birth:</label>
            <input type="Date" name="birth" placeholder="Enter your birth" class="flex-[0.6] sm:w-full shadow-md p-3 outline-none text-[.9rem] rounded-md">
          </div>
          <div class="flex flex-col gap-2">
            <label class="font-bold">Sex:</label>
            <div class="flex flex-col">
              <label>
                <input type="radio" name="sex" value="m" class="shadow-md p-3 outline-none text-[.9rem] rounded-md">
                Male
              </label>
              <label>
                <input type="radio" name="sex" value="f" class="shadow-md p-3 outline-none text-[.9rem] rounded-md">
                Female
              </label>
            </div>
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

include('includes/footer.php')

?>