<?php 

  include('middleware/authentication.php');
  include('includes/header.php');

?>

  <?php include('includes/message.php')?>

  <section 
    class="bg-white shadow-md p-4 pb-8 flex flex-col gap-4 rounded-sm "
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
      </ul>
    </div>

    <!-- <div id="table-wrapper">
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
            $item_query = "SELECT * FROM items";
            $item_result = mysqli_query($con,$item_query);
            if(mysqli_num_rows($item_result) > 0) {
              ?>
                <?php foreach($item_result as $item) : ?>
                  <tr>
                    <td><?=$item['name']?></td>
                    <td><?=$item['category_id']?></td>
                    <td><?=$item['status'] === '1' ? 'Hidden' : 'Visible'?></td>
                    <td class="flex gap-1.5">
                      <a href="#" class="btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                          <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                        </svg>
                        edit
                      </a>
                      <a href="#" class="btn-red">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                          <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                        </svg>
                        delete
                      </a>
                    </td>
                  </tr>
                <?php endforeach ?>
              <?php
            } else {
              ?>
                <td colspan="4">No Record Found</td>
              <?php
            }
          ?>
          
        </tbody>
      </table>
    </div> -->

  </section>
  
<?php 
include('includes/footer.php')

?>