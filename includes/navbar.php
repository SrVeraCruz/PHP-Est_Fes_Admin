<header class="sticky top-0 left-0 text-dark shadow-md z-[60]">
  <nav class="h-[4.7rem] p-4 py-3 flex justify-between bg-highlight items-center">
    <div class="">
      <h2 class="text-primary text-2xl font-semibold">
        <a href="<?= isset($_SESSION['auth']) ? 'index.php' : '#' ?>">Est Fes - Admin</a>
      </h2>
    </div>

    <div class="flex items-center gap-4">
      <?php if (isset($_SESSION['auth'])) : ?>
        <div class="relative">
          <div class="h-[2.7rem] w-[2.7rem] shadow-lg border border-primary rounded-full bg-light cursor-pointer overflow-hidden group">
            <?php if ($_SESSION['auth_user']['user_img'] != null) : ?>
              <a href="setting.php">
                <img class="h-full w-full object-cover" src="uploads/users/<?= $_SESSION['auth_user']['user_img'] ?>" alt="<?= $_SESSION['auth_user']['user_name'] ?>">
              </a>
            <?php else : ?>
              <a href="setting.php">
                <img class="h-full w-full object-cover" src="assets/img/user.png" alt="profil">
              </a>
            <?php endif ?>
            <ul class="w-auto invisible opacity-0 absolute -bottom-16 -left-32 bg-light rounded-md shadow-md group-hover:opacity-100 group-hover:visible transition duration-200 ease-in-out text-primary text-sm">
              <li class="border-b-2 p-1 px-5 ">Logged in as:</li>
              <li class="p-1 px-5 overflow-hidden text-ellipsis text-nowrap w-32 font-semibold"><?= $_SESSION['auth_user']['user_name'] ?></li>
            </ul>
          </div>
        </div>
        <button id="navbar-hamburguer" class="flex-col gap-1.5 hidden md:flex">
          <span class="inline-block w-6 h-0.5 rounded-md bg-dark"></span>
          <span class="inline-block w-6 h-0.5 rounded-md bg-dark"></span>
          <span class="inline-block w-6 h-0.5 rounded-md bg-dark"></span>
        </button>
      <?php endif ?>
    </div>

  </nav>
</header>