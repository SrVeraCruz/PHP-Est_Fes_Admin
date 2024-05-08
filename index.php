<?php 

  include('middleware/authentication.php');
  include('includes/header.php');

?>

  <?php include('includes/message.php')?>

  <section 
    class="bg-white shadow-md p-4 pb-8 flex flex-col gap-4 rounded-sm"
  >
    <div>
      <h1 class=" text-[2rem] text-dark/75  font-semibold">Est-Admin</h1>
      <ul class=" text-dark/65 flex gap-1">
        <li>
          <a href="index.php">Dashboard</a>
        </li>
      </ul>
    </div>

    <div class="grid grid-cols-4 xl:grid-cols-2 md:grid-cols-1 gap-5">
      <div class="p-4 shadow-md bg-highlight/40 rounded-md min-h-28 hover:bg-highlight/75 hover:shadow-lg transition duration-200 ease-in-out hover:scale-[1.03] ">
        <a href="user-view.php">
          <div>
            <h5 class=" text-base font-medium text-dark/80">Total Users</h5>
            <?php 
              $user_query = "SELECT id FROM users";
              $user_result = mysqli_query($con,$user_query);

              if($user_qte = mysqli_num_rows($user_result)) {
                ?>
                  <span class="text-dark/75 font-semibold text-2xl">
                    <?=$user_qte?>
                  </span>
                <?php
              } else {
                ?>
                  <span class="text-dark/75 font-semibold text-2xl">0</span>
                <?php
              }             
            ?>
          </div>
        </a>
      </div>
      <div class="p-4 shadow-md bg-highlight/40 rounded-md min-h-28 hover:bg-highlight/75 hover:shadow-lg transition duration-200 ease-in-out hover:scale-105 ">
        <a href="user-view.php">
          <div>
            <h5 class=" text-base font-medium text-dark/80">Total Blocked Users</h5>
            <?php 
              $b_user_query = "SELECT id FROM users WHERE status = '1'";
              $b_user_result = mysqli_query($con,$b_user_query);

              if($b_user_qte = mysqli_num_rows($b_user_result)) {
                ?>
                  <span class="text-dark/75 font-semibold text-2xl">
                    <?=$b_user_qte?>
                  </span>
                <?php
              } else {
                ?>
                  <span class="text-dark/75 font-semibold text-2xl">0</span>
                <?php
              }             
            ?>
          </div>
        </a>
      </div>
      <div class="p-4 shadow-md bg-highlight/40 rounded-md min-h-28 hover:bg-highlight/75 hover:shadow-lg transition duration-200 ease-in-out hover:scale-105 ">
        <a href="category-view.php">
          <div>
            <h5 class=" text-base font-medium text-dark/80">Total Categories</h5>
            <?php 
              $category_query = "SELECT id FROM users";
              $category_result = mysqli_query($con,$category_query);

              if($category_qte = mysqli_num_rows($category_result)) {
                ?>
                  <span class="text-dark/75 font-semibold text-2xl">
                    <?=$category_qte?>
                  </span>
                <?php
              } else {
                ?>
                  <span class="text-dark/75 font-semibold text-2xl">0</span>
                <?php
              }             
            ?>
          </div>
        </a>
      </div>
      <div class="p-4 shadow-md bg-highlight/40 rounded-md min-h-28 hover:bg-highlight/75 hover:shadow-lg transition duration-200 ease-in-out hover:scale-105 ">
      <a href="item-view.php">
        <div>
          <h5 class=" text-base font-medium text-dark/80">Total Items</h5>
          <span class="text-dark/75 font-semibold text-2xl">0</span>
        </div>
      </a>
    </div>
  </section>
    
  <?php 
  
  include('includes/footer.php')
  
  ?>