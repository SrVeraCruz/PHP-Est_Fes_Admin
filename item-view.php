<?php 

  include('middleware/authentication.php');
  include('includes/header.php');

  $confirm_delete = false;
  if(isset($_SESSION['del-item-data'])) {
    $confirm_delete = true;
  }

  $del_item_id = $_SESSION['del-item-data']['id'] ?? null;
  $del_item_title = $_SESSION['del-item-data']['title'] ?? null;

  unset($_SESSION['del-item-data']);

?>

  <?php include('includes/message.php')?>

  <section 
    class="bg-white shadow-md p-4 pb-8 flex flex-col gap-4 rounded-md "
  >
    <div>
      <h1 class=" text-[2rem] text-dark/75  font-semibold">Items</h1>
      <ul class=" text-dark/65 flex gap-1">
        <li>
          <a href="index.php">Dashboard</a>
        </li>/
        <li>
          <a href="#">Item</a>
        </li>
        <?php if($confirm_delete) : ?>
          /<li>
            <a href="#">Delete</a>
          </li>
        <?php endif ?>
      </ul>
    </div>

    <?php if($confirm_delete) : ?>
    <div id="deleteBox" class="fixed top-[50%] translate-y-[-50%] left-[50%] translate-x-[-50%] bg-white p-20 px-14 rounded-2xl border border-gray-200 shadow-lg flex flex-col gap-4 items-center justify-center text-center transition-all duration-200 ease-in-out z-[61]">
      
      <h2>
        Do you want to delete the item
        <span class="font-semibold"><?=$del_item_title?></span>
      </h2>
      <div class="flex gap-2">
        <button onclick="handleCancel()" class="btn-primary">
          No
        </button>
        <form action="controller/item-code.php" method="post">
          <button name="delete_item_btn" value="<?=$del_item_id?>" class="btn-red">
            Yes
          </button>
        </form>
      </div>
    </div>

    <div class="min-w-full min-h-screen bg-dark/50 fixed top-0 left-0 z-[60] cursor-pointer" onclick="handleCancel()">
      
    </div>
    <?php endif ?>

    <div  class="flex w-full justify-end">
      <a href="item-add.php" class="btn btn-primary">
        Add Item
      </a>
    </div>

    <div id="table-wrapper">
      <table id="basic">
        <thead>
          <tr>
            <th>Name</th>
            <th>Category</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <?php 
            $item_query = "SELECT it.id, it.title, it.status, ct.name AS cname 
            FROM items it JOIN categories ct ON it.category_id = ct.id";
            $item_result = mysqli_query($con,$item_query);
            if(mysqli_num_rows($item_result) > 0) {
              ?>
                <?php foreach($item_result as $item) : ?>
                  <tr>
                    <td>
                      <p class="text-nowrap max-w-44 text-ellipsis overflow-hidden">
                        <?=$item['title']?>
                      </p>
                    </td>
                    <td><?=$item['cname']?></td>
                    <td><?=$item['status'] === '1' ? 'Hidden' : 'Visible'?></td>
                    <td class="flex gap-1.5">
                      <a href="item-edit.php?id=<?=$item['id']?>" class="btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                          <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                        </svg>
                        edit
                      </a>
                      <form action="controller/item-code.php" method="post">
                        <button type="submit" name="confirm_del_item_btn" value="<?=$item['id']?>" class="btn-red">
                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                          </svg>
                          delete
                        </button>
                      </form>
                    </td>
                  </tr>
                <?php endforeach ?>
              <?php
            } else {
              ?>
                <td colspan="3">No Record Found</td>
              <?php
            }
          ?>
          
        </tbody>
      </table>
    </div>

  </section>

  <script>
    const handleCancel = () => {
      location.reload();
    }
  </script>
  
<?php 
include('includes/footer.php')

?>