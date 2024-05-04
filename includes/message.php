<?php 

  if(isset($_SESSION['message'])) {
    ?>
      <div id="alert-msg" class=" bg-alertYellow/65 border-2 border-alertYellow p-3 m-2 mb-4 sm:mt-3 flex items-center justify-between text-center rounded-md shadow-sm w-full max-w-[30rem] mx-auto opacity-100 visible transition duration-200 ease-in-out">
        <h2><strong>Hey!</strong> <?=$_SESSION['message']?>.</h2>
        <button onclick="handleClick()">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
          <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
        </svg>
        </button>
      </div>
      
      <script>
        const handleClick = () => {
          document.getElementById('alert-msg').classList.add('opacity-0')
          document.getElementById('alert-msg').classList.add('invisible')
        }

        setInterval(() => {
          handleClick()
        },10000)

      </script>

    <?php
    unset($_SESSION['message']);
  }


?>