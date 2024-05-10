<?php 

  include('middleware/authentication.php');
  include('includes/header.php');

  $title = $_SESSION['add_item_data']['title'] ?? null;
  $category_id = $_SESSION['add_item_data']['category_id'] ?? null;
  $slug = $_SESSION['add_item_data']['slug'] ?? null;
  $data_content_title = $_SESSION['add_item_data']['data_content_title'] ?? null;
  $data_content_desc = $_SESSION['add_item_data']['data_content_desc'] ?? null;
  $meta_title = $_SESSION['add_item_data']['meta_title'] ?? null;
  $status = $_SESSION['add_item_data']['status'] ?? null;

  print_r($data_content_title);
  print_r($data_content_desc);

  unset($_SESSION['add_item_data']);


?>

  <?php include('includes/message.php')?>

  <section 
    class="bg-white shadow-md p-4 pb-8 flex flex-col gap-4 rounded-sm"
  >
    <div>
      <h1 class=" text-[2rem] text-dark/75  font-semibold">Items</h1>
      <ul class=" text-dark/65 flex gap-1">
        <li>
          <a href="index.php">Dashboard</a>
        </li>/
        <li>
          <a href="item-view.php">Item</a>
        </li>/
        <li>
          <a href="#">Add</a>
        </li>
      </ul>
    </div>

    <div class="text-softDark flex w-full mt-2">
      
      <form action="controller/item-code.php" method="post" class="w-full h-full">

        <div class="px-7 text-[.9rem] flex flex-col gap-5">
          <div class="flex flex-col">
            <label class="font-bold">Item title:</label>
            <div class="flex sm:flex-col gap-2">
              <input type="text" name="title" value="<?=$title?>" placeholder="e.g: Informatique" class=" p-3 outline-none text-[.9rem] rounded-md">
              <select name="category_id">
                <option value="">No category</option>
              <?php 
                $category_query = "SELECT * FROM categories WHERE status != '2'";
                $category_result = mysqli_query($con,$category_query);

                if(mysqli_num_rows($category_result) > 0) {
                  ?>
                    <?php foreach($category_result as $category): ?>
                      <option value="<?=$category['id']?>" <?=$category['id'] === $category_id ? 'selected' : '' ?> ><?=$category['name']?></option>
                    <?php endforeach ?>
                  <?php
                }
              ?>
              
            </select>
            </div>
            
          </div>
          <div class="flex sm:flex-col gap-2">
            <div class="flex flex-col w-full">
              <label class="font-bold">Slug(URL):</label>
              <input type="text" name="slug" value="<?=$slug?>" placeholder="e.g: informatique-dut" class="shadow-md p-3 outline-none text-[.9rem] rounded-md">
            </div>
            <div class="flex flex-col w-full">
              <label class="font-bold">Meta Title:</label>
              <input type="text" name="meta_title" value="<?=$meta_title?>" placeholder="e.g: Informatique | Est-Fes" class="shadow-md p-3 outline-none rounded-md">
            </div>
          </div>
          <div class="mt-2 flex flex-col gap-2">
            <h2 class="text-center -mb-2 text-lg font-semibold ">Page Content</h2>
            <div id="item_content_list" class="border-b-2 border-t-2 py-1 pb-2 flex flex-col gap-2">
              <div id="items">
                <?php 
                  if($data_content_desc) {
                    for($i=0;$i<sizeof($data_content_desc);$i++) {
                      ?>
                      <div id="item">
                        <button type="button">
                          <span></span>
                          <span></span>
                        </button>
                        <div>
                          <label>Sub-title:</label>
                          <input type="text" name="data_content_title[]" value="<?=$data_content_title[$i]?>" placeholder="e.g: Presentation">
                        </div>
                        <div>
                          <label>Description:</label>
                          <textarea name="data_content_desc[]" placeholder="e.g: Le diplomé de la filière Génie Informatique ..." rows="4"><?=$data_content_desc[$i]?></textarea>
                        </div>
                      </div>
                      <?php
                    }
                  } else {
                    ?>
                    <div id="item">
                      <button type="button">
                        <span></span>
                        <span></span>
                      </button>
                      <div>
                        <label>Sub-title:</label>
                        <input type="text" name="data_content_title[]" placeholder="e.g: Presentation">
                      </div>
                      <div>
                        <label>Description:</label>
                        <textarea name="data_content_desc[]" placeholder="e.g: Le diplomé de la filière Génie Informatique ..." rows="4"></textarea>
                      </div>
                    </div>
                    <?php
                  }
                ?>
              </div>
              <div class="flex items-center justify-center">
                <button type="button" onclick="handleAddItem()">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                  </svg>
                </button>
              </div>
            </div>
          </div>

          <button type="submit" class="bg-primary p-3 rounded-md text-white uppercase mt-3 sm:mt-0 font-semibold hover:bg-primary/90 transition duration-200 ease-in-out sm:text-xs" name="add_item_btn">Add item</button>
          
        </div>

      </form>

    </div>

  </section>

  <script>
    const handleAddItem = () => {
      const listItem = document.getElementById('items');

      const item = document.createElement('div')
      
      const deleteBtn = document.createElement('button');
      const span1 = document.createElement('span');
      const span2 = document.createElement('span');
      deleteBtn.setAttribute('type','button')
      deleteBtn.appendChild(span1)
      deleteBtn.appendChild(span2)
      deleteBtn.onclick = () => {
        deleteBtn.parentElement.remove()
      }
      
      const stitleDiv = document.createElement('div')
      const stitleLabel = document.createElement('label')
      const stitleInput = document.createElement('input')
      
      const descDiv = document.createElement('div')
      const descLabel = document.createElement('label')
      const decTextarea = document.createElement('textarea')
      
      item.setAttribute('id','item')
      stitleLabel.textContent = 'Sub-title:'
      descLabel.textContent = 'Description:'
      stitleInput.setAttribute('placeholder','e.g: Presentation')
      stitleInput.setAttribute('name','data_content_title[]')
      decTextarea.setAttribute('placeholder','e.g: Le diplomé de la filière Génie Informatique ...')
      decTextarea.setAttribute('name','data_content_desc[]')
      decTextarea.setAttribute('rows','4')

      stitleDiv.appendChild(stitleLabel)
      stitleDiv.appendChild(stitleInput)
      descDiv.appendChild(descLabel,)
      descDiv.appendChild(decTextarea)
      
      item.appendChild(deleteBtn)
      item.appendChild(stitleDiv)
      item.appendChild(descDiv)

      listItem.appendChild(item)

    }
  </script>
  
<?php 

include('includes/footer.php')

?>