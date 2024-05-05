<?php 

  include('middleware/authentication.php');
  include('includes/header.php');

  $editing = false;
  if(isset($_SESSION['category-data'])) {
    $editing = true;
  }
  
  $category_name = $_SESSION['category-data']['name'] ?? null;
  $parent_category_id = $_SESSION['category-data']['parent_category_id'] ?? null;

  unset($_SESSION['category-data']);
?>

  <?php include('includes/message.php')?>

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
          <a href="#">Category</a>
        </li>
      </ul>
    </div>

    <div>
      <form action="controller/category-code.php" method="post" class="flex flex-col gap-2">
        <div>
          <label>
            <?=$editing ? 'Edit category ' . $category_name : 'New category name'?>
          </label>
          <div class="flex gap-1.5">
            <input type="text" name="category_name" value="<?=$category_name && $editing ? $category_name : '' ?>" placeholder="Category name">
            <select name="parent_category_id">
              <option value="">No parent category</option>
              <?php 
                $category_query = "SELECT * FROM categories";
                $category_result = mysqli_query($con,$category_query);

                if(mysqli_num_rows($category_result) > 0) {
                  ?>
                    <?php foreach($category_result as $category): ?>
                      <option value="<?=$category['id']?>" <?=$parent_category_id === $category['id'] && $editing ? 'selected' : ''?> ><?=$category['name']?></option>
                    <?php endforeach ?>
                  <?php
                }
              ?>
              
            </select>
          </div>
        </div>
        <div>
          <?php 
            if($editing) {
              ?>
                <button type="button" class="btn-default">Cancel</button>
                <button 
                  type="submit" 
                  name="edit_category_btn" 
                  class="btn-primary self-start"
                >
                  Update
                </button>
                
              <?php
            } else {
              ?>
                <button 
                  type="submit" 
                  name="add_category_btn" 
                  class="btn-primary self-start"
                >
                  Save
                </button>
              <?php
            }
          ?>
        </div>
      </form>
    </div>

    <div>
      <table id="basic">
        <thead>
          <tr>
            <th>Category</th>
            <th>Parent</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <?php 
            $category_query = "SELECT c1.*, c2.name AS parent_name FROM categories c1 
            LEFT JOIN categories c2 ON c2.id = c1.parent_category_id";
            $category_result = mysqli_query($con,$category_query);
            if(mysqli_num_rows($category_result) > 0) {
              ?>
                <?php foreach($category_result as $category) : ?>
                  <tr>
                    <td><?=$category['name']?></td>
                    <td><?=$category['parent_name']?></td>
                    <td><?=$category['status'] === '1' ? 'Hidden' : 'Visible'?></td>
                    <td class="flex gap-1.5">
                      <form action="controller/category-code.php" method="post">
                        <button type="submit" name="get_cat_data_btn" value="<?=$category['id']?>" class="btn-primary">
                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                          </svg>
                          edit
                        </button>
                      </form>
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
    </div>

  </section>
  
<?php 
include('includes/footer.php')

?>