<?php 

  include('middleware/authentication.php');
  include('includes/header.php')

?>

    <section 
      class="bg-white shadow-md p-4 pb-8 flex flex-col gap-4 rounded-md"
    >
      <div>
        <h1 class=" text-[2rem] text-dark/75  font-semibold">Requests</h1>
        <ul class=" text-dark/65 flex gap-1">
          <li>
            <a href="index.php">Dashboard</a>
          </li>/
          <li>
            <a href="#">Request</a>
          </li>
        </ul>
      </div>

    </section>
    
  <?php 
  
  include('includes/footer.php')
  
  ?>