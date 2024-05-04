<header class="relative text-dark shadow-md">
  <nav class="h-[4.7rem] p-4 py-3 flex justify-between bg-highlight items-center">
    <div class="">
      <h2 class="text-primary text-2xl font-semibold">
        <a href="index.php">Est Fes - Admin</a>
      </h2>
    </div>

    <?php if(isset($_SESSION['auth'])) : ?>
      <div class="relative">
        <div 
          class="h-[2.7rem] w-[2.7rem] shadow-lg border border-primary rounded-full bg-light cursor-pointer overflow-hidden group"
        >
          <?php if($_SESSION['auth_user']['user_img'] != null) : ?>
            <img class="h-full w-full object-cover" src="uploads/users/<?=$_SESSION['auth_user']['user_img']?>" alt="<?=$_SESSION['auth_user']['user_name']?>">
          <?php else : ?>
            <img class="h-full w-full object-cover" src="assets/img/user.png" alt="profil">
          <?php endif ?>
          <ul 
            class="w-auto invisible opacity-0 absolute -bottom-16 -left-32 bg-light rounded-md shadow-md group-hover:opacity-100 group-hover:visible transition duration-200 ease-in-out text-primary text-sm"
          >
            <li class="border-b-2 p-1 px-5 ">Logged in as:</li>
            <li class="p-1 px-5 overflow-hidden text-ellipsis text-nowrap w-32 font-semibold">Vera Cruz Dúdú</li>
          </ul>
        </div>
      </div>
    <?php endif ?>
  </nav>
</header>