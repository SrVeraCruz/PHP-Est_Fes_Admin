<?php 

  include('middleware/authentication.php');
  include('includes/header.php');

  if(isset($_GET['id'])) {
    $user_id = $_GET['id'];

  } else {
    $_SESSION['message-warning'] = 'User invalid. Please Select the user to edit';
    echo '<script>window.location.href = "user-view.php";</script>';
    exit();
  }

  $user_query = "SELECT * FROM users WHERE id = '$user_id' AND role_as != '2' LIMIT 1";
  $user_result = mysqli_query($con,$user_query);

  if(!(mysqli_num_rows($user_result))) {
    $_SESSION['message-warning'] = 'User invalid. Please Select the user to edit';
    echo '<script>window.location.href = "user-view.php";</script>';
    exit();
  }

  $user_data = mysqli_fetch_assoc($user_result);

  $fname = $user_data['fname'] ?? null;
  $lname = $user_data['lname'] ?? null;
  $email = $user_data['email'] ?? null;
  $password = $user_data['password'] ?? null;
  $birth = $user_data['birth'] ?? null;
  $sex = $user_data['sex'] ?? null;
  $status = $user_data['status'] ?? null;
  $role = $user_data['role_as'] ?? null;
  $avatar = $user_data['avatar'] ?? null;
  
  if(isset($_SESSION['edit_user_data'])) {
    $fname = $_SESSION['edit_user_data']['fname'] ?? null;
    $lname = $_SESSION['edit_user_data']['lname'] ?? null;
    $email = $_SESSION['edit_user_data']['email'] ?? null;
    $password = $_SESSION['edit_user_data']['password'] ?? null;
    $birth = $_SESSION['edit_user_data']['birth'] ?? null;
    $sex = $_SESSION['edit_user_data']['sex'] ?? null;
    $status = $_SESSION['edit_user_data']['status'] ?? null;
    $role = $_SESSION['edit_user_data']['role_as'] ?? null;
    $avatar = $_SESSION['edit_user_data']['avatar'] ?? null;

    unset($_SESSION['edit_user_data']);
  }

?>

  <?php include('includes/message.php')?>

  <section 
    class="bg-white shadow-md p-4 pb-8 flex flex-col gap-4 rounded-md"
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
          <a href="#">Edit</a>
        </li>
      </ul>
    </div>

    <div class="text-softDark flex w-full mt-2">
      
    <form action="controller/user-code.php" method="post" enctype="multipart/form-data" class="m-6 sm:m-2 sm:mx-4 mx-8 w-full h-full">
      <h1 class="text-center text-[2rem] xs:text-2xl font-semibold border-b-2 pb-2 mb-6">Edit <?=$role === '1' ? 'Admin' : 'User'?></h1>
      <input type="hidden" name="user_id" value="<?=$user_id?>" placeholder="Enter your first name" class="shadow-md p-3 outline-none text-[.9rem] rounded-md">
        <div class="px-7 text-[.9rem] flex flex-col gap-5">
          <div class="flex flex-col">
            <label class="font-bold">First-name:</label>
            <input type="text" name="fname" value="<?=$fname?>" placeholder="Enter your first name" class="shadow-md p-3 outline-none text-[.9rem] rounded-md">
          </div>
          <div class="flex flex-col">
            <label class="font-bold">Last-name:</label>
            <input type="text" name="lname" value="<?=$lname?>" placeholder="Enter your last name" class="shadow-md p-3 outline-none text-[.9rem] rounded-md">
          </div>
          <div class="flex flex-col">
            <label class="font-bold">Email:</label>
            <input type="email" name="email" value="<?=$email?>" placeholder="Enter your email" class="shadow-md p-3 outline-none text-[.9rem] rounded-md">
          </div>
          <div class="flex flex-col">
            <label class="font-bold">Password:</label>
            <input type="password" name="password" value="<?=$password?>" placeholder="Enter your password" class="shadow-md p-3 outline-none rounded-md">
          </div>
          <div class="flex items-center justify-between sm:flex-col sm:items-start">
            <label class="font-bold">Birth:</label>
            <input type="Date" name="birth" value="<?=$birth?>" placeholder="Enter your birth" class="flex-[0.6] sm:w-full shadow-md p-3 outline-none text-[.9rem] rounded-md">
          </div>
          <div class="flex justify-between gap-2">
            <div class="flex flex-col gap-2">
              <label class="font-bold">Sex:</label>
              <div class="flex flex-col">
                <label>
                  <input type="radio" name="sex" value="m" <?=$sex === 'm' ? 'checked' : ''?> class="w-auto">
                  Male
                </label>
                <label>
                  <input type="radio" name="sex" value="f" <?=$sex === 'f' ? 'checked' : ''?> class="w-auto">
                  Female
                </label>
              </div>
            </div>
            <div class="flex flex-col items-start">
              <label class="font-bold">Status:</label>
              <input type="checkbox" name="status" <?=$status === '1' ? 'checked' : ''?> class="w-auto">
            </div>
            <div class="flex flex-col">
              <label class="font-bold">Role as:</label>
              <select name="role_as" class="shadow-md p-3 outline-none rounded-md">
                <option value="">--Select Role--</option>
                <option value="1" <?=$role === '1' ? 'selected' : ''?> >Admin</option>
                <option value="0" <?=$role === '0' ? 'selected' : ''?> >User</option>
              </select>
            </div>
          </div>
          <div class="flex flex-col">
            <label class="font-bold">Avatar:</label>
            <input type="hidden" name="avatar_old_name" value="<?=$avatar?>" class="shadow-md p-3 outline-none rounded-md">
            <input type="file" name="avatar" class="shadow-md p-3 outline-none rounded-md">
          </div>

          <button type="submit" class="bg-primary p-3 rounded-md text-white uppercase mt-3 sm:mt-0 font-semibold hover:bg-primary/90 transition duration-200 ease-in-out sm:text-xs" name="edit_user_btn">Update <?=$role === '1' ? 'Admin' : 'User'?></button>
        
        </div>

      </form>

    </div>

  </section>
  
<?php 

include('includes/footer.php')

?>