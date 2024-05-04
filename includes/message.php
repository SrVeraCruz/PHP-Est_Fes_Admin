<?php 

  if(isset($_SESSION['message-error'])) {
    ?>
      <div id="alert-msg" class=" bg-bgErrorAlert text-errorAlert border-2 border-errorAlert p-3 m-2 mb-4 sm:mt-3 flex items-center justify-between text-center rounded-md shadow-sm w-full max-w-[30rem] mx-auto">
        <h2 class="flex items-center gap-3">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
          </svg> 
          <?=$_SESSION['message-error']?>.
        </h2>
        <button onclick="handleClickError()">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6">
          <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
        </svg>
        </button>
      </div>
      
      <script>
        const handleClickError = () => {
          document.getElementById('alert-msg').classList.add('hidden')
        }
        
        setInterval(() => {
          handleClickError()
        },20000)
        
      </script>
    
    <?php
    unset($_SESSION['message-error']);

  } elseif (isset($_SESSION['message-success'])) {
    ?>
      <div id="alert-msg" class=" bg-bgSuccessAlert text-successAlert border-2 border-successAlert p-3 m-2 mb-4 sm:mt-3 flex items-center justify-between text-center rounded-md shadow-sm w-full max-w-[30rem] mx-auto">
        <h2 class="flex items-center gap-3">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
          </svg>     
          <?=$_SESSION['message-success']?>.
        </h2>
        <button onclick="handleClickSuccess()">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6">
          <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
        </svg>
        </button>
      </div>

      <script>
        const handleClickSuccess = () => {
          document.getElementById('alert-msg').classList.add('hidden')
        }
        
        setInterval(() => {
          handleClickSuccess()
        },20000)
        
      </script>

    <?php
    unset($_SESSION['message-success']);
  
  } elseif (isset($_SESSION['message-warning'])) {
    ?>
      <div id="alert-msg" class=" bg-bgWarningAlert text-warningAlert border-2 border-warningAlert p-3 m-2 mb-4 sm:mt-3 flex items-center justify-between text-center rounded-md shadow-sm w-full max-w-[30rem] mx-auto">
        <h2 class="flex items-center gap-3">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
          </svg> 
          <?=$_SESSION['message-warning']?>.
        </h2>
        <button onclick="handleClickWarning()">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6">
          <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
        </svg>
        </button>
      </div>

      <script>
        const handleClickWarning = () => {
          document.getElementById('alert-msg').classList.add('hidden')
        }
        
        setInterval(() => {
          handleClickWarning()
        },20000)
        
      </script>

    <?php
    unset($_SESSION['message-warning']);

  } elseif (isset($_SESSION['message-info'])) {
    ?>
      <div id="alert-msg" class=" bg-bgInfoAlert text-infoAlert border-2 border-infoAlert p-3 m-2 mb-4 sm:mt-3 flex items-center justify-between text-center rounded-md shadow-sm w-full max-w-[30rem] mx-auto">
        <h2 class="flex items-center gap-3">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
          </svg>

          <?=$_SESSION['message-info']?>.
        </h2>
        <button onclick="handleClickInfo()">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6">
          <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
        </svg>
        </button>
      </div>

      <script>
        const handleClickInfo = () => {
          document.getElementById('alert-msg').classList.add('hidden')
        }
        
        setInterval(() => {
          handleClickInfo()
        },20000)
        
      </script>

    <?php
    unset($_SESSION['message-info']);
  }

?>